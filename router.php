<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/helpers/helpers.php';
require_once __DIR__ . '/models/user_model.php';
require_once __DIR__ . '/controllers/auth_controller.php';
require_once __DIR__ . '/controllers/admin_controller.php';
require_once __DIR__ . '/controllers/doctor_controller.php';
require_once __DIR__ . '/controllers/patient_controller.php';
require_once __DIR__ . '/controllers/receptionist_controller.php';

$page = strtolower(trim($_GET['page'] ?? 'login'));

if (in_array($page, ['login', 'index', 'register', 'signup', 'logout'], true)) {
    auth_controller($page);
} elseif (str_starts_with($page, 'admin')) {
    admin_controller($page);
} elseif (str_starts_with($page, 'doctor')) {
    doctor_controller($page);
} elseif (in_array($page, ['patient', 'appointments', 'book_appointment', 'doctors', 'queue'], true)) {
    patient_controller($page);
} elseif (str_starts_with($page, 'receptionist') || $page === 'manage_appointments') {
    receptionist_controller($page);
} else {
    http_response_code(404);
    exit('Page not found.');
}
