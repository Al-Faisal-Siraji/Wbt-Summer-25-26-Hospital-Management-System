<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

require_once BASE_PATH . "/views/partials/database.php";

$message = "";


/* =========================================================
   LOGIN PROCESS
   ========================================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";


    /* ================= VALIDATION ================= */

    if ($email === "" || $password === "") {

        $message = "Please enter your email and password.";

    } else {


        /* ================= FIND USER ================= */

        $stmt = mysqli_prepare($conn, 
            "SELECT
                user_id,
                first_name,
                last_name,
                email,
                password,
                role
             FROM users
             WHERE email = ?
             LIMIT 1"
        );


        if (!$stmt) {

            $message = "Database error. Please try again.";

        } else {


            mysqli_stmt_bind_param($stmt, "s", $email);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);


            /* ================= USER FOUND ================= */

            if (mysqli_num_rows($result) === 1) {

                $user = mysqli_fetch_assoc($result);


                /* ================= PASSWORD ================= */

                if (password_verify($password, $user["password"])) {


                    /*
                     * Regenerate session ID after successful login.
                     */
                    session_regenerate_id(true);


                    /* ================= SESSION DATA ================= */

                    $_SESSION["user_id"] = (int)$user["user_id"];

                    $_SESSION["first_name"] = $user["first_name"];

                    $_SESSION["last_name"] = $user["last_name"];

                    $_SESSION["email"] = $user["email"];


                    /*
                     * Convert role to lowercase.
                     *
                     * Example:
                     *
                     * Doctor  → doctor
                     * DOCTOR  → doctor
                     * doctor  → doctor
                     */

                    $_SESSION["role"] = strtolower(
                        trim($user["role"])
                    );


                    /* ================= ROLE REDIRECT ================= */

                    switch ($_SESSION["role"]) {


                        /* ================= ADMIN ================= */

                        case "admin":

                            header("Location: admin.php");

                            exit();


                        /* ================= RECEPTIONIST ================= */

                        case "receptionist":

                            header("Location: receptionist.php");

                            exit();


                        /* ================= DOCTOR ================= */

                        case "doctor":

                            header("Location: doctor.php");

                            exit();


                        /* ================= PATIENT ================= */

                        case "patient":

                            header("Location: patient.php");

                            exit();


                        /* ================= INVALID ROLE ================= */

                        default:

                            $message = "Invalid user role.";

                            break;

                    }


                } else {

                    $message = "Incorrect password.";

                }


            } else {

                $message = "No account found with this email.";

            }


            mysqli_stmt_close($stmt);

        }

    }

}

?>