# Admin Help Center Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Menambah pusat bantuan di panel admin dengan FAQ/panduan CMS per kategori, CRUD untuk admin, read-only untuk editor.

**Architecture:** Modul `HelpArticle` terpisah (enum kategori, policy admin-only untuk write). Dua halaman Livewire: Index (baca) dan Manage+Form (kelola). Seed contoh konten.

**Tech Stack:** Laravel 13, Livewire 3, Blade, Alpine (accordion), PHPUnit

## Global Constraints

- Policy write: `admin` only; read: `admin` + `editor`
- Kategori: enum `HelpCategory` (9 nilai tetap)
- Editor hanya melihat `is_published = true` di halaman baca
- Ikuti pola Livewire admin existing (`Contents`, `SettingPolicy`)

---

### Task 1: Domain layer

**Files:**
- Create: `app/Enums/HelpCategory.php`
- Create: `database/migrations/2026_07_14_000005_create_help_articles_table.php`
- Create: `app/Models/HelpArticle.php`
- Create: `app/Policies/HelpArticlePolicy.php`
- Modify: `app/Providers/AppServiceProvider.php`

- [ ] Enum + migrasi + model + policy + register Gate

### Task 2: Seeder

**Files:**
- Create: `database/seeders/HelpArticleSeeder.php`
- Modify: `database/seeders/DatabaseSeeder.php`

- [ ] Seed contoh per kategori

### Task 3: Livewire read page

**Files:**
- Create: `app/Livewire/Admin/Help/Index.php`
- Create: `resources/views/livewire/admin/help/index.blade.php`
- Modify: `routes/admin.php`
- Modify: `resources/views/layouts/admin.blade.php`

- [ ] Halaman baca dengan search + accordion per kategori

### Task 4: Livewire manage + form

**Files:**
- Create: `app/Livewire/Admin/Help/Manage.php`
- Create: `app/Livewire/Admin/Help/Form.php`
- Create: `resources/views/livewire/admin/help/manage.blade.php`
- Create: `resources/views/livewire/admin/help/form.blade.php`
- Modify: `routes/admin.php`

- [ ] CRUD admin-only

### Task 5: Tests

**Files:**
- Create: `tests/Feature/HelpArticlePolicyTest.php`
- Create: `tests/Feature/HelpCenterTest.php`

- [ ] Policy + route access tests

### Task 6: Verify

- [ ] `php artisan migrate --seed` (atau migrate fresh)
- [ ] `php artisan test --filter=Help`
- [ ] Commit
