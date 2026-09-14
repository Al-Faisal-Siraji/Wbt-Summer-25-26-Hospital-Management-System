

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Doctor Performance - MediCare HMS</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* =========================
           MAIN LAYOUT
        ========================= */

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }


        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 270px;
            height: 100vh;

            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;

            background: #111827;
            color: white;

            padding: 25px 18px;

            overflow-y: auto;

            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;

            margin-bottom: 35px;

            padding-left: 10px;
        }

        .logo span {
            color: #38bdf8;
        }


        /* =========================
           NAVIGATION
        ========================= */

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;

            text-decoration: none;

            color: #d1d5db;

            padding: 14px 15px;

            border-radius: 10px;

            font-size: 15px;

            transition: 0.2s;
        }

        .nav-item:hover {
            background: #1f2937;
            color: white;
        }

        .nav-item.active {
            background: #2563eb;
            color: white;
        }

        .nav-icon {
            width: 30px;
            font-size: 18px;
        }


        /* =========================
           MAIN CONTENT
        ========================= */

        .main-content {
            margin-left: 270px;

            width: calc(100% - 270px);

            min-height: 100vh;

            padding: 35px;
        }


        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 30px;

            color: #111827;

            margin-bottom: 7px;
        }

        .page-header p {
            color: #6b7280;
        }

        .admin-name {
            background: white;

            padding: 12px 18px;

            border-radius: 10px;

            box-shadow: 0 2px 10px rgba(0,0,0,0.05);

            font-weight: 600;
        }


        /* =========================
           STAT CARDS
        ========================= */

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(5, 1fr);

            gap: 18px;

            margin-bottom: 30px;
        }

        .stat-card {
            background: white;

            border-radius: 14px;

            padding: 22px;

            box-shadow:
                0 3px 12px rgba(0,0,0,0.06);
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

        .stat-description {
            font-size: 12px;

            color: #9ca3af;

            margin-top: 6px;
        }


        /* =========================
           PERFORMANCE SUMMARY
        ========================= */

        .summary-card {
            background: white;

            border-radius: 14px;

            padding: 25px;

            margin-bottom: 30px;

            box-shadow:
                0 3px 12px rgba(0,0,0,0.06);
        }

        .summary-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }

        .summary-header h2 {
            font-size: 20px;
        }

        .summary-rate {
            font-size: 25px;

            font-weight: bold;

            color: #2563eb;
        }

        .progress-container {
            width: 100%;

            height: 14px;

            background: #e5e7eb;

            border-radius: 20px;

            overflow: hidden;
        }

        .progress-bar {
            height: 100%;

            background: #2563eb;

            border-radius: 20px;

            transition: width 0.3s;
        }


        /* =========================
           TABLE
        ========================= */

        .table-card {
            background: white;

            border-radius: 14px;

            padding: 25px;

            box-shadow:
                0 3px 12px rgba(0,0,0,0.06);

            overflow-x: auto;
        }

        .table-header {
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 20px;

            margin-bottom: 5px;
        }

        .table-header p {
            color: #6b7280;

            font-size: 14px;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 950px;
        }

        th {
            background: #f9fafb;

            color: #4b5563;

            font-size: 13px;

            text-align: left;

            padding: 14px;

            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 15px 14px;

            border-bottom: 1px solid #f0f0f0;

            font-size: 14px;
        }

        tr:hover {
            background: #fafafa;
        }


        /* =========================
           DOCTOR NAME
        ========================= */

        .doctor-name {
            font-weight: 600;

            color: #111827;
        }

        .specialization {
            color: #6b7280;

            font-size: 12px;

            margin-top: 3px;
        }


        /* =========================
           STATUS NUMBERS
        ========================= */

        .completed-number {
            color: #16a34a;

            font-weight: bold;
        }

        .cancelled-number {
            color: #dc2626;

            font-weight: bold;
        }

        .pending-number {
            color: #d97706;

            font-weight: bold;
        }


        /* =========================
           COMPLETION RATE
        ========================= */

        .rate-wrapper {
            width: 130px;
        }

        .rate-text {
            display: flex;

            justify-content: space-between;

            margin-bottom: 5px;

            font-size: 12px;

            font-weight: 600;
        }

        .mini-progress {
            height: 7px;

            background: #e5e7eb;

            border-radius: 10px;

            overflow: hidden;
        }

        .mini-progress-bar {
            height: 100%;

            background: #2563eb;

            border-radius: 10px;
        }


        /* =========================
           PERFORMANCE BADGES
        ========================= */

        .performance-badge {
            display: inline-block;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 600;
        }

        .excellent {
            background: #dcfce7;

            color: #166534;
        }

        .good {
            background: #dbeafe;

            color: #1d4ed8;
        }

        .average {
            background: #fef3c7;

            color: #92400e;
        }

        .attention {
            background: #fee2e2;

            color: #991b1b;
        }


        /* =========================
           EMPTY STATE
        ========================= */

        .empty-state {
            text-align: center;

            padding: 50px;

            color: #6b7280;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1200px) {

            .stats-grid {
                grid-template-columns:
                    repeat(3, 1fr);
            }

        }


        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;

                width: calc(100% - 220px);

                padding: 25px;
            }

            .stats-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        @media (max-width: 600px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;
            }

            .dashboard-container {
                display: block;
            }

            .main-content {
                margin-left: 0;

                width: 100%;

                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                display: block;
            }

            .admin-name {
                margin-top: 15px;
            }

        }

    </style>

</head>

<body>

<div class="dashboard-container">


    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">

        <div class="logo">
            Medi<span>Care</span>
        </div>

        <nav class="nav-menu">

            <a href="admin.php" class="nav-item">
                <span class="nav-icon">🏠</span>
                Dashboard
            </a>

            <a href="admin_doctors.php" class="nav-item">
                <span class="nav-icon">👨‍⚕️</span>
                Doctors
            </a>

            <a href="admin_departments.php" class="nav-item">
                <span class="nav-icon">🏥</span>
                Departments
            </a>

            <a href="admin_resources.php" class="nav-item">
                <span class="nav-icon">📦</span>
                Resources
            </a>

            <a href="admin_performance.php"
               class="nav-item active">

                <span class="nav-icon">📊</span>

                Performance

            </a>

            <a href="logout.php" class="nav-item">

                <span class="nav-icon">🚪</span>

                Logout

            </a>

        </nav>

    </aside>


    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <main class="main-content">


        <!-- HEADER -->

        <div class="page-header">

            <div>

                <h1>Doctor Performance</h1>

                <p>
                    Monitor doctor appointments and overall performance.
                </p>

            </div>

            <div class="admin-name">

                Admin:
                <?php echo htmlspecialchars($firstName); ?>

            </div>

        </div>


        <!-- =========================
             STATISTICS
        ========================== -->

        <div class="stats-grid">


            <div class="stat-card">

                <div class="stat-title">
                    Total Doctors
                </div>

                <div class="stat-number">
                    <?php echo $totalDoctors; ?>
                </div>

                <div class="stat-description">
                    Registered doctors
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Total Appointments
                </div>

                <div class="stat-number">
                    <?php echo $totalAppointments; ?>
                </div>

                <div class="stat-description">
                    All appointments
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Completed
                </div>

                <div class="stat-number completed-number">
                    <?php echo $completedAppointments; ?>
                </div>

                <div class="stat-description">
                    Completed appointments
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Cancelled
                </div>

                <div class="stat-number cancelled-number">
                    <?php echo $cancelledAppointments; ?>
                </div>

                <div class="stat-description">
                    Cancelled appointments
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Pending
                </div>

                <div class="stat-number pending-number">
                    <?php echo $pendingAppointments; ?>
                </div>

                <div class="stat-description">
                    Pending appointments
                </div>

            </div>

        </div>


        <!-- =========================
             OVERALL PERFORMANCE
        ========================== -->

        <div class="summary-card">

            <div class="summary-header">

                <div>

                    <h2>
                        Overall Completion Rate
                    </h2>

                    <p style="color:#6b7280; margin-top:5px;">

                        Percentage of appointments successfully completed.

                    </p>

                </div>

                <div class="summary-rate">

                    <?php echo $overallCompletionRate; ?>%

                </div>

            </div>


            <div class="progress-container">

                <div
                    class="progress-bar"
                    style="width: <?php echo $overallCompletionRate; ?>%;"
                ></div>

            </div>

        </div>


        <!-- =========================
             DOCTOR PERFORMANCE TABLE
        ========================== -->

        <div class="table-card">

            <div class="table-header">

                <h2>
                    Doctor Performance Report
                </h2>

                <p>
                    Performance information based on appointment records.
                </p>

            </div>


            <?php if (count($doctorPerformance) > 0): ?>

            <table>

                <thead>

                    <tr>

                        <th>Doctor</th>

                        <th>Department</th>

                        <th>Total</th>

                        <th>Completed</th>

                        <th>Cancelled</th>

                        <th>Pending</th>

                        <th>Completion Rate</th>

                        <th>Performance</th>

                    </tr>

                </thead>


                <tbody>

                <?php foreach ($doctorPerformance as $doctor): ?>

                    <tr>


                        <!-- DOCTOR -->

                        <td>

                            <div class="doctor-name">

                                Dr.
                                <?php
                                echo htmlspecialchars(
                                    $doctor["first_name"]
                                    . " "
                                    . $doctor["last_name"]
                                );
                                ?>

                            </div>

                            <div class="specialization">

                                <?php
                                echo htmlspecialchars(
                                    $doctor["specialization"]
                                );
                                ?>

                            </div>

                        </td>


                        <!-- DEPARTMENT -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $doctor["department_name"]
                            );
                            ?>

                        </td>


                        <!-- TOTAL -->

                        <td>

                            <strong>
                                <?php
                                echo $doctor["total_appointments"];
                                ?>
                            </strong>

                        </td>


                        <!-- COMPLETED -->

                        <td>

                            <span class="completed-number">

                                <?php
                                echo $doctor["completed"];
                                ?>

                            </span>

                        </td>


                        <!-- CANCELLED -->

                        <td>

                            <span class="cancelled-number">

                                <?php
                                echo $doctor["cancelled"];
                                ?>

                            </span>

                        </td>


                        <!-- PENDING -->

                        <td>

                            <span class="pending-number">

                                <?php
                                echo $doctor["pending"];
                                ?>

                            </span>

                        </td>


                        <!-- COMPLETION RATE -->

                        <td>

                            <div class="rate-wrapper">

                                <div class="rate-text">

                                    <span>
                                        Rate
                                    </span>

                                    <span>
                                        <?php
                                        echo $doctor["completion_rate"];
                                        ?>%
                                    </span>

                                </div>

                                <div class="mini-progress">

                                    <div
                                        class="mini-progress-bar"
                                        style="
                                            width:
                                            <?php
                                            echo $doctor["completion_rate"];
                                            ?>%;
                                        "
                                    ></div>

                                </div>

                            </div>

                        </td>


                        <!-- PERFORMANCE -->

                        <td>

                            <span
                                class="performance-badge
                                <?php
                                echo $doctor["performance_class"];
                                ?>"
                            >

                                <?php
                                echo $doctor["performance"];
                                ?>

                            </span>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

            <?php else: ?>

                <div class="empty-state">

                    <h3>
                        No Doctor Performance Data
                    </h3>

                    <p>
                        There are currently no doctors available
                        for performance analysis.
                    </p>

                </div>

            <?php endif; ?>

        </div>


    </main>

</div>

</body>

</html>

