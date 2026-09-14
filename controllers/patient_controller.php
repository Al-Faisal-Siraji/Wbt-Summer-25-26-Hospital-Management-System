<?php

function patient_controller(string $page): void
{
    $views = [
        'patient' => 'dashboard.php',
        'appointments' => 'appointments.php',
        'book_appointment' => 'book_appointment.php',
        'doctors' => 'doctors.php',
        'queue' => 'queue.php',
    ];

    render_role_view('patient', $views[$page]);
}
