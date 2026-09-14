<?php

function esc(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect_to(string $page): never
{
    header('Location: router.php?page=' . urlencode($page));
    exit;
}

function require_role(string $role): void
{
    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== $role) {
        redirect_to('login');
    }
}

function render_role_view(string $role, string $view): void
{
    $model = BASE_PATH . '/models/' . $role . '/' . pathinfo($view, PATHINFO_FILENAME) . '_model.php';
    require $model;
    require BASE_PATH . '/views/' . $role . '/' . $view;
}
