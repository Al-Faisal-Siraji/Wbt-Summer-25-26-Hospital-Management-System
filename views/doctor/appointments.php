

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Appointments - Doctor - MediCare</title>

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
           MAIN
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
           MESSAGE
           ===================================================== */

        .message {
            padding: 14px 18px;

            border-radius: 10px;

            margin-bottom: 25px;

            font-size: 14px;
        }

        .message.success {
            background: #dcfce7;

            color: #166534;
        }

        .message.error {
            background: #fee2e2;

            color: #991b1b;
        }


        /* =====================================================
           STATS
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
           APPOINTMENT CARD
           ===================================================== */

        .card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 25px;

            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }


        /* =====================================================
           FILTERS
           ===================================================== */

        .card-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 22px;
        }

        .card-header h2 {
            font-size: 19px;

            color: #111827;
        }

        .filters {
            display: flex;

            gap: 8px;

            flex-wrap: wrap;
        }

        .filter-btn {
            text-decoration: none;

            padding: 8px 13px;

            border-radius: 8px;

            background: #f3f4f6;

            color: #4b5563;

            font-size: 13px;

            font-weight: bold;
        }

        .filter-btn:hover {
            background: #eff6ff;

            color: #2563eb;
        }

        .filter-btn.active {
            background: #2563eb;

            color: white;
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
            padding: 15px 13px;

            border-top: 1px solid #f0f0f0;

            font-size: 14px;

            vertical-align: middle;
        }

        .patient-name {
            font-weight: bold;

            color: #111827;
        }

        .patient-email {
            font-size: 12px;

            color: #9ca3af;

            margin-top: 4px;
        }

        .token {
            color: #2563eb;

            font-weight: bold;

            font-size: 16px;
        }


        /* =====================================================
           STATUS
           ===================================================== */

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;

            text-transform: capitalize;
        }

        .status-pending,
        .status-scheduled {
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
           ACTION BUTTONS
           ===================================================== */

        .action-buttons {
            display: flex;

            gap: 7px;

            flex-wrap: wrap;
        }

        .action-btn {
            border: none;

            padding: 8px 11px;

            border-radius: 7px;

            cursor: pointer;

            font-size: 12px;

            font-weight: bold;
        }

        .complete-btn {
            background: #dcfce7;

            color: #166534;
        }

        .complete-btn:hover {
            background: #bbf7d0;
        }

        .cancel-btn {
            background: #fee2e2;

            color: #991b1b;
        }

        .cancel-btn:hover {
            background: #fecaca;
        }


        /* =====================================================
           EMPTY
           ===================================================== */

        .empty {
            text-align: center;

            padding: 50px 15px;

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

            .card-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
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

        <a href="doctor.php" class="nav-item">
            🏠 Dashboard
        </a>

        <a href="doctor_queue.php" class="nav-item">
            ⏱ Live Queue
        </a>

        <a href="doctor_appointments.php"
           class="nav-item active">
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

            <h1>Appointments</h1>

            <p>
                View and manage your patient appointments
            </p>

        </div>


        <div class="doctor-info">

            <div class="avatar">

                <?php
                echo strtoupper(
                    substr(
                        $user["first_name"],
                        0,
                        1
                    )
                );
                ?>

            </div>

            <div>

                <strong>
                    Dr.
                    <?php
                    echo htmlspecialchars($doctor_name);
                    ?>
                </strong>

                <small>
                    <?php
                    echo htmlspecialchars(
                        $doctor["specialization"]
                    );
                    ?>
                </small>

            </div>

        </div>

    </div>


    <!-- MESSAGE -->

    <?php if ($message !== ""): ?>

        <div class="message <?php echo $message_type; ?>">

            <?php
            echo htmlspecialchars($message);
            ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         STATISTICS
         ===================================================== -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-title">
                Today's Appointments
            </div>

            <div class="stat-number">
                <?php echo $today_count; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Upcoming
            </div>

            <div class="stat-number">
                <?php echo $upcoming_count; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Completed
            </div>

            <div class="stat-number">
                <?php echo $completed_count; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Cancelled
            </div>

            <div class="stat-number">
                <?php echo $cancelled_count; ?>
            </div>

        </div>

    </div>


    <!-- =====================================================
         APPOINTMENTS
         ===================================================== -->

    <div class="card">


        <div class="card-header">

            <h2>Appointment List</h2>


            <div class="filters">

                <a
                    href="doctor_appointments.php?filter=all"
                    class="filter-btn
                    <?php
                    echo $filter === "all"
                        ? "active"
                        : "";
                    ?>"
                >
                    All
                </a>


                <a
                    href="doctor_appointments.php?filter=today"
                    class="filter-btn
                    <?php
                    echo $filter === "today"
                        ? "active"
                        : "";
                    ?>"
                >
                    Today
                </a>


                <a
                    href="doctor_appointments.php?filter=upcoming"
                    class="filter-btn
                    <?php
                    echo $filter === "upcoming"
                        ? "active"
                        : "";
                    ?>"
                >
                    Upcoming
                </a>


                <a
                    href="doctor_appointments.php?filter=completed"
                    class="filter-btn
                    <?php
                    echo $filter === "completed"
                        ? "active"
                        : "";
                    ?>"
                >
                    Completed
                </a>


                <a
                    href="doctor_appointments.php?filter=cancelled"
                    class="filter-btn
                    <?php
                    echo $filter === "cancelled"
                        ? "active"
                        : "";
                    ?>"
                >
                    Cancelled
                </a>

            </div>

        </div>


        <?php if (count($appointments) > 0): ?>


            <div class="table-container">

                <table>

                    <thead>

                        <tr>

                            <th>Token</th>

                            <th>Patient</th>

                            <th>Date</th>

                            <th>Time</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($appointments as $appointment): ?>


                            <?php

                            $status = strtolower(
                                trim(
                                    $appointment["status"]
                                )
                            );

                            if (
                                $status === "pending" ||
                                $status === "scheduled"
                            ) {

                                $status_class =
                                    "status-"
                                    . $status;

                            }

                            elseif (
                                $status === "completed"
                            ) {

                                $status_class =
                                    "status-completed";

                            }

                            elseif (
                                $status === "cancelled"
                            ) {

                                $status_class =
                                    "status-cancelled";

                            }

                            else {

                                $status_class =
                                    "status-default";
                            }

                            ?>


                            <tr>


                                <!-- TOKEN -->

                                <td>

                                    <span class="token">

                                        #

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment[
                                                "token_number"
                                            ]
                                        );
                                        ?>

                                    </span>

                                </td>


                                <!-- PATIENT -->

                                <td>

                                    <div class="patient-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment[
                                                "first_name"
                                            ]
                                            . " "
                                            . $appointment[
                                                "last_name"
                                            ]
                                        );
                                        ?>

                                    </div>

                                    <div class="patient-email">

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment["email"]
                                        );
                                        ?>

                                    </div>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <?php
                                    echo date(
                                        "d M Y",
                                        strtotime(
                                            $appointment[
                                                "appointment_date"
                                            ]
                                        )
                                    );
                                    ?>

                                </td>


                                <!-- TIME -->

                                <td>

                                    <?php
                                    echo date(
                                        "h:i A",
                                        strtotime(
                                            $appointment[
                                                "appointment_time"
                                            ]
                                        )
                                    );
                                    ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <span
                                        class="status
                                        <?php
                                        echo $status_class;
                                        ?>"
                                    >

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment["status"]
                                        );
                                        ?>

                                    </span>

                                </td>


                                <!-- ACTION -->

                                <td>


                                    <?php
                                    if (
                                        $status === "pending" ||
                                        $status === "scheduled"
                                    ):
                                    ?>


                                        <div class="action-buttons">


                                            <!-- COMPLETE -->

                                            <form
                                                method="POST"
                                                style="display:inline;"
                                            >

                                                <input
                                                    type="hidden"
                                                    name="appointment_id"
                                                    value="<?php
                                                    echo $appointment[
                                                        "appointment_id"
                                                    ];
                                                    ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="new_status"
                                                    value="completed"
                                                >

                                                <button
                                                    type="submit"
                                                    class="action-btn complete-btn"
                                                >
                                                    ✓ Complete
                                                </button>

                                            </form>


                                            <!-- CANCEL -->

                                            <form
                                                method="POST"
                                                style="display:inline;"
                                                onsubmit="
                                                    return confirm(
                                                        'Are you sure you want to cancel this appointment?'
                                                    );
                                                "
                                            >

                                                <input
                                                    type="hidden"
                                                    name="appointment_id"
                                                    value="<?php
                                                    echo $appointment[
                                                        "appointment_id"
                                                    ];
                                                    ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="new_status"
                                                    value="cancelled"
                                                >

                                                <button
                                                    type="submit"
                                                    class="action-btn cancel-btn"
                                                >
                                                    ✕ Cancel
                                                </button>

                                            </form>


                                        </div>


                                    <?php elseif (
                                        $status === "completed"
                                    ): ?>


                                        <span
                                            class="status status-completed"
                                        >
                                            Completed
                                        </span>


                                    <?php elseif (
                                        $status === "cancelled"
                                    ): ?>


                                        <span
                                            class="status status-cancelled"
                                        >
                                            Cancelled
                                        </span>


                                    <?php endif; ?>


                                </td>


                            </tr>


                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <div class="empty">

                No appointments found for this filter.

            </div>


        <?php endif; ?>


    </div>


</main>


</body>

</html>
```
