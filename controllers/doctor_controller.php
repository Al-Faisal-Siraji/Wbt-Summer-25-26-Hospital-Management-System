<?php

function doctor_controller(string $page): void
{
    $views = [
        'doctor' => 'dashboard.php',
        'doctor_appointments' => 'appointments.php',
        'doctor_followups' => 'followups.php',
        'doctor_patient_details' => 'patient_details.php',
        'doctor_patients' => 'patients.php',
        'doctor_queue' => 'queue.php',
    ];

    render_role_view('doctor', $views[$page]);
}
