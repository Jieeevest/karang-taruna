/**
 * Authentication Helper Functions for Playwright Tests
 *
 * This module provides reusable helper functions for authentication
 * operations in end-to-end tests.
 */

/**
 * Test user credentials
 * These should match users in your database seeder
 */
export const TEST_USERS = {
    ketua: {
        email: "ketua@karangtaruna.test",
        password: "password",
        name: "Ketua Test",
        role: "ketua",
    },
    adminData: {
        email: "admin@karangtaruna.test",
        password: "password",
        name: "Admin Test",
        role: "admin-data",
    },
    anggota: {
        email: "anggota@karangtaruna.test",
        password: "password",
        name: "Anggota Test",
        role: "anggota",
    },
};

/**
 * Login helper function
 * @param {import('@playwright/test').Page} page - Playwright page object
 * @param {string} email - User email
 * @param {string} password - User password
 */
export async function login(page, email, password) {
    await page.goto("/login");
    await page.fill("#email", email);
    await page.fill("#password", password);
    await page.click('button[type="submit"]');

    // Wait for navigation to complete
    await page.waitForLoadState("networkidle");
}

/**
 * Login as a specific test user
 * @param {import('@playwright/test').Page} page - Playwright page object
 * @param {'ketua'|'adminData'|'anggota'} userType - Type of test user
 */
export async function loginAs(page, userType) {
    const user = TEST_USERS[userType];
    if (!user) {
        throw new Error(`Unknown user type: ${userType}`);
    }
    await login(page, user.email, user.password);
}

/**
 * Logout helper function
 * @param {import('@playwright/test').Page} page - Playwright page object
 */
export async function logout(page) {
    // Look for logout form/button - Laravel Breeze uses a POST form
    await page.click(
        'button[type="submit"]:has-text("Log Out"), form[action*="logout"] button'
    );
    await page.waitForLoadState("networkidle");
}

/**
 * Check if user is authenticated
 * @param {import('@playwright/test').Page} page - Playwright page object
 * @returns {Promise<boolean>}
 */
export async function isAuthenticated(page) {
    try {
        await page.goto("/cms/dashboard");
        await page.waitForLoadState("networkidle");
        // If we're redirected to login, we're not authenticated
        return !page.url().includes("/login");
    } catch (error) {
        return false;
    }
}

/**
 * Setup authenticated state for tests
 * This can be used with Playwright's storage state feature
 * @param {import('@playwright/test').Page} page - Playwright page object
 * @param {'ketua'|'adminData'|'anggota'} userType - Type of test user
 */
export async function setupAuthState(page, userType = "ketua") {
    await loginAs(page, userType);
    // Store the authentication state
    await page
        .context()
        .storageState({ path: `tests/e2e/.auth/${userType}.json` });
}
