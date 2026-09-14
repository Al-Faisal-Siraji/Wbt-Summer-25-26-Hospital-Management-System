<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: router.php?page=login");
    exit();
}

require_once BASE_PATH . "/views/partials/database.php";

$firstName = $_SESSION["first_name"];

/* =========================================================
   DELETE DEPARTMENT
   ========================================================= */
if (isset($_GET["delete"])) {

    $department_id = intval($_GET["delete"]);

    // Check if doctors are using this department
    $checkDoctors = mysqli_prepare($conn, 
        "SELECT COUNT(*) AS total FROM doctors WHERE department_id = ?"
    );
    mysqli_stmt_bind_param($checkDoctors, "i", $department_id);
    mysqli_stmt_execute($checkDoctors);

    $doctorResult = mysqli_stmt_get_result($checkDoctors)->fetch_assoc();
    $doctorCount = $doctorResult["total"];

    mysqli_stmt_close($checkDoctors);

    if ($doctorCount > 0) {

        $_SESSION["message"] =
            "This department cannot be deleted because doctors are assigned to it.";

        $_SESSION["message_type"] = "error";

    } else {

        $delete = mysqli_prepare($conn, 
            "DELETE FROM departments WHERE department_id = ?"
        );

        mysqli_stmt_bind_param($delete, "i", $department_id);

        if (mysqli_stmt_execute($delete)) {
            $_SESSION["message"] = "Department deleted successfully.";
            $_SESSION["message_type"] = "success";
        } else {
            $_SESSION["message"] = "Failed to delete department.";
            $_SESSION["message_type"] = "error";
        }

        mysqli_stmt_close($delete);
    }

    header("Location: admin_departments.php");
    exit();
}


/* =========================================================
   ADD DEPARTMENT
   ========================================================= */
if (isset($_POST["add_department"])) {

    $department_name = trim($_POST["department_name"]);
    $description = trim($_POST["description"]);

    if ($department_name === "") {

        $_SESSION["message"] = "Department name is required.";
        $_SESSION["message_type"] = "error";

    } else {

        // Check duplicate department
        $check = mysqli_prepare($conn, 
            "SELECT department_id FROM departments WHERE department_name = ?"
        );

        mysqli_stmt_bind_param($check, "s", $department_name);
        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {

            $_SESSION["message"] =
                "A department with this name already exists.";

            $_SESSION["message_type"] = "error";

        } else {

            $insert = mysqli_prepare($conn, 
                "INSERT INTO departments (department_name, description)
                 VALUES (?, ?)"
            );

            mysqli_stmt_bind_param($insert, 
                "ss",
                $department_name,
                $description
            );

            if (mysqli_stmt_execute($insert)) {

                $_SESSION["message"] =
                    "Department added successfully.";

                $_SESSION["message_type"] = "success";

            } else {

                $_SESSION["message"] =
                    "Failed to add department.";

                $_SESSION["message_type"] = "error";
            }

            mysqli_stmt_close($insert);
        }

        mysqli_stmt_close($check);
    }

    header("Location: admin_departments.php");
    exit();
}


/* =========================================================
   EDIT DEPARTMENT
   ========================================================= */
if (isset($_POST["edit_department"])) {

    $department_id = intval($_POST["department_id"]);
    $department_name = trim($_POST["department_name"]);
    $description = trim($_POST["description"]);

    if ($department_name === "") {

        $_SESSION["message"] =
            "Department name is required.";

        $_SESSION["message_type"] = "error";

    } else {

        // Check duplicate name except current department
        $check = mysqli_prepare($conn, 
            "SELECT department_id
             FROM departments
             WHERE department_name = ?
             AND department_id != ?"
        );

        mysqli_stmt_bind_param($check, 
            "si",
            $department_name,
            $department_id
        );

        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {

            $_SESSION["message"] =
                "Another department already uses this name.";

            $_SESSION["message_type"] = "error";

        } else {

            $update = mysqli_prepare($conn, 
                "UPDATE departments
                 SET department_name = ?, description = ?
                 WHERE department_id = ?"
            );

            mysqli_stmt_bind_param($update, 
                "ssi",
                $department_name,
                $description,
                $department_id
            );

            if (mysqli_stmt_execute($update)) {

                $_SESSION["message"] =
                    "Department updated successfully.";

                $_SESSION["message_type"] = "success";

            } else {

                $_SESSION["message"] =
                    "Failed to update department.";

                $_SESSION["message_type"] = "error";
            }

            mysqli_stmt_close($update);
        }

        mysqli_stmt_close($check);
    }

    header("Location: admin_departments.php");
    exit();
}


/* =========================================================
   GET DEPARTMENTS
   ========================================================= */

$sql = "
    SELECT
        d.department_id,
        d.department_name,
        d.description,
        d.created_at,
        COUNT(doc.doctor_id) AS doctor_count
    FROM departments d
    LEFT JOIN doctors doc
        ON d.department_id = doc.department_id
    GROUP BY
        d.department_id,
        d.department_name,
        d.description,
        d.created_at
    ORDER BY d.department_name
";

$departments = mysqli_query($conn, $sql);

?>