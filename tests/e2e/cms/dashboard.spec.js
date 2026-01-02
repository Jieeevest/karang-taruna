/**
 * CMS Dashboard Tests
 *
 * Black Box Testing for CMS Dashboard Module
 * Test Cases: TC-CMS-001 through TC-CMS-008
 */

const { test, expect } = require("@playwright/test");
const { loginAs, TEST_USERS } = require("../helpers/auth");

test.describe("CMS Dashboard", () => {
    /**
     * TC-CMS-001: Dashboard Access for Authenticated Users
     * Priority: High
     */
    test("TC-CMS-001: Should allow authenticated user to access dashboard", async ({
        page,
    }) => {
        // Precondition: Login as Ketua
        await loginAs(page, "ketua");

        // Expected: Should be on dashboard
        expect(page.url()).toContain("/cms/dashboard");

        // Expected: Dashboard heading should be visible
        await expect(page.locator('h1:has-text("Dashboard")')).toBeVisible();
    });

    /**
     * TC-CMS-002: Dashboard Statistics Display
     * Priority: High
     */
    test("TC-CMS-002: Should display all dashboard statistics", async ({
        page,
    }) => {
        // Precondition: Login
        await loginAs(page, "ketua");

        // Expected: All stat cards should be visible
        // Total Anggota Aktif
        await expect(page.locator('text="Total Anggota Aktif"')).toBeVisible();

        // Total Kegiatan
        await expect(page.locator('text="Total Kegiatan"')).toBeVisible();

        // Konten Terpublikasi
        await expect(page.locator('text="Konten Terpublikasi"')).toBeVisible();

        // Dokumentasi
        await expect(page.locator('text="Dokumentasi"')).toBeVisible();

        // Each stat should have a number
        const statNumbers = page.locator(".text-2xl.font-bold.text-gray-700");
        const count = await statNumbers.count();
        expect(count).toBeGreaterThanOrEqual(4);
    });

    /**
     * TC-CMS-003: User Welcome Message with Name and Role
     * Priority: Medium
     */
    test("TC-CMS-003: Should display user welcome message with name and role", async ({
        page,
    }) => {
        const user = TEST_USERS.ketua;

        // Precondition: Login as Ketua
        await loginAs(page, "ketua");

        // Expected: Welcome message with user name
        await expect(
            page.locator(`text=/Selamat datang.*${user.name}/i`)
        ).toBeVisible();

        // Expected: Role should be displayed
        await expect(page.locator(`text=/${user.role}/i`)).toBeVisible();
    });

    /**
     * TC-CMS-004: Recent Activities Section
     * Priority: Medium
     */
    test("TC-CMS-004: Should display recent activities section", async ({
        page,
    }) => {
        // Precondition: Login
        await loginAs(page, "ketua");

        // Expected: Recent activities heading should be visible
        await expect(
            page.locator('h2:has-text("Kegiatan Terbaru")')
        ).toBeVisible();

        // Expected: Section should exist (even if empty)
        const activitiesSection = page
            .locator('h2:has-text("Kegiatan Terbaru")')
            .locator("..");
        await expect(activitiesSection).toBeVisible();

        // Check if there are activities or empty state message
        const hasActivities =
            (await page.locator('text="Belum ada kegiatan terbaru"').count()) >
            0;
        const hasActivityItems =
            (await activitiesSection.locator(".border-b").count()) > 0;

        expect(hasActivities || hasActivityItems).toBeTruthy();
    });

    /**
     * TC-CMS-005: Recent Content Section
     * Priority: Medium
     */
    test("TC-CMS-005: Should display recent content section", async ({
        page,
    }) => {
        // Precondition: Login
        await loginAs(page, "adminData");

        // Expected: Recent content heading should be visible
        await expect(
            page.locator('h2:has-text("Konten Terbaru")')
        ).toBeVisible();

        // Expected: Section should exist (even if empty)
        const contentSection = page
            .locator('h2:has-text("Konten Terbaru")')
            .locator("..");
        await expect(contentSection).toBeVisible();

        // Check if there is content or empty state message
        const hasNoContent =
            (await page.locator('text="Belum ada konten terbaru"').count()) > 0;
        const hasContentItems =
            (await contentSection.locator(".border-b").count()) > 0;

        expect(hasNoContent || hasContentItems).toBeTruthy();
    });

    /**
     * TC-CMS-006: Dashboard Layout and UI Elements
     * Priority: Low
     */
    test("TC-CMS-006: Should display dashboard with proper layout", async ({
        page,
    }) => {
        // Precondition: Login
        await loginAs(page, "ketua");

        // Expected: Stats grid should be visible
        const statsGrid = page.locator(".grid.grid-cols-1.gap-4");
        await expect(statsGrid.first()).toBeVisible();

        // Expected: Should have 4 stat cards
        const statCards = page.locator(
            ".p-4.bg-white.border.border-gray-200.rounded-lg.shadow"
        );
        const cardCount = await statCards.count();
        expect(cardCount).toBeGreaterThanOrEqual(4);

        // Expected: Two-column layout for activities and content
        const twoColGrid = page.locator(
            ".grid.grid-cols-1.gap-4.lg\\:grid-cols-2"
        );
        await expect(twoColGrid).toBeVisible();
    });

    /**
     * TC-CMS-007: Role-Based Access Control - Ketua
     * Priority: High
     */
    test("TC-CMS-007a: Ketua should access dashboard", async ({ page }) => {
        // Precondition: Login as Ketua
        await loginAs(page, "ketua");

        // Expected: Can access dashboard
        expect(page.url()).toContain("/cms/dashboard");

        // Expected: No error or access denied message
        const accessDenied = await page
            .locator("text=/access denied/i, text=/unauthorized/i")
            .count();
        expect(accessDenied).toBe(0);
    });

    test("TC-CMS-007b: Admin Data should access dashboard", async ({
        page,
    }) => {
        // Precondition: Login as Admin Data
        await loginAs(page, "adminData");

        // Expected: Can access dashboard
        expect(page.url()).toContain("/cms/dashboard");

        // Expected: User role should be displayed
        await expect(page.locator("text=/admin-data/i")).toBeVisible();
    });

    test("TC-CMS-007c: Anggota should access dashboard", async ({ page }) => {
        // Precondition: Login as Anggota
        await loginAs(page, "anggota");

        // Expected: Can access dashboard
        expect(page.url()).toContain("/cms/dashboard");

        // Expected: User role should be displayed
        await expect(page.locator("text=/anggota/i")).toBeVisible();
    });

    /**
     * TC-CMS-008: Unauthorized Access Prevention
     * Priority: High
     */
    test("TC-CMS-008: Should prevent unauthenticated access to dashboard", async ({
        page,
    }) => {
        // Step 1: Try to access dashboard without authentication
        await page.goto("/cms/dashboard");

        await page.waitForLoadState("networkidle");

        // Expected: Should redirect to login page
        expect(page.url()).toContain("/login");

        // Expected: Dashboard should not be visible
        const dashboardHeading = await page
            .locator('h1:has-text("Dashboard")')
            .count();
        expect(dashboardHeading).toBe(0);
    });

    /**
     * TC-CMS-009: Dashboard Icons and Visual Elements
     * Priority: Low
     */
    test("TC-CMS-009: Should display icons for each stat card", async ({
        page,
    }) => {
        // Precondition: Login
        await loginAs(page, "ketua");

        // Expected: Each stat card should have an icon (SVG)
        const icons = page.locator(".p-3.mr-4.rounded-full svg");
        const iconCount = await icons.count();
        expect(iconCount).toBeGreaterThanOrEqual(4);

        // Expected: Icons should have different colors
        const blueIcon = page.locator(".text-blue-500.bg-blue-100");
        await expect(blueIcon).toBeVisible();

        const greenIcon = page.locator(".text-green-500.bg-green-100");
        await expect(greenIcon).toBeVisible();

        const purpleIcon = page.locator(".text-purple-500.bg-purple-100");
        await expect(purpleIcon).toBeVisible();

        const yellowIcon = page.locator(".text-yellow-500.bg-yellow-100");
        await expect(yellowIcon).toBeVisible();
    });

    /**
     * TC-CMS-010: Dashboard Responsiveness
     * Priority: Medium
     */
    test("TC-CMS-010: Should be responsive on mobile viewport", async ({
        page,
    }) => {
        // Set mobile viewport
        await page.setViewportSize({ width: 375, height: 667 });

        // Precondition: Login
        await loginAs(page, "ketua");

        // Expected: Dashboard should still be accessible
        await expect(page.locator('h1:has-text("Dashboard")')).toBeVisible();

        // Expected: Stats should be visible (stacked on mobile)
        await expect(page.locator('text="Total Anggota Aktif"')).toBeVisible();

        // Expected: Recent sections should be visible
        await expect(
            page.locator('h2:has-text("Kegiatan Terbaru")')
        ).toBeVisible();
        await expect(
            page.locator('h2:has-text("Konten Terbaru")')
        ).toBeVisible();
    });
});
