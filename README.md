# Hospital Management System

A plain PHP and MySQL hospital management system organized in the same front-controller MVC style as the referenced library-management project. Database access uses procedural MySQLi with prepared statements.

## Folder structure

```
hospital-managment-system/
├── router.php                Front controller: the application entry point
├── .htaccess                 Keeps older `*.php` links working through the router
├── .env.example              Local database-setting template
├── README.md
│
├── config/
│   └── config.php            Database connection, sessions, constants, app paths
├── helpers/
│   └── helpers.php           Escaping, redirects, and role guards
├── models/
│   ├── auth/                 Login and registration database logic
│   ├── admin/                Administration database logic
│   ├── doctor/               Doctor database logic, including follow-ups
│   ├── patient/              Patient database logic
│   └── receptionist/         Reception desk database logic
├── controllers/
│   ├── auth_controller.php
│   ├── admin_controller.php
│   ├── doctor_controller.php
│   ├── patient_controller.php
│   └── receptionist_controller.php
├── views/
│   ├── auth/                 Login and registration screens
│   ├── admin/                Admin dashboard and management screens
│   ├── doctor/               Doctor dashboard, queue, patients, and follow-ups
│   ├── patient/              Patient dashboard and appointment screens
│   └── receptionist/         Receptionist dashboard and desk screens
└── assets/
    ├── css/                  Stylesheets
    └── js/                   Client-side scripts
```

## Run in XAMPP

1. Put this folder inside `C:\xampp\htdocs\`.
2. Copy `.env.example` to `.env` and set database credentials if necessary.
3. Start Apache and MySQL.
4. Open `http://localhost/hospital-managment-system/`.

## Router format

All routes use the root front controller:

```
index.php?page=login
index.php?page=admin
index.php?page=doctor
index.php?page=patient
index.php?page=receptionist
```

The `.htaccess` file also maps old links such as `admin.php` to `router.php?page=admin`, so existing navigation remains usable.

## GitHub upload

bash
git init
git add .
git commit -m "Organize hospital system with plain PHP MVC"
```

Never commit `.env` or real credentials.
