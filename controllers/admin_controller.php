<?php

function admin_controller(string $page): void
{
    $views = [
        'admin' => 'dashboard.php',
        'admin_departments' => 'departments.php',
        'admin_doctors' => 'doctors.php',
        'admin_performance' => 'performance.php',
        'admin_resources' => 'resources.php',
    ];

    render_role_view('admin', $views[$page]);
}
