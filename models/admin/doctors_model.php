<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: router.php?page=login");
    exit();
}

require_once BASE_PATH . "/views/partials/database.php";

$firstName = $_SESSION["first_name"];


/* =========================================================
   DELETE DOCTOR
   ========================================================= */

if (isset($_GET["delete"])) {

    $doctor_id = intval($_GET["delete"]);

    // Get connected user_id
    $stmt = mysqli_prepare($conn, 
        "SELECT user_id FROM doctors WHERE doctor_id = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $doctor = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if ($doctor) {

        $user_id = $doctor["user_id"];

        /*
         * Delete doctor record first.
         */
        $deleteDoctor = mysqli_prepare($conn, 
            "DELETE FROM doctors WHERE doctor_id = ?"
        );

        mysqli_stmt_bind_param($deleteDoctor, "i", $doctor_id);
        mysqli_stmt_execute($deleteDoctor);
        mysqli_stmt_close($deleteDoctor);


        /*
         * Delete the connected doctor user account.
         */
        $deleteUser = mysqli_prepare($conn, 
            "DELETE FROM users
             WHERE user_id = ?
             AND role = 'doctor'"
        );

        mysqli_stmt_bind_param($deleteUser, "i", $user_id);
        mysqli_stmt_execute($deleteUser);
        mysqli_stmt_close($deleteUser);
    }

    header("Location: admin_doctors.php?message=deleted");
    exit();
}


/* =========================================================
   TOGGLE AVAILABILITY
   ========================================================= */

if (isset($_GET["toggle"])) {

    $doctor_id = intval($_GET["toggle"]);

    $stmt = mysqli_prepare($conn, 
        "SELECT availability_status
         FROM doctors
         WHERE doctor_id = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $doctor = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if ($doctor) {

        if ($doctor["availability_status"] === "available") {

            $newStatus = "unavailable";

        } else {

            $newStatus = "available";
        }


        $update = mysqli_prepare($conn, 
            "UPDATE doctors
             SET availability_status = ?
             WHERE doctor_id = ?"
        );

        mysqli_stmt_bind_param($update, 
            "si",
            $newStatus,
            $doctor_id
        );

        mysqli_stmt_execute($update);
        mysqli_stmt_close($update);
    }

    header("Location: admin_doctors.php?message=status");
    exit();
}


/* =========================================================
   ADD DOCTOR
   ========================================================= */

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["add_doctor"])
) {

    $user_id = intval($_POST["user_id"]);
    $department_id = intval($_POST["department_id"]);
    $specialization = trim($_POST["specialization"]);
    $consultation_fee = floatval($_POST["consultation_fee"]);
    $availability_status = $_POST["availability_status"];


    /*
     * Check whether the selected user already
     * has a doctor profile.
     */

    $check = mysqli_prepare($conn, 
        "SELECT doctor_id
         FROM doctors
         WHERE user_id = ?"
    );

    mysqli_stmt_bind_param($check, "i", $user_id);
    mysqli_stmt_execute($check);

    $checkResult = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($checkResult) > 0) {

        mysqli_stmt_close($check);

        header("Location: admin_doctors.php?message=exists");
        exit();
    }

    mysqli_stmt_close($check);


    /*
     * Make sure selected user has doctor role.
     */

    $checkUser = mysqli_prepare($conn, 
        "SELECT user_id
         FROM users
         WHERE user_id = ?
         AND role = 'doctor'"
    );

    mysqli_stmt_bind_param($checkUser, "i", $user_id);
    mysqli_stmt_execute($checkUser);

    $userResult = mysqli_stmt_get_result($checkUser);

    if (mysqli_num_rows($userResult) === 0) {

        mysqli_stmt_close($checkUser);

        header("Location: admin_doctors.php?message=invalid_user");
        exit();
    }

    mysqli_stmt_close($checkUser);


    /*
     * Insert doctor profile.
     */

    $stmt = mysqli_prepare($conn, 
        "INSERT INTO doctors
        (
            user_id,
            department_id,
            specialization,
            consultation_fee,
            availability_status
        )
        VALUES (?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, 
        "iisds",
        $user_id,
        $department_id,
        $specialization,
        $consultation_fee,
        $availability_status
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    header("Location: admin_doctors.php?message=added");
    exit();
}


/* =========================================================
   EDIT DOCTOR
   ========================================================= */

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["edit_doctor"])
) {

    $doctor_id = intval($_POST["doctor_id"]);
    $department_id = intval($_POST["department_id"]);
    $specialization = trim($_POST["specialization"]);
    $consultation_fee = floatval($_POST["consultation_fee"]);
    $availability_status = $_POST["availability_status"];


    $stmt = mysqli_prepare($conn, 
        "UPDATE doctors
         SET
            department_id = ?,
            specialization = ?,
            consultation_fee = ?,
            availability_status = ?
         WHERE doctor_id = ?"
    );

    mysqli_stmt_bind_param($stmt, 
        "isdsi",
        $department_id,
        $specialization,
        $consultation_fee,
        $availability_status,
        $doctor_id
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    header("Location: admin_doctors.php?message=updated");
    exit();
}


/* =========================================================
   GET ALL DOCTORS
   ========================================================= */

$sql = "
SELECT
    doctors.doctor_id,
    doctors.user_id,
    doctors.department_id,
    doctors.specialization,
    doctors.consultation_fee,
    doctors.availability_status,
    doctors.created_at,

    users.first_name,
    users.last_name,
    users.email,

    departments.department_name

FROM doctors

INNER JOIN users
    ON doctors.user_id = users.user_id

INNER JOIN departments
    ON doctors.department_id = departments.department_id

ORDER BY doctors.doctor_id ASC
";

$doctors = mysqli_query($conn, $sql);


/* =========================================================
   GET DOCTOR USERS THAT ARE NOT YET IN DOCTORS TABLE
   ========================================================= */

$doctorUsers = mysqli_query($conn, "
    SELECT
        users.user_id,
        users.first_name,
        users.last_name,
        users.email

    FROM users

    LEFT JOIN doctors
        ON users.user_id = doctors.user_id

    WHERE users.role = 'doctor'
    AND doctors.doctor_id IS NULL

    ORDER BY users.first_name ASC
");


/* =========================================================
   GET DEPARTMENTS
   ========================================================= */

$departments = mysqli_query($conn, "
    SELECT
        department_id,
        department_name

    FROM departments

    ORDER BY department_name ASC
");

$editDepartments = mysqli_query($conn, "
    SELECT department_id, department_name
    FROM departments
    ORDER BY department_name ASC
");

?>
