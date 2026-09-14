<?php

function receptionist_controller(string $page): void
{
    $views = [
        'receptionist' => 'dashboard.php',
        'manage_appointments' => 'appointments.php',
        'receptionist_patients' => 'patients.php',
        'receptionist_queue' => 'queue.php',
    ];

    render_role_view('receptionist', $views[$page]);
}
