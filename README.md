# Sembark URL Shortener

A Laravel 12 URL Shortener application with role-based access control, client invitation system, short URL generation, click tracking, and analytics.

## Features

- **Authentication**: Login/Logout system with session-based authentication
- **User Roles**: Super Admin, Admin, and Member roles with granular permissions
- **Client Management**: Super Admin and Admin can invite clients; clients are created with invited status
- **Invite System**: Email-based invitation with invite token; clients accept invites to set their password and activate their account
- **Short URL Generation**: Generate short URLs with unique short codes (Admin and Member only)
- **URL Redirection**: Public short URL redirect (no login required) with automatic hit tracking
- **URL Analytics**: View URL listings with hit counts, filterable by period (Today, Last Week, Last Month)
- **Dashboard**: Overview with total URLs and total users count
- **Settings**: Super Admin can manage project branding (logo, favicon, project name, admin contact details)
- **Responsive UI**: Built with Bootstrap and AdminLTE-style layout

## User Roles & Permissions

| Role | Can Generate URLs | Can View URL List | Can Access Settings | URL List Scope |
|------|------------------|-------------------|---------------------|----------------|
| Super Admin | ❌ No | ✅ Yes (all URLs) | ✅ Yes | All URLs across all companies |
| Admin | ✅ Yes | ✅ Yes (own + child clients) | ❌ No | Own URLs + URLs from child clients (where client_id = admin's id) |
| Member | ✅ Yes | ✅ Yes (own only) | ❌ No | Own URLs only |

## Database Design

### Tables

**users**
- `id` (BIGINT, PK) - Auto-increment
- `client_id` (BIGINT, nullable, FK → users.id) - NULL for Super Admin and client owner admins
- `name` (VARCHAR 150) - Client name for owner admins
- `email` (VARCHAR 190, unique)
- `password_hash` (VARCHAR 255, nullable) - NULL until invite accepted
- `role` (ENUM: super_admin, admin, member) - Default: member
- `status` (ENUM: invited, active) - Default: invited
- `invite_token` (CHAR 64, unique) - SHA-256 token for invite acceptance
- `created_at`, `updated_at` (TIMESTAMP)

**short_urls**
- `id` (BIGINT, PK) - Auto-increment
- `user_id` (BIGINT, FK → users.id)
- `short_code` (VARCHAR 16, unique)
- `long_url` (TEXT)
- `hits` (BIGINT, default 0)
- `created_at`, `updated_at` (TIMESTAMP)

**url_hits**
- `id` (BIGINT, PK) - Auto-increment
- `short_url_id` (BIGINT, FK → short_urls.id)
- `hit_at` (DATETIME)
- Index: (short_url_id, hit_at)

**cs_theme_admins**
- Site settings table for logo, favicon, project name, admin contact details

## Installation

### Requirements
- PHP 8.1+
- Composer
- MySQL 5.7+
- Node.js & NPM (for asset compilation)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/url-shortner.git
   cd url-shortner
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure `.env`**
   Update the following in your `.env` file:
   ```env
   APP_NAME=URL Shortener
   APP_ENV=local
   APP_KEY=base64:...
   APP_DEBUG=true
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=url_shortener
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email@gmail.com
   MAIL_PASSWORD=your_app_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"

   NO_IMAGE=http://127.0.0.1:8000/img/defaultimage.jpg
   SETTING_IMAGE=http://127.0.0.1:8000/img/uploads/settings/
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

   This creates:
   - `users` table with seed data (1 Super Admin, 1 Admin client owner, 1 Member)
   - `short_urls` table with sample short URLs
   - `url_hits` table for click tracking
   - `cs_theme_admins` table with default settings
   - `sessions` table for session storage

7. **Start the development server**
   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000` to access the application.

### Default Seed Data

| ID | Name | Email | Role | Status | client_id |
|----|------|-------|------|--------|-----------|
| 1 | Super Admin | superadmin@example.com | super_admin | active | NULL |
| 2 | Sembark Tech | sembark@example.com | admin | active | NULL |
| 3 | User 2 | user2@example.com | member | active | 2 |

---

## Invite Flow

1. **Super Admin or Admin** visits `/clients/invite-client`
2. Fills in Client Name, Client Email, and selects Role (Admin or Member)
3. System creates the user with `status='invited'`, generates an `invite_token`, and sends an email
4. **Client** receives email with invite link: `/accept-invite/{token}`
5. Client clicks the link, sets their password
6. System updates `status='active'`, clears `invite_token`
7. Client can now login at `/`

---

## URL Short URL Flow

1. **Admin or Member** visits `/urls/generate-url`
2. Enters the long URL and clicks Generate
3. System creates a unique 6-character short code and saves to `short_urls` table
4. **Anyone** can visit `/s/{short_code}` (no login required)
5. System increments hit count, records the hit in `url_hits`, and redirects to the long URL

---

## URL Analytics

- Visit `/urls/url-list` to see all URLs accessible to your role
- Filter by period: Today, Last Week, Last Month
- View total hits per URL within the selected period
- Reset filter to view all URLs

---

## Project Structure

```
url-shortner/
├── app/
│   ├── Http/Controllers/
│   │   └── website/
│   │       ├── ClientController.php
│   │       ├── Controller.php (base with middleware)
│   │       ├── DashboardController.php
│   │       ├── LoginController.php
│   │       ├── SettingsController.php
│   │       └── UrlController.php
│   ├── Mail/
│   │   └── SendingEmail.php
│   └── Models/
│       ├── ShortUrl.php
│       ├── UrlHit.php
│       ├── User.php
│       └── CsThemeAdmin.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── CsThemeAdminSeeder.php
│       └── DatabaseSeeder.php
├── resources/views/
│   └── website/
│       ├── layouts/
│       │   ├── master.blade.php
│         ├── login.blade.php
│         ├── auth_master.blade.php
│         ├── elements/
│       │   ├── main_menu.blade.php
│         │   ├── message.blade.php
│       │   └── pagination.blade.php
│       ├── clients/
│       │   ├── index.blade.php
│       │   ├── invite.blade.php
│       │   └── accept-invite.blade.php
│       ├── urls/
│       │   ├── index.blade.php
│       │   └── generate.blade.php
│       ├── settings/
│       │   └── edit.blade.php
│       └── emails/
│           └── client-invite.blade.php
├── routes/web.php
└── .env
```

---

## Development Credits

Code debugging provided by **Nemotron-3.5-super-vl AI model** (NVIDIA) Mention Manually by Aman Kumawat.

---
