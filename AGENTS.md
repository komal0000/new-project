# AGENTS.md - Project Guidelines

## Project Overview

Laravel 11 journal/publication management system. Two roles: Admin (`role:0`) and Client (`role:1`). Manages books, articles, editorial teams, submissions, FAQs, policies, board messages, associates.

## Tech Stack

PHP 8.2+ · Laravel 11 · Vite 5 · Summernote 0.8.20 (rich text) · Spatie PDF-to-Image 1.2 · PHPUnit 11 · Laravel Pint · Laravel Sail.

## Setup & Commands

```bash
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate          # SQLite by default
php artisan serve            # dev server
npm run dev                  # frontend dev
npm run build                # production assets
./vendor/bin/pint            # format code
php artisan test             # run tests (only default example tests exist; DB conn commented out in phpunit.xml)
```

## Architecture

**Custom compiled-view caching:** Admin controllers have `render()` methods that query the DB, render Blade templates from `resources/views/admin/templete/`, and write output as static `.blade.php` files into `resources/views/front/cache/` (gitignored). Frontend views `@include`/`@extend` from this cache dir. Regenerated whenever admin data changes.

**Database access:** All models except `User` are bare stubs — no `$fillable`, `$guarded`, or relationships. Controllers use `DB::table()` + manual property assignment instead of Eloquent. Follow this pattern for new features; the schema below is the source of truth since models don't declare it.

**Custom helpers** (`app/custom.php`, autoloaded via autoload-dev):

- `vasset($file)` — versioned asset URL via `config('app.version')`
- `isGet()` — check if request is GET
- `submissionStatues()` / `submissionStatusMsg()` / `submissionStatusColors()` — status array / labels / CSS classes
- `getGeneralLayout()` — cached layout settings (`Cache::rememberForever`)
- `getArticleDetail($article_id)` — empty stub
- `t_books` — table name constant

## Roles & Middleware

`RoleManager` middleware (alias `role`), registered in `bootstrap/app.php`. `role:0` = Admin (`/admin/*`), `role:1` = Client (`/client/*`). Unauthenticated users redirect to the appropriate login. Admin login uses session-based random field-name obfuscation.

## Routes

No `routes/api.php`.

- **Public** (no middleware): home, about, policy, contact, guidelines, archive, book/article single views, team, board message, register, client login/logout.
- **Admin** (`admin.*`, `role:0`): login/logout, dashboard, books (CRUD + nested articles/article-authors), teams, submissions (list + status update), authors, guidelines (+cache render), FAQs (+cache render), board messages (+cache render), settings (layout/policies/about/contacts/article-types/associates), file serving.
- **Client** (`client.*`, `role:1`): login, dashboard, submissions (CRUD + soft-cancel), profile (password/info), file serving.

## Database Schema

Field lists are canonical since models don't declare `$fillable`/relationships.

- **users**: id, name, email(unique), email_verified_at, password, remember_token, role(uint,def 0), timestamps
- **books**: id, title, eng_title, issn, doi, website, language_of_publication, image(text), file(text), description(text), issue(date), published_date(date), iscurrent(bool,def false), s_description(text,null), issue_name(str,null), volume(str,null), slug(str,null,unique), timestamps
- **book_articals**: id, title(text), doi, abstract(text), file(text), tags, artical_type_id(FK,null), book_id(FK,null), st_page_no(int,null), en_page_no(int,null), slug(null,unique), timestamps
- **book_artical_authors**: id, book_artical_id(FK,null), author_id(FK,null), author_name(null), book_id(FK,null), timestamps
- **authors**: id, name, designation, organization, link, user_id(FK,null), timestamps
- **teams**: id, title, desc(text), timestamps
- **team_members**: id, name, address, email, phone, detail(text), organization, team_designation, designation, team_id(FK,null), timestamps
- **submissions**: id, user_id(FK,null), title, description(text), file, status(tinyint,def 0), canceled(bool,def false), on_review_date/reviewed_date/accepted_date/rejected_date/hold_date(date,null), file_id(FK), timestamps. Status: 0=Pending,1=On Review,2=Reviewed,3=Accepted,4=Rejected,5=On Hold
- **clients**: id, name, affiliation, country, user_id(FK,null), timestamps
- **files**: id, path(text), user_id(FK), timestamps
- **faqs**: id, title, answer, timestamps
- **policies**: id, title, description(text), timestamps
- **abouts**: id, title, description(text), sub_title(str,null), timestamps
- **guidelines**: id, title, description(text), timestamps
- **contacts**: id, address, po_box, phone, name, email (all str,null), timestamps
- **individual_contacts**: id, name(null), post(null), phone(text,null), email(text,null), timestamps
- **generallayouts**: id, copy_right_name, short_desc(text), long_desc(text), logo(text), content(null), fav(text,null), timestamps
- **associates**: id, link, image(text), timestamps
- **associatetitles**: id, title, timestamps
- **artical_types**: id, name, timestamps
- **board_messages**: id, slug(unique), title(text), image(text), desc(text), timestamps
- **settings**, **book_chapters**: empty (id, timestamps only)

## Models

23 models in `app/Models/`, one per table above. All are bare `Model` + `HasFactory` stubs **except `User.php`**, which has `$fillable`, `$hidden`, `$casts`.

## Controllers

- **Root**: `Controller` (base) · `DashbordController` (admin dashboard) · `FrontController` (all public pages) · `LoginController` (admin+client auth, field obfuscation)
- **Admin** (`app/Http/Controllers/admin/`): `AuthorController` · `BookController` (largest, ~360 lines: books+articles+article-authors CRUD, `render()`) · `TeamController` (+`render()`) · `TeamMemberController` (routes commented out) · `SubmissionController` (list/status) · `GuidelineController` (+`cache()`) · `FaqController` (+`render()`) · `SettingController` (~228 lines: layout/policies/about/article-types/associates) · `ContactController` (+`render()`) · `FileController` (serves `storage/submissions/`) · `BoardMessageController` (+`render()`)
- **Client** (`app/Http/Controllers/client/`): `ClientController` (dashboard, files) · `SubmissionController` (own submissions + soft-cancel) · `InfoController` (password/profile)

## File Storage

- **`local` disk**: root is `public_path()` (not `storage_path('app')`) — uploads go to `public/uploads/{artical,associate,file,image,setting,submission}/`
- **`sub` disk**: private, at `storage_path('submissions')` — used by `FileController`/`ClientController` to serve submission files

## Config

- `config/app.php`: `title` (`APP_TITLE`) · `version` (`APP_VERSION`, cache-busting) · `lockout` (admin login lockout secs, default 20) · `tries` (max attempts, default 4)
- `config/filesystems.php`: `local` root → `public_path()`; custom `sub` disk
- `config/auth.php`: references a `client` guard — not fully configured (see Known Issues)

## Views

```
resources/views/
├── admin/templete/     # source templates → compiled to front/cache/
├── admin/{author,book,faq,guideline,message,setting,submission,team,team_member}/
├── admin/layout/        # admin layout, datatable, jshelper
├── client/{profile,submission}/, client/layout/
├── front/cache/         # compiled views (gitignored)
├── front/layout/, front/{aboutus,article,contact,guidelines,issue,login,message,policy,register,team}/
```

## Code Style & Naming

PSR-12, 4-space indent, LF endings (`.editorconfig`). Format with `./vendor/bin/pint`. Prefer `DB::table()` over Eloquent (existing pattern).

**Preserve existing typos/misspellings when editing — don't "fix" them:**
`DashbordController` (not Dashboard) · `artical` (not article — tables, models, controllers, views) · `templete` (not template — view dir) · `poilcy` (not policy — some view filenames) · `submition` (not submission — some contexts)

## Known Issues

- Team member routes commented out in `routes/web.php`
- `config/auth.php` references undefined `clients` provider
- `getArticleDetail()` in `app/custom.php` is an empty stub
- No custom test coverage; `phpunit.xml` DB connection commented out (no in-memory SQLite)
- `new_project` binary file at project root (purpose unknown)

## Git

Clear, focused commits. Run `php artisan test` and `./vendor/bin/pint` before committing.
