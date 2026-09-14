<?php

/** All user-table queries belong in this model. */
function find_user_by_email(mysqli $conn, string $email): ?array
{
    $statement = mysqli_prepare($conn, 
        'SELECT user_id, first_name, last_name, email, password, role FROM users WHERE email = ? LIMIT 1'
    );
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $user = mysqli_stmt_get_result($statement)->fetch_assoc() ?: null;
    mysqli_stmt_close($statement);
    return $user;
}
