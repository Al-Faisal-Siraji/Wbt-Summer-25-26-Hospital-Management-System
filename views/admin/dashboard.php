

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Dashboard | MediCare HMS</title>


    <!-- GOOGLE FONT -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    >


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        :root {

            --primary: #0d4a85;
            --primary-dark: #0b3b6b;

            --background: #f5f7fb;

            --text: #1e293b;

            --muted: #64748b;

            --border: #e2e8f0;

        }


        body {

            font-family:
                "Inter",
                Arial,
                sans-serif;

            background:
                var(--background);

            color:
                var(--text);

        }


        /* =================================
           LAYOUT
        ================================= */

        .dashboard-container {

            min-height: 100vh;

            display: flex;

        }


        /* =================================
           SIDEBAR
        ================================= */

        .sidebar {

            width: 270px;

            height: 100vh;

            position: fixed;

            left: 0;

            top: 0;

            background: white;

            border-right:
                1px solid var(--border);

            padding: 25px 16px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

        }


        .brand {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 0 10px;

        }


        .logo {

            width: 44px;

            height: 44px;

            background:
                var(--primary);

            color: white;

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

            font-weight: 700;

        }


        .brand h2 {

            font-size: 19px;

        }


        .brand span {

            color: var(--muted);

            font-size: 11px;

        }


        /* =================================
           PROFILE
        ================================= */

        .profile {

            margin: 35px 8px;

            padding: 16px;

            background: #f8fafc;

            border-radius: 14px;

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .profile-avatar {

            width: 42px;

            height: 42px;

            background: #dbeafe;

            color: var(--primary);

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 700;

        }


        .profile h3 {

            font-size: 14px;

        }


        .profile p {

            color: var(--muted);

            font-size: 12px;

            margin-top: 4px;

        }


        /* =================================
           NAVIGATION
        ================================= */

        .sidebar-menu {

            display: flex;

            flex-direction: column;

            gap: 7px;

        }


        .nav-item {

            text-decoration: none;

            color: var(--muted);

            padding: 13px 15px;

            border-radius: 10px;

            display: flex;

            align-items: center;

            gap: 12px;

            font-size: 14px;

        }


        .nav-item:hover,
        .nav-item.active {

            background: #e8f1fb;

            color: var(--primary);

            font-weight: 600;

        }


        .nav-icon {

            font-size: 17px;

        }


        .logout-btn {

            display: flex;

            align-items: center;

            gap: 12px;

            color: #dc2626;

            text-decoration: none;

            padding: 13px 15px;

            border-radius: 10px;

        }


        .logout-btn:hover {

            background: #fef2f2;

        }


        /* =================================
           MAIN
        ================================= */

        .main-content {

            margin-left: 270px;

            width:
                calc(100% - 270px);

            min-height: 100vh;

        }


        /* =================================
           HEADER
        ================================= */

        .top-header {

            height: 90px;

            background: white;

            border-bottom:
                1px solid var(--border);

            padding: 0 40px;

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        .page-title p {

            color: var(--muted);

            font-size: 12px;

            margin-bottom: 4px;

        }


        .page-title h1 {

            font-size: 22px;

        }


        .header-avatar {

            width: 42px;

            height: 42px;

            background: #dbeafe;

            color: var(--primary);

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 700;

        }


        /* =================================
           CONTENT
        ================================= */

        .dashboard-content {

            padding:
                35px 40px 50px;

        }


        /* =================================
           WELCOME
        ================================= */

        .welcome-section {

            background:
                linear-gradient(
                    135deg,
                    #0b2d5c,
                    #0d4a85
                );

            color: white;

            border-radius: 18px;

            padding: 32px 35px;

            margin-bottom: 28px;

        }


        .welcome-section p {

            color: #bfdbfe;

            font-size: 13px;

            margin-bottom: 10px;

        }


        .welcome-section h2 {

            font-size: 27px;

            margin-bottom: 8px;

        }


        .welcome-section span {

            color: #dbeafe;

            font-size: 14px;

        }


        /* =================================
           STATISTICS
        ================================= */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 28px;

        }


        .stat-card {

            background: white;

            border:
                1px solid var(--border);

            border-radius: 15px;

            padding: 22px;

            display: flex;

            align-items: center;

            gap: 16px;

        }


        .stat-icon {

            width: 48px;

            height: 48px;

            border-radius: 12px;

            background: #eff6ff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

        }


        .stat-card p {

            color: var(--muted);

            font-size: 12px;

            margin-bottom: 6px;

        }


        .stat-card h3 {

            font-size: 24px;

        }


        /* =================================
           APPOINTMENTS
        ================================= */

        .appointments-section {

            background: white;

            border:
                1px solid var(--border);

            border-radius: 16px;

            padding: 25px;

        }


        .section-header {

            margin-bottom: 20px;

        }


        .section-header h2 {

            font-size: 20px;

            margin-bottom: 5px;

        }


        .section-header p {

            color: var(--muted);

            font-size: 13px;

        }


        .table-wrapper {

            width: 100%;

            overflow-x: auto;

        }


        table {

            width: 100%;

            border-collapse:
                collapse;

        }


        th {

            text-align: left;

            padding: 13px;

            background: #f8fafc;

            color: var(--muted);

            font-size: 12px;

        }


        td {

            padding: 15px 13px;

            border-bottom:
                1px solid var(--border);

            font-size: 13px;

        }


        .status {

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 600;

        }


        .status.scheduled {

            background: #dbeafe;

            color: #1d4ed8;

        }


        .status.confirmed {

            background: #dcfce7;

            color: #15803d;

        }


        .status.completed {

            background: #e0e7ff;

            color: #4338ca;

        }


        .status.cancelled {

            background: #fee2e2;

            color: #dc2626;

        }


        .status.waiting {

            background: #fef3c7;

            color: #b45309;

        }


        .status.calling {

            background: #dbeafe;

            color: #1d4ed8;

        }


        .status.in_consultation {

            background: #ede9fe;

            color: #7c3aed;

        }


        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 1100px) {

            .stats-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }


        @media (max-width: 900px) {

            .sidebar {

                width: 230px;

            }

            .main-content {

                margin-left: 230px;

                width:
                    calc(100% - 230px);

            }

        }


        @media (max-width: 650px) {

            .sidebar {

                display: none;

            }

            .main-content {

                margin-left: 0;

                width: 100%;

            }

            .dashboard-content {

                padding: 25px 15px;

            }

            .stats-grid {

                grid-template-columns: 1fr;

            }

        }

    </style>

</head>


<body>


<div class="dashboard-container">


    <!-- =================================
         SIDEBAR
    ================================= -->

    <aside class="sidebar">


        <div>


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


            <!-- ADMIN PROFILE -->

            <div class="profile">

                <div class="profile-avatar">

                    <?php

                    echo htmlspecialchars(
                        strtoupper(
                            substr(
                                $firstName,
                                0,
                                1
                            )
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
                        Administrator
                    </p>

                </div>

            </div>


            <!-- NAVIGATION -->

            <nav class="sidebar-menu">


                <a
                    href="admin.php"
                    class="nav-item active"
                >

                    <span class="nav-icon">
                        ⌂
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>


                <a
                    href="admin_doctors.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        👨‍⚕️
                    </span>

                    <span>
                        Doctors
                    </span>

                </a>


                <a
                    href="admin_departments.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        🏥
                    </span>

                    <span>
                        Departments
                    </span>

                </a>


                <a
                    href="admin_resources.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        📦
                    </span>

                    <span>
                        Resources
                    </span>

                </a>


                <a
                    href="admin_performance.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        📊
                    </span>

                    <span>
                        Performance
                    </span>

                </a>


            </nav>


        </div>


        <!-- LOGOUT -->

        <div>

            <a
                href="logout.php"
                class="logout-btn"
            >

                <span>
                    ⇥
                </span>

                <span>
                    Logout
                </span>

            </a>

        </div>


    </aside>


    <!-- =================================
         MAIN CONTENT
    ================================= -->

    <main class="main-content">


        <!-- HEADER -->

        <header class="top-header">


            <div class="page-title">

                <p>
                    Administration Portal
                </p>

                <h1>
                    Admin Dashboard
                </h1>

            </div>


            <div class="header-avatar">

                <?php

                echo htmlspecialchars(
                    strtoupper(
                        substr(
                            $firstName,
                            0,
                            1
                        )
                    )
                );

                ?>

            </div>


        </header>


        <!-- CONTENT -->

        <section class="dashboard-content">


            <!-- WELCOME -->

            <div class="welcome-section">

                <p>
                    MediCare Hospital
                </p>

                <h2>

                    Welcome,
                    <?php
                    echo htmlspecialchars(
                        $firstName
                    );
                    ?>
                    👋

                </h2>

                <span>
                    Manage hospital operations,
                    doctors, departments and resources.
                </span>

            </div>


            <!-- STATISTICS -->

            <div class="stats-grid">


                <!-- DOCTORS -->

                <div class="stat-card">

                    <div class="stat-icon">
                        👨‍⚕️
                    </div>

                    <div>

                        <p>
                            Total Doctors
                        </p>

                        <h3>
                            <?php
                            echo $totalDoctors;
                            ?>
                        </h3>

                    </div>

                </div>


                <!-- PATIENTS -->

                <div class="stat-card">

                    <div class="stat-icon">
                        👤
                    </div>

                    <div>

                        <p>
                            Total Patients
                        </p>

                        <h3>
                            <?php
                            echo $totalPatients;
                            ?>
                        </h3>

                    </div>

                </div>


                <!-- APPOINTMENTS -->

                <div class="stat-card">

                    <div class="stat-icon">
                        📅
                    </div>

                    <div>

                        <p>
                            Total Appointments
                        </p>

                        <h3>
                            <?php
                            echo $totalAppointments;
                            ?>
                        </h3>

                    </div>

                </div>


                <!-- DEPARTMENTS -->

                <div class="stat-card">

                    <div class="stat-icon">
                        🏥
                    </div>

                    <div>

                        <p>
                            Departments
                        </p>

                        <h3>
                            <?php
                            echo $totalDepartments;
                            ?>
                        </h3>

                    </div>

                </div>


            </div>


            <!-- RECENT APPOINTMENTS -->

            <section class="appointments-section">


                <div class="section-header">

                    <h2>
                        Recent Appointments
                    </h2>

                    <p>
                        Latest appointments registered
                        in the hospital system.
                    </p>

                </div>


                <?php

                if (
                    $recentResult &&
                    mysqli_num_rows($recentResult) > 0
                ):

                ?>

                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>
                                        Patient
                                    </th>

                                    <th>
                                        Doctor
                                    </th>

                                    <th>
                                        Department
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Time
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                            <?php

                            while (
                                $appointment =
                                mysqli_fetch_assoc($recentResult)
                            ):

                            ?>

                                <tr>


                                    <td>

                                        <?php

                                        echo htmlspecialchars(
                                            $appointment[
                                                "patient_first_name"
                                            ]
                                        );

                                        ?>

                                        <?php

                                        echo htmlspecialchars(
                                            $appointment[
                                                "patient_last_name"
                                            ]
                                        );

                                        ?>

                                    </td>


                                    <td>

                                        Dr.

                                        <?php

                                        echo htmlspecialchars(
                                            $appointment[
                                                "doctor_first_name"
                                            ]
                                        );

                                        ?>

                                        <?php

                                        echo htmlspecialchars(
                                            $appointment[
                                                "doctor_last_name"
                                            ]
                                        );

                                        ?>

                                    </td>


                                    <td>

                                        <?php

                                        echo htmlspecialchars(
                                            $appointment[
                                                "department_name"
                                            ]
                                        );

                                        ?>

                                    </td>


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


                                    <td>

                                        <?php

                                        if (
                                            !empty(
                                                $appointment[
                                                    "appointment_time"
                                                ]
                                            )
                                        ) {

                                            echo date(
                                                "h:i A",
                                                strtotime(
                                                    $appointment[
                                                        "appointment_time"
                                                    ]
                                                )
                                            );

                                        } else {

                                            echo "--";

                                        }

                                        ?>

                                    </td>


                                    <td>

                                        <?php

                                        $status =
                                            strtolower(
                                                $appointment[
                                                    "status"
                                                ]
                                            );

                                        ?>

                                        <span
                                            class="
                                                status
                                                <?php
                                                echo htmlspecialchars(
                                                    $status
                                                );
                                                ?>
                                            "
                                        >

                                            <?php

                                            echo htmlspecialchars(
                                                ucfirst(
                                                    str_replace(
                                                        "_",
                                                        " ",
                                                        $status
                                                    )
                                                )
                                            );

                                            ?>

                                        </span>

                                    </td>


                                </tr>

                            <?php endwhile; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div
                        style="
                            text-align:center;
                            padding:40px;
                            color:#64748b;
                        "
                    >

                        No appointments found.

                    </div>

                <?php endif; ?>


            </section>


        </section>


    </main>


</div>


</body>

</html>



