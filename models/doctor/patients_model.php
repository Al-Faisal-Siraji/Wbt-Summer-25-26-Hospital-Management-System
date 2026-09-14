<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

require_once BASE_PATH . "/views/partials/database.php";

/* =========================================================
   1. CHECK LOGIN
   ========================================================= */

if (!isset($_SESSION["user_id"])) {
    header("Location: router.php?page=login");
    exit();
}

$user_id = (int) $_SESSION["user_id"];


/* =========================================================
   2. GET USER
   ========================================================= */

$user_sql = "
    SELECT user_id, first_name, last_name, email, role
    FROM users
    WHERE user_id = ?
    LIMIT 1
";

$user_stmt = mysqli_prepare($conn, $user_sql);
mysqli_stmt_bind_param($user_stmt, "i", $user_id);
mysqli_stmt_execute($user_stmt);

$user_result = mysqli_stmt_get_result($user_stmt);
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    session_destroy();
    header("Location: router.php?page=login");
    exit();
}


/* =========================================================
   3. CHECK DOCTOR ROLE
   ========================================================= */

$role = strtolower(trim($user["role"]));

if ($role !== "doctor") {
    header("Location: router.php?page=login");
    exit();
}

$_SESSION["role"] = "doctor";

$doctor_name =
    $user["first_name"] . " " . $user["last_name"];


/* =========================================================
   4. GET DOCTOR PROFILE
   ========================================================= */

$doctor_sql = "
    SELECT
        d.doctor_id,
        d.specialization,
        d.consultation_fee,
        d.availability_status,
        dep.department_name
    FROM doctors d
    LEFT JOIN departments dep
        ON d.department_id = dep.department_id
    WHERE d.user_id = ?
    LIMIT 1
";

$doctor_stmt = mysqli_prepare($conn, $doctor_sql);
mysqli_stmt_bind_param($doctor_stmt, "i", $user_id);
mysqli_stmt_execute($doctor_stmt);

$doctor_result = mysqli_stmt_get_result($doctor_stmt);
$doctor = mysqli_fetch_assoc($doctor_result);

if (!$doctor) {
    die("Doctor profile not found.");
}

$doctor_id = (int) $doctor["doctor_id"];


/* =========================================================
   5. SEARCH PATIENTS
   ========================================================= */

$search = "";

if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}


/* =========================================================
   6. GET PATIENTS
   ========================================================= */

$patients = [];

if ($search !== "") {

    $search_value = "%" . $search . "%";

    $patient_sql = "
        SELECT
            u.user_id,
            u.first_name,
            u.last_name,
            u.email,
            COUNT(a.appointment_id) AS total_appointments,
            MAX(a.appointment_date) AS last_visit
        FROM users u
        INNER JOIN appointments a
            ON a.patient_id = u.user_id
        WHERE a.doctor_id = ?
        AND u.role = 'patient'
        AND (
            u.first_name LIKE ?
            OR u.last_name LIKE ?
            OR u.email LIKE ?
        )
        GROUP BY
            u.user_id,
            u.first_name,
            u.last_name,
            u.email
        ORDER BY
            u.first_name ASC
    ";

    $patient_stmt = mysqli_prepare($conn, $patient_sql);

    mysqli_stmt_bind_param($patient_stmt, 
        "isss",
        $doctor_id,
        $search_value,
        $search_value,
        $search_value
    );

} else {

    $patient_sql = "
        SELECT
            u.user_id,
            u.first_name,
            u.last_name,
            u.email,
            COUNT(a.appointment_id) AS total_appointments,
            MAX(a.appointment_date) AS last_visit
        FROM users u
        INNER JOIN appointments a
            ON a.patient_id = u.user_id
        WHERE a.doctor_id = ?
        AND u.role = 'patient'
        GROUP BY
            u.user_id,
            u.first_name,
            u.last_name,
            u.email
        ORDER BY
            u.first_name ASC
    ";

    $patient_stmt = mysqli_prepare($conn, $patient_sql);

    mysqli_stmt_bind_param($patient_stmt, 
        "i",
        $doctor_id
    );
}

mysqli_stmt_execute($patient_stmt);

$patient_result = mysqli_stmt_get_result($patient_stmt);

while ($row = mysqli_fetch_assoc($patient_result)) {
    $patients[] = $row;
}


/* =========================================================
   7. PATIENT STATISTICS
   ========================================================= */

$total_patients = count($patients);

$total_visits = 0;

foreach ($patients as $patient) {
    $total_visits += (int) $patient["total_appointments"];
}


/* =========================================================
   8. GET TODAY'S PATIENT COUNT
   ========================================================= */

$today_sql = "
    SELECT COUNT(DISTINCT patient_id) AS total
    FROM appointments
    WHERE doctor_id = ?
    AND appointment_date = CURDATE()
";

$today_stmt = mysqli_prepare($conn, $today_sql);
mysqli_stmt_bind_param($today_stmt, "i", $doctor_id);
mysqli_stmt_execute($today_stmt);

$today_result = mysqli_stmt_get_result($today_stmt);
$today_row = mysqli_fetch_assoc($today_result);

$today_patients = (int) $today_row["total"];


/* =========================================================
   9. COMPLETED PATIENT VISITS
   ========================================================= */

$completed_sql = "
    SELECT COUNT(*) AS total
    FROM appointments
    WHERE doctor_id = ?
    AND LOWER(status) = 'completed'
";

$completed_stmt = mysqli_prepare($conn, $completed_sql);
mysqli_stmt_bind_param($completed_stmt, "i", $doctor_id);
mysqli_stmt_execute($completed_stmt);

$completed_result = mysqli_stmt_get_result($completed_stmt);
$completed_row = mysqli_fetch_assoc($completed_result);

$completed_visits = (int) $completed_row["total"];

?>