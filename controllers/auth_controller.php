<?php

function auth_controller(string $page): void
{
    $views = [
        'login' => 'login.php',
        'index' => 'login.php',
        'register' => 'register.php',
        'signup' => 'register.php',
    ];

    if ($page === 'logout') {
        $_SESSION = [];
        session_destroy();
        header('Location: router.php?page=login');
        exit;
    }

    render_role_view('auth', $views[$page] ?? 'login.php');
}
