

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Live Queue - Doctor - MediCare</title>

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
           CURRENT PATIENT
           ===================================================== */

        .current-card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 25px;

            margin-bottom: 30px;

            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .current-card h2 {
            font-size: 19px;

            margin-bottom: 20px;

            color: #111827;
        }

        .current-content {
            display: flex;

            justify-content: space-between;

            align-items: center;

            background: #f8fafc;

            border-radius: 12px;

            padding: 20px;
        }

        .current-patient {
            display: flex;

            align-items: center;

            gap: 15px;
        }

        .patient-avatar {
            width: 55px;
            height: 55px;

            border-radius: 50%;

            background: #dbeafe;

            color: #2563eb;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            font-weight: bold;
        }

        .patient-name {
            font-size: 17px;

            font-weight: bold;

            color: #111827;
        }

        .patient-email {
            font-size: 13px;

            color: #6b7280;

            margin-top: 4px;
        }

        .token {
            font-size: 25px;

            font-weight: bold;

            color: #2563eb;
        }

        .token-label {
            font-size: 12px;

            color: #6b7280;

            text-align: center;

            margin-top: 3px;
        }


        /* =====================================================
           QUEUE TABLE
           ===================================================== */

        .queue-card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 25px;

            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .queue-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }

        .queue-header h2 {
            font-size: 19px;

            color: #111827;
        }

        .today {
            font-size: 13px;

            color: #6b7280;
        }

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

        .queue-token {
            font-size: 16px;

            font-weight: bold;

            color: #2563eb;
        }

        .patient-table-name {
            font-weight: bold;

            color: #111827;
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


        /* =====================================================
           BUTTONS
           ===================================================== */

        .actions {
            display: flex;

            gap: 8px;

            flex-wrap: wrap;
        }

        .btn {
            border: none;

            border-radius: 7px;

            padding: 8px 12px;

            font-size: 12px;

            cursor: pointer;

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

        .waiting-btn {
            background: #fef3c7;

            color: #92400e;
        }

        .waiting-btn:hover {
            background: #fde68a;
        }


        /* =====================================================
           EMPTY
           ===================================================== */

        .empty {
            text-align: center;

            padding: 45px 15px;

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

            .current-content {
                flex-direction: column;

                align-items: flex-start;

                gap: 20px;
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

        <a href="doctor_queue.php" class="nav-item active">
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
     MAIN CONTENT
     ========================================================= -->

<main class="main">


    <!-- HEADER -->

    <div class="header">

        <div>

            <h1>Live Queue</h1>

            <p>
                Manage today's patient queue
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

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         STATISTICS
         ===================================================== -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-title">
                Total Today
            </div>

            <div class="stat-number">
                <?php echo $total_today; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Waiting
            </div>

            <div class="stat-number">
                <?php echo $waiting; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Completed
            </div>

            <div class="stat-number">
                <?php echo $completed; ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Cancelled
            </div>

            <div class="stat-number">
                <?php echo $cancelled; ?>
            </div>

        </div>

    </div>


    <!-- =====================================================
         CURRENT PATIENT
         ===================================================== -->

    <div class="current-card">

        <h2>Current Patient</h2>


        <?php if ($current_patient): ?>

            <div class="current-content">


                <div class="current-patient">

                    <div class="patient-avatar">

                        <?php
                        echo strtoupper(
                            substr(
                                $current_patient["first_name"],
                                0,
                                1
                            )
                        );
                        ?>

                    </div>


                    <div>

                        <div class="patient-name">

                            <?php
                            echo htmlspecialchars(
                                $current_patient["first_name"]
                                . " "
                                . $current_patient["last_name"]
                            );
                            ?>

                        </div>

                        <div class="patient-email">

                            <?php
                            echo htmlspecialchars(
                                $current_patient["email"]
                            );
                            ?>

                        </div>

                    </div>

                </div>


                <div>

                    <div class="token">

                        #
                        <?php
                        echo htmlspecialchars(
                            $current_patient["token_number"]
                        );
                        ?>

                    </div>

                    <div class="token-label">
                        TOKEN
                    </div>

                </div>

            </div>

        <?php else: ?>

            <div class="empty">

                🎉 No patient is currently waiting.

            </div>

        <?php endif; ?>

    </div>


    <!-- =====================================================
         QUEUE TABLE
         ===================================================== -->

    <div class="queue-card">

        <div class="queue-header">

            <h2>Today's Queue</h2>

            <div class="today">

                <?php
                echo date("d M Y");
                ?>

            </div>

        </div>


        <?php if (count($queue) > 0): ?>

            <div class="table-container">

                <table>

                    <thead>

                        <tr>

                            <th>Token</th>

                            <th>Patient</th>

                            <th>Time</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($queue as $appointment): ?>

                            <?php

                            $status = strtolower(
                                trim(
                                    $appointment["status"]
                                )
                            );

                            ?>

                            <tr>


                                <!-- TOKEN -->

                                <td>

                                    <span class="queue-token">

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

                                    <div class="patient-table-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $appointment["first_name"]
                                            . " "
                                            . $appointment["last_name"]
                                        );
                                        ?>

                                    </div>

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

                                    <?php

                                    if (
                                        $status === "pending" ||
                                        $status === "scheduled"
                                    ) {

                                        $status_class =
                                            "status-"
                                            . $status;

                                    } elseif (
                                        $status === "completed"
                                    ) {

                                        $status_class =
                                            "status-completed";

                                    } elseif (
                                        $status === "cancelled"
                                    ) {

                                        $status_class =
                                            "status-cancelled";

                                    } else {

                                        $status_class =
                                            "status-pending";
                                    }

                                    ?>

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

                                        <div class="actions">


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
                                                    class="btn complete-btn"
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
                                                    class="btn cancel-btn"
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

                No appointments are scheduled for today.

            </div>

        <?php endif; ?>

    </div>


</main>


</body>

</html>
```
