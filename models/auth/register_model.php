<?php

require_once BASE_PATH . "/views/partials/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $email = trim($_POST["email"]);
    $role = $_POST["role"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if ($password !== $confirmPassword) {

        $message = "Passwords do not match.";

    } else {

        $checkEmail = mysqli_prepare($conn, 
            "SELECT user_id FROM users WHERE email = ?"
        );

        mysqli_stmt_bind_param($checkEmail, "s", $email);

        mysqli_stmt_execute($checkEmail);

        $result = mysqli_stmt_get_result($checkEmail);

        if (mysqli_num_rows($result) > 0) {

            $message = "This email is already registered.";

        } else {

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = mysqli_prepare($conn, 
                "INSERT INTO users
                (first_name, last_name, email, password, role)
                VALUES (?, ?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param($stmt, 
                "sssss",
                $firstName,
                $lastName,
                $email,
                $hashedPassword,
                $role
            );

            if (mysqli_stmt_execute($stmt)) {

                $message = "Account created successfully!";

            } else {

                $message = "Something went wrong.";

            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($checkEmail);
    }
}

?>