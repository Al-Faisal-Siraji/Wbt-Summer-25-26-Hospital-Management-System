

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Find a Doctor - MediCare</title>


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


        /* =================================================
           LAYOUT
           ================================================= */

        .dashboard-container {

            display: flex;

            min-height: 100vh;

        }


        /* =================================================
           SIDEBAR
           ================================================= */

        .sidebar {

            width: 270px;

            height: 100vh;

            position: fixed;

            top: 0;

            left: 0;

            background: #ffffff;

            border-right: 1px solid #e5e7eb;

            display: flex;

            flex-direction: column;

            z-index: 1000;

        }


        /* =================================================
           BRAND
           ================================================= */

        .brand {

            padding: 28px 25px;

            border-bottom: 1px solid #eeeeee;

        }


        .brand h2 {

            color: #2563eb;

            font-size: 24px;

            margin-bottom: 5px;

        }


        .brand p {

            color: #777;

            font-size: 13px;

        }


        /* =================================================
           PROFILE
           ================================================= */

        .patient-profile {

            padding: 25px 20px;

            text-align: center;

            border-bottom: 1px solid #eeeeee;

        }


        .patient-avatar {

            width: 65px;

            height: 65px;

            margin: 0 auto 12px;

            border-radius: 50%;

            background: #2563eb;

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

            font-weight: bold;

        }


        .patient-profile h3 {

            font-size: 16px;

            margin-bottom: 5px;

        }


        .patient-profile p {

            color: #777;

            font-size: 13px;

        }


        /* =================================================
           NAVIGATION
           ================================================= */

        .nav-menu {

            padding: 20px 15px;

            flex: 1;

            overflow-y: auto;

        }


        .nav-item {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px 15px;

            margin-bottom: 8px;

            border-radius: 8px;

            text-decoration: none;

            color: #555;

            font-size: 14px;

            font-weight: 500;

            transition: 0.2s;

        }


        .nav-item:hover {

            background: #f1f5ff;

            color: #2563eb;

        }


        .nav-item.active {

            background: #2563eb;

            color: white;

        }


        .nav-icon {

            width: 20px;

            text-align: center;

            font-size: 17px;

        }


        /* =================================================
           LOGOUT
           ================================================= */

        .logout-section {

            padding: 15px;

            border-top: 1px solid #eeeeee;

        }


        .logout {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px 15px;

            color: #dc2626;

            text-decoration: none;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 500;

        }


        .logout:hover {

            background: #fef2f2;

        }


        /* =================================================
           MAIN CONTENT
           ================================================= */

        .main-content {

            margin-left: 270px;

            width: calc(100% - 270px);

            min-height: 100vh;

            padding: 30px;

        }


        /* =================================================
           HEADER
           ================================================= */

        .top-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;

        }


        .top-header h1 {

            font-size: 28px;

            margin-bottom: 6px;

        }


        .top-header p {

            color: #777;

            font-size: 14px;

        }


        .back-btn {

            text-decoration: none;

            color: #2563eb;

            font-size: 14px;

            font-weight: 600;

        }


        .back-btn:hover {

            text-decoration: underline;

        }


        /* =================================================
           PAGE INTRO
           ================================================= */

        .page-intro {

            background: #2563eb;

            color: white;

            padding: 28px 30px;

            border-radius: 12px;

            margin-bottom: 30px;

        }


        .page-intro h2 {

            font-size: 23px;

            margin-bottom: 8px;

        }


        .page-intro p {

            font-size: 14px;

            opacity: 0.9;

        }


        /* =================================================
           DOCTOR GRID
           ================================================= */

        .doctor-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(280px, 1fr));

            gap: 22px;

        }


        /* =================================================
           DOCTOR CARD
           ================================================= */

        .doctor-card {

            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 25px;

            transition: 0.2s;

        }


        .doctor-card:hover {

            transform: translateY(-3px);

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.08);

        }


        .doctor-top {

            display: flex;

            align-items: center;

            gap: 15px;

            margin-bottom: 20px;

        }


        .doctor-avatar-card {

            width: 60px;

            height: 60px;

            border-radius: 50%;

            background: #eff6ff;

            color: #2563eb;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            font-weight: bold;

        }


        .doctor-name {

            font-size: 17px;

            font-weight: 700;

            margin-bottom: 4px;

        }


        .specialization {

            color: #2563eb;

            font-size: 13px;

            font-weight: 600;

        }


        /* =================================================
           INFORMATION
           ================================================= */

        .doctor-info {

            border-top: 1px solid #eeeeee;

            padding-top: 15px;

        }


        .info-row {

            display: flex;

            justify-content: space-between;

            padding: 9px 0;

            font-size: 13px;

        }


        .info-label {

            color: #777;

        }


        .info-value {

            font-weight: 600;

            text-align: right;

        }


        /* =================================================
           AVAILABILITY
           ================================================= */

        .availability {

            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 600;

        }


        .available {

            background: #ecfdf5;

            color: #047857;

        }


        .unavailable {

            background: #fef2f2;

            color: #dc2626;

        }


        /* =================================================
           BOOK BUTTON
           ================================================= */

        .book-btn {

            display: block;

            width: 100%;

            margin-top: 18px;

            padding: 12px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            text-align: center;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 600;

            transition: 0.2s;

        }


        .book-btn:hover {

            background: #1d4ed8;

        }


        .book-btn.disabled {

            background: #cbd5e1;

            color: #64748b;

            cursor: not-allowed;

            pointer-events: none;

        }


        /* =================================================
           EMPTY STATE
           ================================================= */

        .empty-state {

            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 60px 20px;

            text-align: center;

        }


        .empty-icon {

            font-size: 45px;

            margin-bottom: 15px;

        }


        .empty-state h3 {

            margin-bottom: 8px;

        }


        .empty-state p {

            color: #777;

            font-size: 14px;

        }


        /* =================================================
           RESPONSIVE
           ================================================= */

        @media (max-width: 750px) {

            .sidebar {

                width: 220px;

            }


            .main-content {

                margin-left: 220px;

                width: calc(100% - 220px);

                padding: 20px;

            }

        }


        @media (max-width: 550px) {

            .sidebar {

                width: 190px;

            }


            .main-content {

                margin-left: 190px;

                width: calc(100% - 190px);

                padding: 15px;

            }


            .doctor-grid {

                grid-template-columns: 1fr;

            }

        }

    </style>

</head>


<body>


<div class="dashboard-container">


    <!-- =================================================
         SIDEBAR
         ================================================= -->

    <aside class="sidebar">


        <div class="brand">

            <h2>🏥 MediCare</h2>

            <p>Hospital Management</p>

        </div>


        <div class="patient-profile">


            <div class="patient-avatar">

                <?php

                echo strtoupper(

                    substr($firstName, 0, 1)

                );

                ?>

            </div>


            <h3>

                <?php

                echo htmlspecialchars($firstName);

                ?>

            </h3>


            <p>Patient</p>


        </div>


        <nav class="nav-menu">


            <a
                href="patient.php"
                class="nav-item"
            >

                <span class="nav-icon">🏠</span>

                Dashboard

            </a>


            <a
                href="doctors.php"
                class="nav-item active"
            >

                <span class="nav-icon">👨‍⚕️</span>

                Find a Doctor

            </a>


            <a
                href="book_appointment.php"
                class="nav-item"
            >

                <span class="nav-icon">📅</span>

                Book Appointment

            </a>


            <a
                href="queue.php"
                class="nav-item"
            >

                <span class="nav-icon">⏱</span>

                Live Queue

            </a>


            <a
                href="appointments.php"
                class="nav-item"
            >

                <span class="nav-icon">📋</span>

                My Appointments

            </a>


            <a
                href="history.php"
                class="nav-item"
            >

                <span class="nav-icon">🗂️</span>

                History

            </a>


        </nav>


        <div class="logout-section">


            <a
                href="logout.php"
                class="logout"
            >

                <span>🚪</span>

                Logout

            </a>


        </div>


    </aside>


    <!-- =================================================
         MAIN CONTENT
         ================================================= -->

    <main class="main-content">


        <!-- HEADER -->

        <div class="top-header">


            <div>

                <h1>Find a Doctor</h1>

                <p>

                    Choose a doctor and book your appointment.

                </p>

            </div>


            <a
                href="patient.php"
                class="back-btn"
            >

                ← Back to Dashboard

            </a>


        </div>


        <!-- INTRO -->

        <div class="page-intro">


            <h2>

                Our Doctors 👨‍⚕️

            </h2>


            <p>

                Browse our available doctors by department

                and specialization.

            </p>


        </div>


        <!-- =================================================
             DOCTOR LIST
             ================================================= -->

        <?php if (count($doctors) > 0): ?>


            <div class="doctor-grid">


                <?php foreach ($doctors as $doctor): ?>


                    <?php

                    $doctorFirstName =

                        $doctor["first_name"] ?? "";


                    $doctorLastName =

                        $doctor["last_name"] ?? "";


                    $doctorInitials =

                        strtoupper(

                            substr(

                                $doctorFirstName,

                                0,

                                1

                            )

                            .

                            substr(

                                $doctorLastName,

                                0,

                                1

                            )

                        );


                    $isAvailable =

                        strtolower(

                            trim(

                                $doctor["availability_status"]

                            )

                        ) === "available";


                    ?>


                    <div class="doctor-card">


                        <!-- DOCTOR HEADER -->

                        <div class="doctor-top">


                            <div class="doctor-avatar-card">

                                <?php

                                echo htmlspecialchars(

                                    $doctorInitials

                                );

                                ?>

                            </div>


                            <div>


                                <div class="doctor-name">

                                    Dr.

                                    <?php

                                    echo htmlspecialchars(

                                        $doctorFirstName

                                        . " "

                                        . $doctorLastName

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


                            </div>


                        </div>


                        <!-- DOCTOR INFORMATION -->

                        <div class="doctor-info">


                            <div class="info-row">


                                <span class="info-label">

                                    Department

                                </span>


                                <span class="info-value">

                                    <?php

                                    echo htmlspecialchars(

                                        $doctor["department_name"]

                                    );

                                    ?>

                                </span>


                            </div>


                            <div class="info-row">


                                <span class="info-label">

                                    Consultation Fee

                                </span>


                                <span class="info-value">

                                    ৳

                                    <?php

                                    echo number_format(

                                        (float)$doctor[

                                            "consultation_fee"

                                        ],

                                        2

                                    );

                                    ?>

                                </span>


                            </div>


                            <div class="info-row">


                                <span class="info-label">

                                    Status

                                </span>


                                <span>


                                    <?php if ($isAvailable): ?>


                                        <span

                                            class="availability available"

                                        >

                                            Available

                                        </span>


                                    <?php else: ?>


                                        <span

                                            class="availability unavailable"

                                        >

                                            Unavailable

                                        </span>


                                    <?php endif; ?>


                                </span>


                            </div>


                        </div>


                        <!-- BOOK BUTTON -->

                        <?php if ($isAvailable): ?>


                            <a

                                href="book_appointment.php?doctor_id=<?php

                                echo (int)$doctor["doctor_id"];

                                ?>"

                                class="book-btn"

                            >

                                Book Appointment

                            </a>


                        <?php else: ?>


                            <span

                                class="book-btn disabled"

                            >

                                Currently Unavailable

                            </span>


                        <?php endif; ?>


                    </div>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <div class="empty-state">


                <div class="empty-icon">

                    👨‍⚕️

                </div>


                <h3>

                    No Doctors Available

                </h3>


                <p>

                    There are currently no doctors registered

                    in the system.

                </p>


            </div>


        <?php endif; ?>


    </main>


</div>


</body>

</html>
```
