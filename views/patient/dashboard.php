

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Patient Dashboard | MediCare HMS</title>


    <!-- Google Font -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- Patient CSS -->

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/patient.css"
    >

</head>


<body>


<div class="dashboard-container">


    <!-- ===============================
         SIDEBAR
    ================================= -->

    <aside class="sidebar">


        <div class="sidebar-top">


            <!-- BRAND -->

            <div class="brand">


                <div class="logo">
                    +
                </div>


                <div>

                    <h2>
                        MediCare
                    </h2>

                    <span>
                        Hospital Management
                    </span>

                </div>


            </div>


            <!-- PATIENT PROFILE -->

            <div class="patient-profile">


                <div class="profile-avatar">

                    <?php

                    echo htmlspecialchars(

                        strtoupper(
                            substr($firstName, 0, 1)
                        )

                    );

                    ?>

                </div>


                <div>

                    <h3>

                        <?php

                        echo htmlspecialchars(
                            $firstName
                        );

                        ?>

                    </h3>


                    <p>
                        Patient
                    </p>

                </div>


            </div>


            <!-- NAVIGATION -->

            <nav class="sidebar-menu">


                <!-- DASHBOARD -->

                <a
                    href="patient.php"
                    class="nav-item active"
                >

                    <span class="nav-icon">
                        ⌂
                    </span>

                    Dashboard

                </a>


                <!-- DOCTORS -->

                <a
                    href="doctors.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ♟
                    </span>

                    Doctors

                </a>


                <!-- APPOINTMENTS -->

                <a
                    href="appointments.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ▣
                    </span>

                    Appointments

                </a>


                <!-- LIVE QUEUE -->

                <a
                    href="queue.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ☰
                    </span>

                    Live Queue

                </a>


                <!-- MEDICAL HISTORY -->

                <a
                    href="#history"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ◷
                    </span>

                    Medical History

                </a>


            </nav>


        </div>


        <!-- LOGOUT -->

        <div class="sidebar-bottom">


            <a
                href="logout.php"
                class="logout-btn"
            >

                <span>
                    ⇥
                </span>

                Logout

            </a>


        </div>


    </aside>


    <!-- ===============================
         MAIN CONTENT
    ================================= -->

    <main class="main-content">


        <!-- ===============================
             HEADER
        ================================= -->

        <header class="top-header">


            <button
                class="menu-toggle"
                id="menuToggle"
            >

                ☰

            </button>


            <div class="page-title">


                <p>
                    Patient Portal
                </p>


                <h1>
                    Dashboard
                </h1>


            </div>


            <div class="header-right">


                <div class="notification">
                    🔔
                </div>


                <div class="header-avatar">

                    <?php

                    echo htmlspecialchars(

                        strtoupper(
                            substr($firstName, 0, 1)
                        )

                    );

                    ?>

                </div>


            </div>


        </header>


        <!-- ===============================
             DASHBOARD CONTENT
        ================================= -->

        <section class="dashboard-content">


            <!-- ===============================
                 WELCOME SECTION
            ================================= -->

            <div class="welcome-section">


                <div>


                    <p class="date-text">
                        Welcome to MediCare Hospital
                    </p>


                    <h2>

                        Hello,

                        <?php

                        echo htmlspecialchars(
                            $firstName
                        );

                        ?>

                        ! 👋

                    </h2>


                    <p>
                        Here's an overview of your healthcare today.
                    </p>


                </div>


                <a
                    href="doctors.php"
                    class="book-btn"
                >

                    + Book Appointment

                </a>


            </div>


            <!-- ===============================
                 STATISTICS
            ================================= -->

            <div class="stats-grid">


                <!-- UPCOMING APPOINTMENT -->

                <div class="stat-card">


                    <div class="stat-icon appointment-icon">
                        📅
                    </div>


                    <div>


                        <p>
                            Upcoming Appointment
                        </p>


                        <h3>

                            <?php

                            echo $appointmentCount;

                            ?>

                        </h3>


                        <span>

                            <?php if ($appointmentCount > 0): ?>

                                Appointment<?php

                                echo $appointmentCount > 1
                                    ? "s"
                                    : "";

                                ?> scheduled

                            <?php else: ?>

                                No upcoming appointments

                            <?php endif; ?>

                        </span>


                    </div>


                </div>


                <!-- QUEUE STATUS -->

                <div class="stat-card">


                    <div class="stat-icon queue-icon">
                        ⏱
                    </div>


                    <div>


                        <p>
                            Queue Status
                        </p>


                        <h3>


                            <?php if ($nextAppointment !== null): ?>

                                #

                                <?php

                                echo htmlspecialchars(
                                    $nextAppointment["token_number"]
                                );

                                ?>

                            <?php else: ?>

                                --

                            <?php endif; ?>


                        </h3>


                        <span>


                            <?php if ($nextAppointment !== null): ?>


                                <?php

                                echo $patientsAhead;

                                ?>

                                patient<?php

                                echo $patientsAhead != 1
                                    ? "s"
                                    : "";

                                ?>

                                ahead


                            <?php else: ?>


                                No active token


                            <?php endif; ?>


                        </span>


                    </div>


                </div>


                <!-- AVAILABLE DOCTORS -->

                <div class="stat-card">


                    <div class="stat-icon doctor-icon">
                        👨‍⚕️
                    </div>


                    <div>


                        <p>
                            Available Doctors
                        </p>


                        <h3>

                            <?php

                            echo $doctorCount;

                            ?>

                        </h3>


                        <span>
                            Doctors currently available
                        </span>


                    </div>


                </div>


                <!-- CHECKUP HISTORY -->

                <div
                    class="stat-card"
                    id="history"
                >


                    <div class="stat-icon history-icon">
                        🩺
                    </div>


                    <div>


                        <p>
                            Checkup History
                        </p>


                        <h3>

                            <?php

                            echo $historyCount;

                            ?>

                        </h3>


                        <span>


                            <?php if ($historyCount > 0): ?>


                                Completed checkup<?php

                                echo $historyCount > 1
                                    ? "s"
                                    : "";

                                ?>


                            <?php else: ?>


                                No previous records


                            <?php endif; ?>


                        </span>


                    </div>


                </div>


            </div>


            <!-- ===============================
                 CONTENT GRID
            ================================= -->

            <div class="content-grid">


                <!-- ===============================
                     UPCOMING APPOINTMENT
                ================================= -->

                <section
                    class="dashboard-card"
                    id="appointments"
                >


                    <div class="card-header">


                        <div>

                            <h2>
                                Upcoming Appointment
                            </h2>

                            <p>
                                Your next scheduled visit
                            </p>

                        </div>


                    </div>


                    <?php if ($nextAppointment): ?>


                        <div class="appointment-details">


                            <!-- DOCTOR -->

                            <div class="appointment-doctor">


                                <div class="appointment-avatar">


                                    <?php

                                    echo htmlspecialchars(

                                        strtoupper(

                                            substr(

                                                $nextAppointment[
                                                    "doctor_first_name"
                                                ],

                                                0,
                                                1

                                            )

                                        )

                                    );

                                    ?>


                                </div>


                                <div>


                                    <h3>

                                        Dr.

                                        <?php

                                        echo htmlspecialchars(

                                            $nextAppointment[
                                                "doctor_first_name"
                                            ]

                                        );

                                        ?>

                                        <?php

                                        echo htmlspecialchars(

                                            $nextAppointment[
                                                "doctor_last_name"
                                            ]

                                        );

                                        ?>

                                    </h3>


                                    <p>

                                        <?php

                                        echo htmlspecialchars(

                                            $nextAppointment[
                                                "specialization"
                                            ]

                                        );

                                        ?>

                                    </p>


                                </div>


                            </div>


                            <!-- APPOINTMENT INFORMATION -->

                            <div class="appointment-info">


                                <!-- DATE -->

                                <div>


                                    <span>
                                        Date
                                    </span>


                                    <strong>

                                        <?php

                                        echo date(

                                            "d M Y",

                                            strtotime(

                                                $nextAppointment[
                                                    "appointment_date"
                                                ]

                                            )

                                        );

                                        ?>

                                    </strong>


                                </div>


                                <!-- TIME -->

                                <div>


                                    <span>
                                        Time
                                    </span>


                                    <strong>

                                        <?php

                                        echo date(

                                            "h:i A",

                                            strtotime(

                                                $nextAppointment[
                                                    "appointment_time"
                                                ]

                                            )

                                        );

                                        ?>

                                    </strong>


                                </div>


                                <!-- DEPARTMENT -->

                                <div>


                                    <span>
                                        Department
                                    </span>


                                    <strong>

                                        <?php

                                        echo htmlspecialchars(

                                            $nextAppointment[
                                                "department_name"
                                            ]

                                        );

                                        ?>

                                    </strong>


                                </div>


                                <!-- TOKEN -->

                                <div>


                                    <span>
                                        Token
                                    </span>


                                    <strong>

                                        #

                                        <?php

                                        echo htmlspecialchars(

                                            $nextAppointment[
                                                "token_number"
                                            ]

                                        );

                                        ?>

                                    </strong>


                                </div>


                                <!-- STATUS -->

                                <div>


                                    <span>
                                        Status
                                    </span>


                                    <strong
                                        class="appointment-status"
                                    >

                                        <?php

                                        echo htmlspecialchars(

                                            ucfirst(

                                                $nextAppointment[
                                                    "status"
                                                ]

                                            )

                                        );

                                        ?>

                                    </strong>


                                </div>


                            </div>


                            <!-- VIEW APPOINTMENTS -->

                            <a
                                href="appointments.php"
                                class="view-appointment-btn"
                            >

                                View All Appointments →

                            </a>


                        </div>


                    <?php else: ?>


                        <!-- EMPTY APPOINTMENT -->

                        <div class="empty-state">


                            <div class="empty-icon">
                                📅
                            </div>


                            <h3>
                                No Upcoming Appointment
                            </h3>


                            <p>

                                You don't have any upcoming appointments.
                                Book an appointment to get started.

                            </p>


                            <a
                                href="doctors.php"
                                class="book-btn"
                            >

                                Book Appointment

                            </a>


                        </div>


                    <?php endif; ?>


                </section>


                <!-- ===============================
                     LIVE QUEUE
                ================================= -->

                <section
                    class="dashboard-card queue-card"
                >


                    <div class="card-header">


                        <div>

                            <h2>
                                Live Queue
                            </h2>


                            <p>
                                Your current queue status
                            </p>

                        </div>


                        <span class="live-status">


                            <span></span>


                            LIVE


                        </span>


                    </div>


                    <?php if ($nextAppointment !== null): ?>


                        <div class="queue-active">


                            <div class="queue-circle">


                                <?php

                                echo htmlspecialchars(

                                    $nextAppointment[
                                        "token_number"
                                    ]

                                );

                                ?>


                            </div>


                            <h3>
                                Your Token Number
                            </h3>


                            <p>


                                <?php

                                echo $patientsAhead;

                                ?>

                                patient<?php

                                echo $patientsAhead != 1
                                    ? "s"
                                    : "";

                                ?>

                                ahead of you


                            </p>


                            <a
                                href="queue.php"
                                class="view-queue-btn"
                            >

                                View Live Queue →

                            </a>


                        </div>


                    <?php else: ?>


                        <div class="queue-empty">


                            <div class="queue-circle">
                                --
                            </div>


                            <h3>
                                No Active Queue
                            </h3>


                            <p>
                                Your queue information will appear here.
                            </p>


                        </div>


                    <?php endif; ?>


                </section>


            </div>


            <!-- ===============================
                 QUICK ACTIONS
            ================================= -->

            <section class="quick-actions">


                <div class="section-title">


                    <h2>
                        Quick Actions
                    </h2>


                    <p>
                        Quickly access common healthcare services
                    </p>


                </div>


                <div class="action-grid">


                    <!-- FIND DOCTOR -->

                    <a
                        href="doctors.php"
                        class="action-card"
                    >


                        <span class="action-icon">
                            👨‍⚕️
                        </span>


                        <div>


                            <h3>
                                Find a Doctor
                            </h3>


                            <p>
                                Check doctor availability
                            </p>


                        </div>


                        <span class="arrow">
                            →
                        </span>


                    </a>


                    <!-- BOOK APPOINTMENT -->

                    <a
                        href="doctors.php"
                        class="action-card"
                    >


                        <span class="action-icon">
                            📅
                        </span>


                        <div>


                            <h3>
                                Book Appointment
                            </h3>


                            <p>
                                Schedule your hospital visit
                            </p>


                        </div>


                        <span class="arrow">
                            →
                        </span>


                    </a>


                    <!-- TRACK QUEUE -->

                    <a
                        href="queue.php"
                        class="action-card"
                    >


                        <span class="action-icon">
                            ⏱
                        </span>


                        <div>


                            <h3>
                                Track Queue
                            </h3>


                            <p>
                                See your live position
                            </p>


                        </div>


                        <span class="arrow">
                            →
                        </span>


                    </a>


                    <!-- MEDICAL HISTORY -->

                    <a
                        href="#history"
                        class="action-card"
                    >


                        <span class="action-icon">
                            📋
                        </span>


                        <div>


                            <h3>
                                Medical History
                            </h3>


                            <p>
                                View previous checkups
                            </p>


                        </div>


                        <span class="arrow">
                            →
                        </span>


                    </a>


                </div>


            </section>


        </section>


    </main>


</div>


<!-- Patient JavaScript -->

<script src="<?= BASE_URL ?>/assets/js/patient.js"></script>


</body>

</html>



