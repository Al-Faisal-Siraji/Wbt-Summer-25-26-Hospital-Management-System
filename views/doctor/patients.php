

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Patients - Doctor - MediCare</title>

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
           STATISTICS
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
           CARD
           ===================================================== */

        .card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 25px;

            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }


        /* =====================================================
           SEARCH
           ===================================================== */

        .top-section {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 22px;

            gap: 20px;
        }

        .top-section h2 {
            font-size: 19px;

            color: #111827;
        }

        .search-form {
            display: flex;

            gap: 8px;
        }

        .search-input {
            width: 280px;

            padding: 10px 13px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            outline: none;

            font-size: 14px;
        }

        .search-input:focus {
            border-color: #2563eb;
        }

        .search-btn {
            border: none;

            background: #2563eb;

            color: white;

            padding: 10px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: bold;
        }

        .search-btn:hover {
            background: #1d4ed8;
        }

        .clear-btn {
            text-decoration: none;

            background: #f3f4f6;

            color: #4b5563;

            padding: 10px 14px;

            border-radius: 8px;

            font-size: 13px;

            display: flex;

            align-items: center;
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

            padding: 14px;
        }

        td {
            padding: 15px 14px;

            border-top: 1px solid #f0f0f0;

            font-size: 14px;

            vertical-align: middle;
        }


        /* =====================================================
           PATIENT
           ===================================================== */

        .patient-info {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .patient-avatar {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            background: #dbeafe;

            color: #2563eb;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: bold;

            font-size: 16px;
        }

        .patient-name {
            font-weight: bold;

            color: #111827;
        }

        .patient-email {
            font-size: 12px;

            color: #9ca3af;

            margin-top: 3px;
        }

        .visits {
            font-weight: bold;

            color: #2563eb;
        }


        /* =====================================================
           VIEW BUTTON
           ===================================================== */

        .view-btn {
            display: inline-block;

            text-decoration: none;

            padding: 8px 12px;

            background: #eff6ff;

            color: #2563eb;

            border-radius: 7px;

            font-size: 12px;

            font-weight: bold;
        }

        .view-btn:hover {
            background: #dbeafe;
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

            .top-section {
                flex-direction: column;

                align-items: flex-start;
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

            .search-form {
                width: 100%;

                flex-wrap: wrap;
            }

            .search-input {
                width: 100%;
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

        <a href="doctor_appointments.php" class="nav-item">
            📅 Appointments
        </a>

        <a href="doctor_patients.php"
           class="nav-item active">
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

            <h1>My Patients</h1>

            <p>
                View patients who have appointments with you
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
                    echo htmlspecialchars(
                        $doctor_name
                    );
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


    <!-- =====================================================
         STATISTICS
         ===================================================== -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-title">
                Total Patients
            </div>

            <div class="stat-number">
                <?php
                echo $total_patients;
                ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Today's Patients
            </div>

            <div class="stat-number">
                <?php
                echo $today_patients;
                ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Total Visits
            </div>

            <div class="stat-number">
                <?php
                echo $total_visits;
                ?>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-title">
                Completed Visits
            </div>

            <div class="stat-number">
                <?php
                echo $completed_visits;
                ?>
            </div>

        </div>

    </div>


    <!-- =====================================================
         PATIENT LIST
         ===================================================== -->

    <div class="card">


        <div class="top-section">

            <h2>
                Patient List
            </h2>


            <form
                method="GET"
                class="search-form"
            >

                <input
                    type="text"
                    name="search"
                    class="search-input"
                    placeholder="Search patient..."
                    value="<?php
                    echo htmlspecialchars($search);
                    ?>"
                >


                <button
                    type="submit"
                    class="search-btn"
                >
                    Search
                </button>


                <?php if ($search !== ""): ?>

                    <a
                        href="doctor_patients.php"
                        class="clear-btn"
                    >
                        Clear
                    </a>

                <?php endif; ?>

            </form>

        </div>


        <?php if (count($patients) > 0): ?>


            <div class="table-container">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Patient
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Total Visits
                            </th>

                            <th>
                                Last Visit
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($patients as $patient): ?>


                            <tr>


                                <!-- PATIENT -->

                                <td>

                                    <div class="patient-info">


                                        <div class="patient-avatar">

                                            <?php
                                            echo strtoupper(
                                                substr(
                                                    $patient[
                                                        "first_name"
                                                    ],
                                                    0,
                                                    1
                                                )
                                            );
                                            ?>

                                        </div>


                                        <div>

                                            <div
                                                class="patient-name"
                                            >

                                                <?php
                                                echo htmlspecialchars(
                                                    $patient[
                                                        "first_name"
                                                    ]
                                                    . " "
                                                    . $patient[
                                                        "last_name"
                                                    ]
                                                );
                                                ?>

                                            </div>


                                            <div
                                                class="patient-email"
                                            >

                                                Patient

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $patient["email"]
                                    );
                                    ?>

                                </td>


                                <!-- VISITS -->

                                <td>

                                    <span class="visits">

                                        <?php
                                        echo (int)
                                            $patient[
                                                "total_appointments"
                                            ];
                                        ?>

                                    </span>

                                </td>


                                <!-- LAST VISIT -->

                                <td>

                                    <?php

                                    if (
                                        !empty(
                                            $patient[
                                                "last_visit"
                                            ]
                                        )
                                    ) {

                                        echo date(
                                            "d M Y",
                                            strtotime(
                                                $patient[
                                                    "last_visit"
                                                ]
                                            )
                                        );

                                    } else {

                                        echo "No visit";

                                    }

                                    ?>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="doctor_patient_details.php?patient_id=<?php
                                        echo (int)
                                            $patient["user_id"];
                                        ?>"
                                        class="view-btn"
                                    >
                                        View Details
                                    </a>

                                </td>


                            </tr>


                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <div class="empty">

                <?php if ($search !== ""): ?>

                    No patients found for
                    "<strong><?php
                    echo htmlspecialchars($search);
                    ?></strong>".

                <?php else: ?>

                    You don't have any patients yet.

                <?php endif; ?>

            </div>


        <?php endif; ?>


    </div>


</main>


</body>

</html>
```
