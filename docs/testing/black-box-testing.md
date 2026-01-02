# Black Box Testing Documentation

## Karang Taruna Web Application

**Document Version:** 1.0  
**Last Updated:** January 2, 2026  
**Prepared by:** QA Team  
**Application:** Karang Taruna CMS

---

## Table of Contents

1. [Introduction](#introduction)
2. [Test Environment](#test-environment)
3. [Test Scenarios](#test-scenarios)
4. [Test Cases](#test-cases)
5. [Test Coverage Matrix](#test-coverage-matrix)
6. [Test Execution Procedures](#test-execution-procedures)
7. [Test Results Summary](#test-results-summary)
8. [Known Issues](#known-issues)
9. [Appendix](#appendix)

---

## 1. Introduction

### 1.1 Purpose

This document provides comprehensive black box testing documentation for the Karang Taruna Web Application. Black box testing focuses on testing the application's functionality without knowledge of its internal code structure, treating the system as a "black box."

### 1.2 Testing Objectives

-   Verify that login functionality works as expected
-   Ensure CMS dashboard displays correctly for authenticated users
-   Validate role-based access control
-   Test user interface elements and interactions
-   Identify defects and ensure quality standards

### 1.3 Testing Methodology

-   **Approach:** Black Box Testing
-   **Technique:** Functional Testing, Boundary Value Analysis, Equivalence Partitioning
-   **Tools:** Playwright, Manual Testing
-   **Test Level:** System Testing, End-to-End Testing

### 1.4 Scope

**In Scope:**

-   Authentication module (login, logout)
-   CMS Dashboard
-   Role-based access control
-   UI/UX validation

**Out of Scope:**

-   Backend API testing
-   Database testing
-   Performance testing
-   Security testing (beyond basic authentication)

---

## 2. Test Environment

### 2.1 Hardware Requirements

-   **Processor:** Intel Core i5 or equivalent
-   **RAM:** 8GB minimum
-   **Storage:** 10GB free space

### 2.2 Software Requirements

-   **Operating System:** macOS, Windows, or Linux
-   **Browser:** Chrome (latest), Firefox (latest), Safari (latest)
-   **Node.js:** v16+
-   **PHP:** 8.0+
-   **Laravel:** 8.x
-   **Database:** MySQL 8.0+

### 2.3 Test Data

Test users are seeded in the database:

| User Type  | Email                     | Password | Role       | Access Level    |
| ---------- | ------------------------- | -------- | ---------- | --------------- |
| Ketua      | ketua@karangtaruna.test   | password | ketua      | Full access     |
| Admin Data | admin@karangtaruna.test   | password | admin-data | Data management |
| Anggota    | anggota@karangtaruna.test | password | anggota    | Basic access    |

### 2.4 Test Environment Setup

1. Clone the repository
2. Install dependencies: `composer install && npm install`
3. Setup environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed test data: `php artisan db:seed`
7. Install Playwright browsers: `npx playwright install`
8. Start application: `php artisan serve`

---

## 3. Test Scenarios

### Scenario 1: User Authentication

**Description:** Testing the complete authentication flow from login to logout.

**Objective:** Ensure users can successfully authenticate and access protected resources.

**Prerequisites:**

-   Application is running
-   Test users are seeded in database

**Test Flow:**

1. Navigate to login page
2. Enter credentials
3. Submit login form
4. Verify dashboard access
5. Logout
6. Verify session termination

---

### Scenario 2: CMS Dashboard Access

**Description:** Testing dashboard functionality for authenticated users.

**Objective:** Verify dashboard displays correct information and UI elements.

**Prerequisites:**

-   User is authenticated
-   Sample data exists in database

**Test Flow:**

1. Login with valid credentials
2. Verify dashboard loads
3. Check statistics display
4. Verify recent activities/content
5. Check navigation elements

---

### Scenario 3: Role-Based Access Control

**Description:** Testing access permissions based on user roles.

**Objective:** Ensure proper authorization and access control.

**Prerequisites:**

-   Multiple test users with different roles

**Test Flow:**

1. Login as different user roles
2. Verify accessible features per role
3. Attempt unauthorized access
4. Verify error handling

---

## 4. Test Cases

### 4.1 Authentication Module

#### TC-AUTH-001: Successful Login with Valid Credentials

-   **Priority:** High
-   **Category:** Authentication
-   **Type:** Positive Test

**Preconditions:**

-   User exists in database with email: `ketua@karangtaruna.test`
-   Password is `password`
-   Application is running

**Test Steps:**

1. Navigate to `/login`
2. Enter email: `ketua@karangtaruna.test`
3. Enter password: `password`
4. Click "Log in" button

**Expected Results:**

-   User is redirected to `/cms/dashboard`
-   Dashboard page loads successfully
-   User name "Ketua Test" is displayed
-   Welcome message shows correct role

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

**Test Data:**

```
Email: ketua@karangtaruna.test
Password: password
```

**Screenshots:** _[Attach if applicable]_

---

#### TC-AUTH-002: Failed Login with Invalid Email

-   **Priority:** High
-   **Category:** Authentication
-   **Type:** Negative Test

**Preconditions:**

-   Application is running

**Test Steps:**

1. Navigate to `/login`
2. Enter email: `invalid@example.com`
3. Enter password: `password123`
4. Click "Log in" button

**Expected Results:**

-   User remains on login page
-   Error message displayed: "These credentials do not match our records" or similar
-   Email field retains entered value
-   Password field is cleared

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-003: Failed Login with Invalid Password

-   **Priority:** High
-   **Category:** Authentication
-   **Type:** Negative Test

**Preconditions:**

-   User exists in database

**Test Steps:**

1. Navigate to `/login`
2. Enter email: `ketua@karangtaruna.test`
3. Enter password: `wrongpassword123`
4. Click "Log in" button

**Expected Results:**

-   User remains on login page
-   Error message displayed
-   No sensitive information revealed in error message

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-004: Email Field Validation - Empty

-   **Priority:** Medium
-   **Category:** Authentication - Validation
-   **Type:** Negative Test

**Test Steps:**

1. Navigate to `/login`
2. Leave email field empty
3. Enter password: `password123`
4. Click "Log in" button

**Expected Results:**

-   HTML5 validation prevents form submission
-   Error message: "Please fill out this field" or similar
-   Focus returns to email field

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-004b: Email Field Validation - Invalid Format

-   **Priority:** Medium
-   **Category:** Authentication - Validation
-   **Type:** Negative Test

**Test Steps:**

1. Navigate to `/login`
2. Enter invalid email: `notanemail`
3. Enter password: `password123`
4. Click "Log in" button

**Expected Results:**

-   HTML5 validation prevents submission OR
-   Server-side validation returns error
-   Error message indicates invalid email format

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-005: Password Field Validation - Empty

-   **Priority:** Medium
-   **Category:** Authentication - Validation
-   **Type:** Negative Test

**Test Steps:**

1. Navigate to `/login`
2. Enter email: `ketua@karangtaruna.test`
3. Leave password field empty
4. Click "Log in" button

**Expected Results:**

-   HTML5 validation prevents form submission
-   Error message displayed
-   Focus returns to password field

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-006: Remember Me Functionality

-   **Priority:** Low
-   **Category:** Authentication
-   **Type:** Positive Test

**Test Steps:**

1. Navigate to `/login`
2. Enter valid credentials
3. Check "Remember me" checkbox
4. Click "Log in" button
5. Inspect browser cookies

**Expected Results:**

-   Login successful
-   "Remember" cookie is set
-   Cookie has appropriate expiration time

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-007: Logout Functionality

-   **Priority:** High
-   **Category:** Authentication
-   **Type:** Positive Test

**Preconditions:**

-   User is logged in

**Test Steps:**

1. Login with valid credentials
2. Navigate to dashboard
3. Click "Logout" button
4. Attempt to access `/cms/dashboard`

**Expected Results:**

-   After logout, user is redirected to home page
-   Session is terminated
-   Accessing protected routes redirects to login
-   Back button doesn't allow access to authenticated pages

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-008: Redirect to Dashboard After Login

-   **Priority:** Medium
-   **Category:** Authentication
-   **Type:** Positive Test

**Test Steps:**

1. Navigate to `/login`
2. Enter valid credentials
3. Click "Log in" button

**Expected Results:**

-   Redirected to `/cms/dashboard`
-   Dashboard heading "Dashboard" is visible
-   URL is `http://localhost:8000/cms/dashboard`

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-009: Redirect to Login for Unauthenticated Access

-   **Priority:** High
-   **Category:** Authentication - Security
-   **Type:** Negative Test

**Preconditions:**

-   User is not logged in

**Test Steps:**

1. Navigate directly to `/cms/dashboard`

**Expected Results:**

-   Redirected to `/login`
-   Login form is displayed
-   Original URL may be preserved for redirect after login

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-AUTH-010: Login Page UI Elements

-   **Priority:** Low
-   **Category:** Authentication - UI
-   **Type:** Positive Test

**Test Steps:**

1. Navigate to `/login`
2. Inspect page elements

**Expected Results:**

-   Email input field with ID "email" is visible
-   Password input field with ID "password" is visible
-   "Remember me" checkbox with ID "remember_me" is visible
-   "Log in" button is visible
-   "Forgot your password?" link is visible (if implemented)
-   Application logo/branding is displayed

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

### 4.2 CMS Dashboard Module

#### TC-CMS-001: Dashboard Access for Authenticated Users

-   **Priority:** High
-   **Category:** CMS Dashboard
-   **Type:** Positive Test

**Preconditions:**

-   User is logged in as Ketua

**Test Steps:**

1. Login with Ketua credentials
2. Verify URL

**Expected Results:**

-   URL contains `/cms/dashboard`
-   Dashboard heading "Dashboard" is visible
-   Page loads within 3 seconds

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-002: Dashboard Statistics Display

-   **Priority:** High
-   **Category:** CMS Dashboard - Data Display
-   **Type:** Positive Test

**Preconditions:**

-   User is logged in

**Test Steps:**

1. Login with valid credentials
2. Observe dashboard stat cards

**Expected Results:**

-   Four stat cards are displayed:
    1. Total Anggota Aktif (with user icon)
    2. Total Kegiatan (with calendar icon)
    3. Konten Terpublikasi (with document icon)
    4. Dokumentasi (with image icon)
-   Each card shows a numeric value
-   Icons have appropriate colors (blue, green, purple, yellow)

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-003: User Welcome Message with Name and Role

-   **Priority:** Medium
-   **Category:** CMS Dashboard - Personalization
-   **Type:** Positive Test

**Preconditions:**

-   User is logged in as Ketua

**Test Steps:**

1. Login as Ketua
2. Check welcome message

**Expected Results:**

-   Message displays: "Selamat datang, Ketua Test (ketua)"
-   User's name is correct
-   Role is displayed in parentheses

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-004: Recent Activities Section

-   **Priority:** Medium
-   **Category:** CMS Dashboard - Content
-   **Type:** Positive Test

**Preconditions:**

-   User is logged in

**Test Steps:**

1. Login with valid credentials
2. Locate "Kegiatan Terbaru" section

**Expected Results:**

-   Section heading "Kegiatan Terbaru" is visible
-   If activities exist, they are displayed with:
    -   Activity title
    -   Category and date
    -   Status badge
-   If no activities, message: "Belum ada kegiatan terbaru"

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-005: Recent Content Section

-   **Priority:** Medium
-   **Category:** CMS Dashboard - Content
-   **Type:** Positive Test

**Preconditions:**

-   User is logged in

**Test Steps:**

1. Login with valid credentials
2. Locate "Konten Terbaru" section

**Expected Results:**

-   Section heading "Konten Terbaru" is visible
-   If content exists, items display:
    -   Content title
    -   Category and timestamp
    -   Status badge
-   If no content, message: "Belum ada konten terbaru"

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-006: Dashboard Layout and UI Elements

-   **Priority:** Low
-   **Category:** CMS Dashboard - UI
-   **Type:** Positive Test

**Test Steps:**

1. Login with valid credentials
2. Inspect dashboard layout

**Expected Results:**

-   Stats grid displays 4 cards in responsive grid
-   Two-column layout for activities and content sections
-   All cards have white background with border
-   Proper spacing and padding
-   Rounded corners on cards
-   Shadows on cards for depth

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-007a: Role-Based Access - Ketua

-   **Priority:** High
-   **Category:** CMS Dashboard - Authorization
-   **Type:** Positive Test

**Test Steps:**

1. Login as Ketua (ketua@karangtaruna.test)
2. Access dashboard

**Expected Results:**

-   Dashboard accessible
-   No access denied error
-   Role "ketua" displayed in welcome message

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-007b: Role-Based Access - Admin Data

-   **Priority:** High
-   **Category:** CMS Dashboard - Authorization
-   **Type:** Positive Test

**Test Steps:**

1. Login as Admin Data (admin@karangtaruna.test)
2. Access dashboard

**Expected Results:**

-   Dashboard accessible
-   Role "admin-data" displayed

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-007c: Role-Based Access - Anggota

-   **Priority:** High
-   **Category:** CMS Dashboard - Authorization
-   **Type:** Positive Test

**Test Steps:**

1. Login as Anggota (anggota@karangtaruna.test)
2. Access dashboard

**Expected Results:**

-   Dashboard accessible
-   Role "anggota" displayed

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-008: Unauthorized Access Prevention

-   **Priority:** High
-   **Category:** CMS Dashboard - Security
-   **Type:** Negative Test

**Preconditions:**

-   User is NOT logged in

**Test Steps:**

1. Navigate to `/cms/dashboard` without authentication

**Expected Results:**

-   Redirected to `/login`
-   Dashboard content not visible
-   No sensitive data exposed

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-009: Dashboard Icons and Visual Elements

-   **Priority:** Low
-   **Category:** CMS Dashboard - UI
-   **Type:** Positive Test

**Test Steps:**

1. Login with valid credentials
2. Inspect stat card icons

**Expected Results:**

-   4 SVG icons displayed
-   Blue icon for users
-   Green icon for activities
-   Purple icon for content
-   Yellow icon for documentation
-   Icons have circular colored backgrounds

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

#### TC-CMS-010: Dashboard Responsiveness

-   **Priority:** Medium
-   **Category:** CMS Dashboard - Responsive Design
-   **Type:** Positive Test

**Test Steps:**

1. Login with valid credentials
2. Resize browser to mobile viewport (375x667)
3. Inspect layout

**Expected Results:**

-   Stats stack vertically on mobile
-   All content remains accessible
-   No horizontal scroll
-   Text remains readable
-   Sections display properly

**Actual Results:**
_[To be filled during test execution]_

**Status:** ⬜ Pass ⬜ Fail

---

## 5. Test Coverage Matrix

| Module             | Feature                  | Test Cases                | Priority | Status |
| ------------------ | ------------------------ | ------------------------- | -------- | ------ |
| **Authentication** | Login - Valid            | TC-AUTH-001               | High     | ⬜     |
|                    | Login - Invalid Email    | TC-AUTH-002               | High     | ⬜     |
|                    | Login - Invalid Password | TC-AUTH-003               | High     | ⬜     |
|                    | Email Validation         | TC-AUTH-004, TC-AUTH-004b | Medium   | ⬜     |
|                    | Password Validation      | TC-AUTH-005               | Medium   | ⬜     |
|                    | Remember Me              | TC-AUTH-006               | Low      | ⬜     |
|                    | Logout                   | TC-AUTH-007               | High     | ⬜     |
|                    | Redirect After Login     | TC-AUTH-008               | Medium   | ⬜     |
|                    | Unauthorized Access      | TC-AUTH-009               | High     | ⬜     |
|                    | UI Elements              | TC-AUTH-010               | Low      | ⬜     |
| **CMS Dashboard**  | Dashboard Access         | TC-CMS-001                | High     | ⬜     |
|                    | Statistics Display       | TC-CMS-002                | High     | ⬜     |
|                    | Welcome Message          | TC-CMS-003                | Medium   | ⬜     |
|                    | Recent Activities        | TC-CMS-004                | Medium   | ⬜     |
|                    | Recent Content           | TC-CMS-005                | Medium   | ⬜     |
|                    | Layout & UI              | TC-CMS-006                | Low      | ⬜     |
|                    | RBAC - Ketua             | TC-CMS-007a               | High     | ⬜     |
|                    | RBAC - Admin             | TC-CMS-007b               | High     | ⬜     |
|                    | RBAC - Anggota           | TC-CMS-007c               | High     | ⬜     |
|                    | Unauthorized Access      | TC-CMS-008                | High     | ⬜     |
|                    | Visual Elements          | TC-CMS-009                | Low      | ⬜     |
|                    | Responsiveness           | TC-CMS-010                | Medium   | ⬜     |

**Coverage Summary:**

-   Total Test Cases: 22
-   High Priority: 12
-   Medium Priority: 7
-   Low Priority: 3

---

## 6. Test Execution Procedures

### 6.1 Automated Testing with Playwright

**Prerequisites:**

1. Ensure application is running: `php artisan serve`
2. Verify test users are seeded: `php artisan db:seed --class=UserSeeder`

**Running Tests:**

```bash
# Run all E2E tests
npm run test:e2e

# Run only authentication tests
npm run test:auth

# Run only CMS tests
npm run test:cms

# Run tests with UI mode (for debugging)
npm run test:e2e:ui

# Run tests in headed mode (see browser)
npm run test:e2e:headed

# Generate and view HTML report
npm run test:report
```

**Test Execution Flow:**

1. Playwright launches configured browsers (Chromium, Firefox, WebKit)
2. Tests run in parallel (can be configured)
3. Screenshots captured on failure
4. Videos recorded for failed tests
5. Results compiled in HTML report

---

### 6.2 Manual Testing Procedures

**Test Execution Steps:**

1. **Preparation:**

    - Print or open this document
    - Ensure test environment is ready
    - Clear browser cache and cookies
    - Open test data spreadsheet

2. **Execution:**

    - Follow test cases sequentially
    - Execute each step precisely as documented
    - Record actual results
    - Mark status (Pass/Fail)
    - Take screenshots for failures
    - Note any deviations

3. **Recording Results:**

    - Update "Actual Results" field
    - Check Pass/Fail status
    - Attach screenshots if applicable
    - Log defects in issue tracker

4. **Defect Reporting:**
    - Use standardized defect template
    - Include: Test Case ID, Steps to Reproduce, Expected vs Actual, Screenshots
    - Assign severity and priority
    - Link to test case

---

### 6.3 Test Data Management

**Test Users:**

-   Keep test credentials secure
-   Reset test data between test cycles
-   Use dedicated test database

**Database Reset:**

```bash
php artisan migrate:fresh --seed
```

---

## 7. Test Results Summary

### 7.1 Execution Summary

**Test Cycle:** _[Cycle Number]_  
**Tested By:** _[Tester Name]_  
**Test Date:** _[Date]_  
**Environment:** _[Development/Staging/Production]_  
**Browser:** _[Chrome/Firefox/Safari]_  
**Application Version:** _[Version Number]_

| Category       | Total  | Passed | Failed | Blocked | Not Run |
| -------------- | ------ | ------ | ------ | ------- | ------- |
| Authentication | 10     |        |        |         |         |
| CMS Dashboard  | 12     |        |        |         |         |
| **Total**      | **22** |        |        |         |         |

**Pass Rate:** \_\_\_\_%

---

### 7.2 Defect Summary

| Severity  | Count | Percentage |
| --------- | ----- | ---------- |
| Critical  |       |            |
| High      |       |            |
| Medium    |       |            |
| Low       |       |            |
| **Total** |       |            |

---

### 7.3 Test Metrics

-   **Test Execution Time:** _[Time]_
-   **Defect Detection Rate:** _[Rate]_
-   **Test Coverage:** _[Percentage]_
-   **Automation Coverage:** _[Percentage]_

---

## 8. Known Issues

### 8.1 Open Defects

| ID  | Test Case | Description | Severity | Status | Assigned To |
| --- | --------- | ----------- | -------- | ------ | ----------- |
|     |           |             |          |        |             |

---

### 8.2 Workarounds

_[Document any workarounds for known issues]_

---

## 9. Appendix

### 9.1 Test Environment URLs

-   **Application URL:** http://localhost:8000
-   **Login URL:** http://localhost:8000/login
-   **Dashboard URL:** http://localhost:8000/cms/dashboard

---

### 9.2 Test Credentials Reference

```
Ketua Account:
  Email: ketua@karangtaruna.test
  Password: password

Admin Data Account:
  Email: admin@karangtaruna.test
  Password: password

Anggota Account:
  Email: anggota@karangtaruna.test
  Password: password
```

---

### 9.3 Browser Compatibility Matrix

| Browser | Version | Supported | Tested |
| ------- | ------- | --------- | ------ |
| Chrome  | Latest  | ✅        | ⬜     |
| Firefox | Latest  | ✅        | ⬜     |
| Safari  | Latest  | ✅        | ⬜     |
| Edge    | Latest  | ✅        | ⬜     |

---

### 9.4 Screenshots Repository

Screenshots for test failures should be stored in:

```
/screenshots/
  /auth/
  /cms/
```

---

### 9.5 Related Documents

-   Technical Specification Document
-   User Requirements Document
-   API Documentation
-   Deployment Guide

---

### 9.6 Glossary

-   **Black Box Testing:** Testing method that examines functionality without knowledge of internal code
-   **E2E Testing:** End-to-end testing that tests complete user flows
-   **RBAC:** Role-Based Access Control
-   **CMS:** Content Management System
-   **Playwright:** Modern end-to-end testing framework

---

### 9.7 Revision History

| Version | Date       | Author  | Changes                   |
| ------- | ---------- | ------- | ------------------------- |
| 1.0     | 2026-01-02 | QA Team | Initial document creation |

---

## Contact Information

**QA Team Lead:** _[Name]_  
**Email:** _[Email]_  
**Project Manager:** _[Name]_  
**Development Team:** _[Contact]_

---

**Note:** This document should be updated after each test cycle to reflect the current state of testing.
