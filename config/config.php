<?php

// Application-wide configuration, database connection, and session settings.
$projectPath = dirname(__DIR__);
$environmentFile = $projectPath . '/.env';
if (is_file($environmentFile)) {
    foreach (parse_ini_file($environmentFile, false, INI_SCANNER_RAW) ?: [] as $key => $value) {
        putenv($key . '=' . $value);
    }
}

define('BASE_PATH', $projectPath);
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/'));
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'hospital_management');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('SESSION_TIMEOUT', 1800);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    exit('Database connection failed.');
}
mysqli_set_charset($conn, 'utf8mb4');
