This project is built as part of a Laravel Developer Final Assignment, with emphasis on clean architecture, performance, and correctness, rather than UI polish.


 Authentication & Authorization

Single users table with role-based access (admin, customer)

Customer registration via UI

Admin users created via seeder

Single AuthController

Route protection using middleware (auth, role:admin)

Separate dashboards for Admin and Customer

Product Management (Admin)
----------------------------------------------

Full CRUD for products

Fields:

name

description

price

category

stock

image (default fallback)

Clean controller and model separation

Validation at request level

Bulk Product Import 
----------------------------------

CSV / Excel upload

Chunked reading (1000 rows)

Background processing using Laravel Queues

Progress tracking using import_jobs table

Import lifecycle handled via Excel events

Default image automatically applied if missing

No request timeout (queue-based)

Sample file included:
------------------------------------

products_sample_import.csv

 (WebSockets) for online offline check
 -------------------------------------------


Laravel WebSockets (local, no Pusher account)

Presence Channels (no polling)

Live Online / Offline customer status

Status stored in DB (is_online)

Updates broadcast on:

presence-customers.online


Admin dashboard reflects changes instantly

Testing (Phase 7)

Uses SQLite in-memory database for fast tests

Tests run using:

php artisan test

Feature Tests
-------------------------------
Admin product creation

Admin bulk product import

Unit Tests

Product default image logic

All tests pass successfully.

Tech Stack
Layer	Technology
Backend	Laravel 10
Auth	Laravel Session Auth
Realtime	Laravel WebSockets
Queues	Database Queue
Import	maatwebsite/excel
Frontend	Blade + Bootstrap
Tests	PHPUnit
Build Tool	Vite
Setup Instructions
Clone Repository
git clone https://github.com/piyushkantt/product-management-system.git
cd product-management-system

Use bellow Command to Install Dependencies
---------------------------------------------
composer install
npm install

Environment Setup
--------------------------
cp .env.example .env
php artisan key:generate


Update database credentials in .env.

Migrate & Seed
-----------------------------
php artisan migrate
php artisan db:seed

Seeder creates an Admin user.
----------------------------

Build Frontend Assets
<!-- -----------------------------/// documentation writen by Piush Kant tripathi---------///////// -->
npm run build

Start Services
---------------------------

Open three terminals:

Terminal 1 – Laravel

php artisan serve


Terminal 2 – WebSockets

php artisan websockets:serve


Terminal 3 – Queue Worker

php artisan queue:work

 Default Admin Credentials (Seeder)
 <!-- ----------------------- you may change using AdminSeeder---------------- -->
Email: admin@example.com
Password: password


<!-- --------------------------- -->

Import Flow Explanation

Admin uploads CSV

Rows counted for progress tracking

Import job stored in DB

File processed in background

Progress updated row-by-row

Status set to completed after import event

<!-- To run Test I have used laravel build in UNIT testing tool -->
php artisan test


Uses:

SQLite in-memory database

Sync queue

Broadcasting disabled for isolation

 Architectural Decisions

Single User table → simpler auth & tests

Model-level defaults → consistent business rules

Excel Events instead of destructors → deterministic & test-safe

Presence Channels → real-time without polling

Queue-based imports → scalable to 100k+ rows



-----------Author------------------

Piyush Kant Tripathi
Laravel / Full-Stack Developer