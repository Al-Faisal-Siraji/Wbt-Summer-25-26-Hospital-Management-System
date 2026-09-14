<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

/* =========================================================
   PATIENT LOGIN CHECK
   ========================================================= */

if (!isset($_SESSION["user_id"])) {
    header("Location: router.php?page=login");
    exit();
}

$role = strtolower(trim($_SESSION["role"] ?? ""));

if ($role !== "patient") {
    header("Location: router.php?page=login");
    exit();
}

require_once BASE_PATH . "/views/partials/database.php";

$firstName = $_SESSION["first_name"] ?? "Patient";


/* =========================================================
   GET ALL DOCTORS
   ========================================================= */

$doctors = [];

$sql = "
    SELECT
        d.doctor_id,
        d.specialization,
        d.consultation_fee,
        d.availability_status,
        u.first_name,
        u.last_name,
        dep.department_name
    FROM doctors d

    INNER JOIN users u
        ON d.user_id = u.user_id

    INNER JOIN departments dep
        ON d.department_id = dep.department_id

    ORDER BY
        dep.department_name ASC,
        u.first_name ASC
";

$result = mysqli_query($conn, $sql);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {

        $doctors[] = $row;

    }

}

?>