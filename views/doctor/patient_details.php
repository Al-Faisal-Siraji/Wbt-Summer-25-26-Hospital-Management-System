

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Patient Details - MediCare</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 270px;
            height: 100vh;

            background: #ffffff;
            border-right: 1px solid #e5e7eb;

            padding: 25px 18px;

            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;

            color: #2563eb;

            margin-bottom: 35px;

            padding-left: 12px;
        }

        .logo span {
            color: #111827;
        }

        .nav-title {
            font-size: 12px;
            font-weight: bold;

            color: #9ca3af;

            margin: 20px 12px 10px;

            text-transform: uppercase;
        }

        .nav-item {
            display: flex;
            align-items: center;

            gap: 12px;

            padding: 13px 14px;

            margin-bottom: 6px;

            text-decoration: none;

            color: #4b5563;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 500;

            transition: 0.2s;
        }

        .nav-item:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        .nav-item.active {
            background: #2563eb;
            color: white;
        }

        .logout {
            color: #dc2626;
        }

        .logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main {
            margin-left: 270px;

            padding: 35px 40px;

            min-height: 100vh;
        }

        /* =========================
           HEADER
        ========================= */

        .page-header {
            display: flex;

            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 28px;
            color: #111827;
        }

        .page-header p {
            margin-top: 6px;

            color: #6b7280;

            font-size: 14px;
        }

        .back-btn {
            text-decoration: none;

            background: white;

            border: 1px solid #d1d5db;

            color: #374151;

            padding: 10px 18px;

            border-radius: 7px;

            font-size: 14px;

            transition: 0.2s;
        }

        .back-btn:hover {
            background: #f3f4f6;
        }

        /* =========================
           PATIENT CARD
        ========================= */

        .patient-card {
            background: white;

            border-radius: 12px;

            padding: 25px;

            margin-bottom: 25px;

            border: 1px solid #e5e7eb;

            display: flex;

            align-items: center;

            gap: 20px;
        }

        .patient-avatar {
            width: 75px;
            height: 75px;

            border-radius: 50%;

            background: #dbeafe;

            color: #2563eb;

            display: flex;

            justify-content: center;
            align-items: center;

            font-size: 26px;

            font-weight: bold;
        }

        .patient-info h2 {
            font-size: 22px;

            margin-bottom: 7px;

            color: #111827;
        }

        .patient-info p {
            color: #6b7280;

            margin-bottom: 4px;

            font-size: 14px;
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 25px;
        }

        .stat-card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 10px;

            padding: 20px;
        }

        .stat-card h3 {
            font-size: 13px;

            color: #6b7280;

            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 27px;

            font-weight: bold;

            color: #111827;
        }

        /* =========================
           HISTORY
        ========================= */

        .section {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            overflow: hidden;
        }

        .section-header {
            padding: 20px 22px;

            border-bottom: 1px solid #e5e7eb;
        }

        .section-header h2 {
            font-size: 18px;

            color: #111827;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th {
            background: #f9fafb;

            color: #6b7280;

            font-size: 12px;

            text-transform: uppercase;

            padding: 14px 16px;

            text-align: left;

            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px;

            border-bottom: 1px solid #f0f0f0;

            font-size: 14px;

            color: #374151;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           STATUS BADGES
        ========================= */

        .status {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;

            text-transform: capitalize;
        }

        .status.completed {
            background: #dcfce7;
            color: #166534;
        }

        .status.scheduled {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;

            padding: 40px;

            color: #6b7280;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;

                padding: 25px;
            }

            .page-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .patient-card {
                flex-direction: column;

                align-items: flex-start;
            }

            .stats {
                grid-template-columns: 1fr;
            }

        }

    </style>
</head>

<body>

<!-- =========================
     SIDEBAR
========================= -->

<div class="sidebar">

    <div class="logo">
        Medi<span>Care</span>
    </div>

    <div class="nav-title">
        Doctor Menu
    </div>

    <a href="doctor.php" class="nav-item">
        🏠 Dashboard
    </a>

    <a href="doctor_queue.php" class="nav-item">
        ⏱ Live Queue
    </a>

    <a href="doctor_appointments.php" class="nav-item">
        📅 Appointments
    </a>

    <a href="doctor_patients.php" class="nav-item active">
        👥 Patients
    </a>

    <a href="doctor_followups.php" class="nav-item">
        🔄 Follow Up
    </a>

    <div class="nav-title">
        Account
    </div>

    <a href="logout.php" class="nav-item logout">
        🚪 Logout
    </a>

</div>


<!-- =========================
     MAIN CONTENT
========================= -->

<div class="main">

    <div class="page-header">

        <div>
            <h1>Patient Details</h1>

            <p>
                View patient information and appointment history.
            </p>
        </div>

        <a href="doctor_patients.php" class="back-btn">
            ← Back to Patients
        </a>

    </div>


    <!-- =========================
         PATIENT INFORMATION
    ========================= -->

    <div class="patient-card">

        <div class="patient-avatar">

            <?php
            echo strtoupper(
                substr($patient['first_name'], 0, 1) .
                substr($patient['last_name'], 0, 1)
            );
            ?>

        </div>

        <div class="patient-info">

            <h2>
                <?php
                echo htmlspecialchars(
                    $patient['first_name'] . " " . $patient['last_name']
                );
                ?>
            </h2>

            <p>
                📧
                <?php echo htmlspecialchars($patient['email']); ?>
            </p>

            <p>
                👤 Patient ID:
                <?php echo $patient['user_id']; ?>
            </p>

        </div>

    </div>


    <!-- =========================
         STATISTICS
    ========================= -->

    <div class="stats">

        <div class="stat-card">

            <h3>Total Visits</h3>

            <div class="number">
                <?php echo $total_visits; ?>
            </div>

        </div>


        <div class="stat-card">

            <h3>Completed Visits</h3>

            <div class="number">
                <?php echo $completed_visits; ?>
            </div>

        </div>


        <div class="stat-card">

            <h3>Pending / Scheduled</h3>

            <div class="number">
                <?php echo $pending_visits; ?>
            </div>

        </div>


        <div class="stat-card">

            <h3>Cancelled</h3>

            <div class="number">
                <?php echo $cancelled_visits; ?>
            </div>

        </div>

    </div>


    <!-- =========================
         APPOINTMENT HISTORY
    ========================= -->

    <div class="section">

        <div class="section-header">

            <h2>
                Appointment History
            </h2>

        </div>


        <div class="table-container">

            <?php if (count($appointments) > 0): ?>

                <table>

                    <thead>

                        <tr>

                            <th>Date</th>

                            <th>Time</th>

                            <th>Token</th>

                            <th>Department</th>

                            <th>Specialization</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($appointments as $appointment): ?>

                            <tr>

                                <td>
                                    <?php
                                    echo date(
                                        "d M Y",
                                        strtotime($appointment['appointment_date'])
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo date(
                                        "h:i A",
                                        strtotime($appointment['appointment_time'])
                                    );
                                    ?>
                                </td>

                                <td>
                                    #<?php echo htmlspecialchars($appointment['token_number']); ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['department_name'] ?? 'N/A'
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['specialization'] ?? 'N/A'
                                    );
                                    ?>
                                </td>

                                <td>

                                    <span class="status <?php echo strtolower($appointment['status']); ?>">

                                        <?php
                                        echo htmlspecialchars(
                                            ucfirst($appointment['status'])
                                        );
                                        ?>

                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty">
                    No appointment history found.
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

</body>
</html>