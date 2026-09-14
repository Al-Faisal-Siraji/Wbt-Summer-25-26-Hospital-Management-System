

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Doctor Dashboard - MediCare</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #333;
        }

        /* =====================================================
           SIDEBAR
           ===================================================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 270px;
            height: 100vh;

            background: #ffffff;

            border-right: 1px solid #e5e7eb;

            padding: 25px 18px;

            z-index: 1000;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;

            color: #2563eb;

            padding: 0 15px;

            margin-bottom: 35px;
        }

        .logo span {
            color: #111827;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;

            align-items: center;

            gap: 12px;

            text-decoration: none;

            color: #4b5563;

            padding: 13px 15px;

            border-radius: 10px;

            font-size: 15px;

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
            margin-top: 25px;
            color: #dc2626;
        }

        .logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }


        /* =====================================================
           MAIN CONTENT
           ===================================================== */

        .main {
            margin-left: 270px;

            min-height: 100vh;

            padding: 30px 35px;
        }


        /* =====================================================
           HEADER
           ===================================================== */

        .header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #111827;
        }

        .header p {
            margin-top: 6px;
            color: #6b7280;
        }

        .doctor-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 45px;
            height: 45px;

            border-radius: 50%;

            background: #2563eb;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: bold;
            font-size: 18px;
        }

        .doctor-info strong {
            display: block;
            color: #111827;
        }

        .doctor-info small {
            color: #6b7280;
        }


        /* =====================================================
           STAT CARDS
           ===================================================== */

        .stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 20px;

            margin-bottom: 30px;
        }

        .stat-card {
            background: white;

            padding: 23px;

            border-radius: 14px;

            border: 1px solid #e5e7eb;

            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .stat-title {
            color: #6b7280;

            font-size: 14px;

            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 30px;

            font-weight: bold;

            color: #111827;
        }


        /* =====================================================
           GRID
           ===================================================== */

        .content-grid {
            display: grid;

            grid-template-columns: 2fr 1fr;

            gap: 25px;

            margin-bottom: 30px;
        }

        .card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 25px;

            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .card-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 19px;

            color: #111827;
        }


        /* =====================================================
           TABLE
           ===================================================== */

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th {
            text-align: left;

            font-size: 13px;

            color: #6b7280;

            background: #f9fafb;

            padding: 13px;
        }

        td {
            padding: 14px 13px;

            border-top: 1px solid #f0f0f0;

            font-size: 14px;
        }

        .patient-name {
            font-weight: bold;

            color: #111827;
        }


        /* =====================================================
           STATUS BADGES
           ===================================================== */

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;

            text-transform: capitalize;
        }

        .status-scheduled,
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-default {
            background: #e5e7eb;
            color: #374151;
        }


        /* =====================================================
           PROFILE
           ===================================================== */

        .profile-row {
            display: flex;

            justify-content: space-between;

            padding: 14px 0;

            border-bottom: 1px solid #f0f0f0;
        }

        .profile-row:last-child {
            border-bottom: none;
        }

        .profile-label {
            color: #6b7280;

            font-size: 14px;
        }

        .profile-value {
            font-weight: bold;

            color: #111827;

            text-align: right;
        }


        /* =====================================================
           AVAILABILITY
           ===================================================== */

        .availability {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            font-size: 13px;

            font-weight: bold;

            text-transform: capitalize;
        }

        .availability-dot {
            width: 9px;
            height: 9px;

            border-radius: 50%;

            background: #22c55e;
        }

        .availability.unavailable .availability-dot {
            background: #ef4444;
        }


        /* =====================================================
           EMPTY MESSAGE
           ===================================================== */

        .empty {
            text-align: center;

            padding: 35px 10px;

            color: #6b7280;

            font-size: 14px;
        }


        /* =====================================================
           RESPONSIVE
           ===================================================== */

        @media (max-width: 1100px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 750px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;

                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

        }

    </style>

</head>

<body>


<!-- =========================================================
     SIDEBAR
     ========================================================= -->

<aside class="sidebar">

    <div class="logo">
        Medi<span>Care</span>
    </div>

    <nav class="nav">

        <a href="doctor.php" class="nav-item active">
            🏠 Dashboard
        </a>

        <a href="doctor_queue.php" class="nav-item">
            ⏱ Live Queue
        </a>

        <a href="doctor_appointments.php" class="nav-item">
            📅 Appointments
        </a>

        <a href="doctor_patients.php" class="nav-item">
            👥 Patients
        </a>

        <a href="doctor_followups.php" class="nav-item">
            🔄 Follow Up
        </a>

        <a href="logout.php" class="nav-item logout">
            🚪 Logout
        </a>

    </nav>

</aside>


<!-- =========================================================
     MAIN
     ========================================================= -->

<main class="main">


    <!-- HEADER -->

    <div class="header">

        <div>

            <h1>Doctor Dashboard</h1>

            <p>
                Welcome back, Dr. <?php echo htmlspecialchars($doctor_name); ?>
            </p>

        </div>


        <div class="doctor-info">

            <div class="avatar">

                <?php
                echo strtoupper(
                    substr($user["first_name"], 0, 1)
                );
                ?>

            </div>

            <div>

                <strong>
                    Dr. <?php echo htmlspecialchars($doctor_name); ?>
                </strong>

                <small>
                    <?php echo htmlspecialchars($specialization); ?>
                </small>

            </div>

        </div>

    </div>


    <!-- =====================================================
         STATISTICS
         ===================================================== -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-title">
                Today's Appointments
            </div>

            <div class="stat-number">
                <?php echo $today_appointments; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Total Appointments
            </div>

            <div class="stat-number">
                <?php echo $total_appointments; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Pending
            </div>

            <div class="stat-number">
                <?php echo $pending_appointments; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Completed
            </div>

            <div class="stat-number">
                <?php echo $completed_appointments; ?>
            </div>

        </div>

    </div>


    <!-- =====================================================
         TODAY QUEUE + PROFILE
         ===================================================== -->

    <div class="content-grid">


        <!-- TODAY QUEUE -->

        <div class="card">

            <div class="card-header">

                <h2>Today's Patient Queue</h2>

            </div>


            <?php if (count($today_queue) > 0): ?>

                <div class="table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>Token</th>

                                <th>Patient</th>

                                <th>Time</th>

                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($today_queue as $appointment): ?>

                                <?php

                                $status = strtolower(
                                    trim($appointment["status"])
                                );

                                $status_class = "status-default";

                                if (
                                    $status === "pending" ||
                                    $status === "scheduled"
                                ) {
                                    $status_class = "status-pending";
                                }

                                elseif ($status === "completed") {
                                    $status_class = "status-completed";
                                }

                                elseif ($status === "cancelled") {
                                    $status_class = "status-cancelled";
                                }

                                ?>

                                <tr>

                                    <td>

                                        <strong>
                                            #<?php
                                            echo htmlspecialchars(
                                                $appointment["token_number"]
                                            );
                                            ?>
                                        </strong>

                                    </td>


                                    <td>

                                        <div class="patient-name">

                                            <?php
                                            echo htmlspecialchars(
                                                $appointment["first_name"]
                                                . " "
                                                . $appointment["last_name"]
                                            );
                                            ?>

                                        </div>

                                    </td>


                                    <td>

                                        <?php
                                        echo date(
                                            "h:i A",
                                            strtotime(
                                                $appointment["appointment_time"]
                                            )
                                        );
                                        ?>

                                    </td>


                                    <td>

                                        <span class="status <?php echo $status_class; ?>">

                                            <?php
                                            echo htmlspecialchars(
                                                $appointment["status"]
                                            );
                                            ?>

                                        </span>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="empty">

                    No patients are scheduled for today.

                </div>

            <?php endif; ?>

        </div>


        <!-- DOCTOR PROFILE -->

        <div class="card">

            <div class="card-header">

                <h2>My Profile</h2>

            </div>


            <div class="profile-row">

                <span class="profile-label">
                    Name
                </span>

                <span class="profile-value">

                    Dr.
                    <?php
                    echo htmlspecialchars($doctor_name);
                    ?>

                </span>

            </div>


            <div class="profile-row">

                <span class="profile-label">
                    Department
                </span>

                <span class="profile-value">

                    <?php
                    echo htmlspecialchars($department_name);
                    ?>

                </span>

            </div>


            <div class="profile-row">

                <span class="profile-label">
                    Specialization
                </span>

                <span class="profile-value">

                    <?php
                    echo htmlspecialchars($specialization);
                    ?>

                </span>

            </div>


            <div class="profile-row">

                <span class="profile-label">
                    Consultation Fee
                </span>

                <span class="profile-value">

                    ৳<?php
                    echo number_format(
                        (float) $consultation_fee,
                        2
                    );
                    ?>

                </span>

            </div>


            <div class="profile-row">

                <span class="profile-label">
                    Availability
                </span>

                <span class="profile-value">

                    <span class="availability <?php echo strtolower($availability) === "unavailable" ? "unavailable" : ""; ?>">

                        <span class="availability-dot"></span>

                        <?php
                        echo htmlspecialchars($availability);
                        ?>

                    </span>

                </span>

            </div>

        </div>

    </div>


    <!-- =====================================================
         RECENT APPOINTMENTS
         ===================================================== -->

    <div class="card">

        <div class="card-header">

            <h2>Recent Appointments</h2>

        </div>


        <?php if (count($recent_appointments) > 0): ?>

            <div class="table-container">

                <table>

                    <thead>

                        <tr>

                            <th>Patient</th>

                            <th>Date</th>

                            <th>Time</th>

                            <th>Token</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($recent_appointments as $appointment): ?>

                            <?php

                            $status = strtolower(
                                trim($appointment["status"])
                            );

                            $status_class = "status-default";

                            if (
                                $status === "pending" ||
                                $status === "scheduled"
                            ) {
                                $status_class = "status-pending";
                            }

                            elseif ($status === "completed") {
                                $status_class = "status-completed";
                            }

                            elseif ($status === "cancelled") {
                                $status_class = "status-cancelled";
                            }

                            ?>

                            <tr>

                                <td>

                                    <div class="patient-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment["first_name"]
                                            . " "
                                            . $appointment["last_name"]
                                        );
                                        ?>

                                    </div>

                                </td>


                                <td>

                                    <?php
                                    echo date(
                                        "d M Y",
                                        strtotime(
                                            $appointment["appointment_date"]
                                        )
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    echo date(
                                        "h:i A",
                                        strtotime(
                                            $appointment["appointment_time"]
                                        )
                                    );
                                    ?>

                                </td>


                                <td>

                                    #<?php
                                    echo htmlspecialchars(
                                        $appointment["token_number"]
                                    );
                                    ?>

                                </td>


                                <td>

                                    <span class="status <?php echo $status_class; ?>">

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment["status"]
                                        );
                                        ?>

                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty">

                No appointments found.

            </div>

        <?php endif; ?>

    </div>

</main>

</body>
</html>
```
