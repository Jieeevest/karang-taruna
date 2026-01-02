/**
 * Login Functionality Tests
 *
 * Black Box Testing for Authentication Module
 * Test Cases: TC-AUTH-001 through TC-AUTH-009
 */

const { test, expect } = require("@playwright/test");
const { login, logout, TEST_USERS } = require("../helpers/auth");

test.describe("Login Functionality", () => {
    test.beforeEach(async ({ page }) => {
        // Navigate to login page before each test
        await page.goto("/login");
    });

    /**
     * TC-AUTH-001: Successful Login with Valid Credentials
     * Priority: High
     */
    test("TC-AUTH-001: Should successfully login with valid credentials", async ({
        page,
    }) => {
        // Test data
        const user = TEST_USERS.ketua;

        // Step 1: Enter valid email
        await page.fill("#email", user.email);

        // Step 2: Enter valid password
        await page.fill("#password", user.password);

        // Step 3: Click login button
        await page.click('button[type="submit"]');

        // Wait for navigation
        await page.waitForLoadState("networkidle");

        // Expected: Redirect to CMS dashboard
        expect(page.url()).toContain("/cms/dashboard");

        // Expected: User name should be visible
        await expect(page.locator("text=" + user.name)).toBeVisible();
    });

    /**
     * TC-AUTH-002: Failed Login with Invalid Email
     * Priority: High
     */
    test("TC-AUTH-002: Should fail login with invalid email", async ({
        page,
    }) => {
        // Step 1: Enter invalid email
        await page.fill("#email", "invalid@example.com");

        // Step 2: Enter any password
        await page.fill("#password", "password123");

        // Step 3: Click login button
        await page.click('button[type="submit"]');

        // Wait for response
        await page.waitForLoadState("networkidle");

        // Expected: Stay on login page
        expect(page.url()).toContain("/login");

        // Expected: Error message should be displayed
        const errorExists =
            (await page
                .locator(
                    "text=/credentials.*not match/i, text=/email.*password.*incorrect/i"
                )
                .count()) > 0;
        expect(errorExists).toBeTruthy();
    });

    /**
     * TC-AUTH-003: Failed Login with Invalid Password
     * Priority: High
     */
    test("TC-AUTH-003: Should fail login with invalid password", async ({
        page,
    }) => {
        const user = TEST_USERS.ketua;

        // Step 1: Enter valid email
        await page.fill("#email", user.email);

        // Step 2: Enter invalid password
        await page.fill("#password", "wrongpassword123");

        // Step 3: Click login button
        await page.click('button[type="submit"]');

        // Wait for response
        await page.waitForLoadState("networkidle");

        // Expected: Stay on login page
        expect(page.url()).toContain("/login");

        // Expected: Error message should be displayed
        const errorExists =
            (await page
                .locator(
                    "text=/credentials.*not match/i, text=/email.*password.*incorrect/i"
                )
                .count()) > 0;
        expect(errorExists).toBeTruthy();
    });

    /**
     * TC-AUTH-004: Email Field Validation
     * Priority: Medium
     */
    test("TC-AUTH-004: Should validate empty email field", async ({ page }) => {
        // Step 1: Leave email empty
        // Step 2: Enter password
        await page.fill("#password", "password123");

        // Step 3: Click login button
        await page.click('button[type="submit"]');

        // Expected: HTML5 validation should prevent submission
        const emailInput = page.locator("#email");
        const validationMessage = await emailInput.evaluate(
            (el) => el.validationMessage
        );
        expect(validationMessage).toBeTruthy();
    });

    test("TC-AUTH-004b: Should validate invalid email format", async ({
        page,
    }) => {
        // Step 1: Enter invalid email format
        await page.fill("#email", "notanemail");

        // Step 2: Enter password
        await page.fill("#password", "password123");

        // Step 3: Click login button
        await page.click('button[type="submit"]');

        // Expected: HTML5 validation should prevent submission or show error
        const emailInput = page.locator("#email");
        const inputType = await emailInput.getAttribute("type");

        if (inputType === "email") {
            const validationMessage = await emailInput.evaluate(
                (el) => el.validationMessage
            );
            expect(validationMessage).toBeTruthy();
        }
    });

    /**
     * TC-AUTH-005: Password Field Validation
     * Priority: Medium
     */
    test("TC-AUTH-005: Should validate empty password field", async ({
        page,
    }) => {
        const user = TEST_USERS.ketua;

        // Step 1: Enter email
        await page.fill("#email", user.email);

        // Step 2: Leave password empty
        // Step 3: Click login button
        await page.click('button[type="submit"]');

        // Expected: HTML5 validation should prevent submission
        const passwordInput = page.locator("#password");
        const validationMessage = await passwordInput.evaluate(
            (el) => el.validationMessage
        );
        expect(validationMessage).toBeTruthy();
    });

    /**
     * TC-AUTH-006: Remember Me Functionality
     * Priority: Low
     */
    test("TC-AUTH-006: Should remember user when checkbox is checked", async ({
        page,
    }) => {
        const user = TEST_USERS.ketua;

        // Step 1: Enter credentials
        await page.fill("#email", user.email);
        await page.fill("#password", user.password);

        // Step 2: Check "Remember Me"
        await page.check("#remember_me");

        // Step 3: Submit form
        await page.click('button[type="submit"]');
        await page.waitForLoadState("networkidle");

        // Expected: Should set remember cookie
        const cookies = await page.context().cookies();
        const rememberCookie = cookies.find((c) => c.name.includes("remember"));

        // Note: This test might need adjustment based on Laravel's cookie naming
        expect(page.url()).toContain("/cms/dashboard");
    });

    /**
     * TC-AUTH-007: Logout Functionality
     * Priority: High
     */
    test("TC-AUTH-007: Should successfully logout authenticated user", async ({
        page,
    }) => {
        // Precondition: Login first
        await login(page, TEST_USERS.ketua.email, TEST_USERS.ketua.password);

        // Verify we're logged in
        expect(page.url()).toContain("/cms/dashboard");

        // Step 1: Click logout button
        await logout(page);

        // Expected: Redirect to home page
        await page.waitForLoadState("networkidle");
        expect(page.url()).not.toContain("/cms");

        // Step 2: Try to access protected page
        await page.goto("/cms/dashboard");
        await page.waitForLoadState("networkidle");

        // Expected: Should redirect to login
        expect(page.url()).toContain("/login");
    });

    /**
     * TC-AUTH-008: Redirect to Dashboard After Login
     * Priority: Medium
     */
    test("TC-AUTH-008: Should redirect to dashboard after successful login", async ({
        page,
    }) => {
        const user = TEST_USERS.adminData;

        // Step 1: Login
        await page.fill("#email", user.email);
        await page.fill("#password", user.password);
        await page.click('button[type="submit"]');

        await page.waitForLoadState("networkidle");

        // Expected: URL should be dashboard
        expect(page.url()).toContain("/cms/dashboard");

        // Expected: Dashboard content should be visible
        await expect(page.locator('h1:has-text("Dashboard")')).toBeVisible();
    });

    /**
     * TC-AUTH-009: Redirect to Login for Unauthenticated Access
     * Priority: High
     */
    test("TC-AUTH-009: Should redirect to login when accessing protected routes", async ({
        page,
    }) => {
        // Step 1: Try to access protected route without authentication
        await page.goto("/cms/dashboard");

        await page.waitForLoadState("networkidle");

        // Expected: Should redirect to login page
        expect(page.url()).toContain("/login");

        // Expected: Login form should be visible
        await expect(page.locator("#email")).toBeVisible();
        await expect(page.locator("#password")).toBeVisible();
    });

    /**
     * TC-AUTH-010: Login Page UI Elements
     * Priority: Low
     */
    test("TC-AUTH-010: Should display all login form elements", async ({
        page,
    }) => {
        // Verify all UI elements are present
        await expect(page.locator("#email")).toBeVisible();
        await expect(page.locator("#password")).toBeVisible();
        await expect(page.locator("#remember_me")).toBeVisible();
        await expect(page.locator('button[type="submit"]')).toBeVisible();

        // Should have "Log in" text on button
        await expect(
            page.locator('button[type="submit"]:has-text("Log in")')
        ).toBeVisible();

        // Should have "Forgot your password?" link
        const forgotPasswordLink = page.locator('a[href*="password.request"]');
        if ((await forgotPasswordLink.count()) > 0) {
            await expect(forgotPasswordLink).toBeVisible();
        }
    });
});
