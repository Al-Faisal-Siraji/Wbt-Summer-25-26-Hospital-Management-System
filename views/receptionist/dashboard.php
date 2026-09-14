

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"

>

<title>Receptionist Dashboard | MediCare HMS</title>

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

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/receptionist.css"
>

</head>

<body>

<div class="dashboard-container">

<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

```
<div class="sidebar-top">


    <div class="brand">


        <div class="logo">
            +
        </div>


        <div>

            <h2>MediCare</h2>

            <span>
                Hospital Management System
            </span>

        </div>


    </div>


    <!-- RECEPTIONIST PROFILE -->

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
                Receptionist
            </p>

        </div>


    </div>


    <!-- NAVIGATION -->

    <nav class="sidebar-menu">


        <!-- DASHBOARD -->

        <a
            href="receptionist.php"
            class="nav-item active"
        >

            <span class="nav-icon">
                ⌂
            </span>

            Dashboard

        </a>


        <!-- MANAGE APPOINTMENTS -->

        <a
            href="manage_appointments.php"
            class="nav-item"
        >

            <span class="nav-icon">
                📅
            </span>

            Appointments

        </a>


        <!-- PATIENTS -->

       <!-- PATIENTS -->

<a
    href="receptionist_patients.php"
    class="nav-item"
>

    <span class="nav-icon">
        👤
    </span>

    Patients

</a>


<!-- LIVE QUEUE -->

<a
    href="receptionist_queue.php"
    class="nav-item"
>

    <span class="nav-icon">
        ⏱
    </span>

    Live Queue

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
```

</aside>

<!-- ================= MAIN ================= -->

<main class="main-content">

```
<!-- HEADER -->

<header class="top-header">


    <div class="page-title">

        <p>
            Reception Portal
        </p>

        <h1>
            Dashboard
        </h1>

    </div>


    <div class="header-profile">


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


    </div>


</header>


<!-- ================= CONTENT ================= -->

<section class="dashboard-content">


    <!-- WELCOME -->

    <div class="welcome-section">


        <div>

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
                Manage appointments and hospital operations.
            </span>

        </div>


    </div>


    <!-- ================= STATISTICS ================= -->

    <div class="stats-grid">


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
                    echo $appointmentCount;
                    ?>

                </h3>

            </div>


        </div>


        <div class="stat-card">


            <div class="stat-icon">
                📆
            </div>


            <div>

                <p>
                    Today's Appointments
                </p>

                <h3>

                    <?php
                    echo $todayCount;
                    ?>

                </h3>

            </div>


        </div>


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
                    echo $patientCount;
                    ?>

                </h3>

            </div>


        </div>


        <div class="stat-card">


            <div class="stat-icon">
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

            </div>


        </div>


    </div>


    <!-- ================= RECENT APPOINTMENTS ================= -->

    <section
        class="appointments-section"
        id="appointments"
    >


        <div class="section-header">


            <div>

                <h2>
                    Recent Appointments
                </h2>

                <p>
                    Latest appointments in the system
                </p>

            </div>


        </div>


        <?php if (
            $recentResult &&
            mysqli_num_rows($recentResult) > 0
        ): ?>


            <div class="table-wrapper">


                <table>


                    <thead>

                        <tr>

                            <th>
                                Token
                            </th>

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

                                    echo
                                    htmlspecialchars(

                                        $appointment[
                                            "token_number"
                                        ] ??
                                        "--"

                                    );

                                    ?>

                                </td>


                                <td>

                                    <?php

                                    echo
                                    htmlspecialchars(

                                        $appointment[
                                            "patient_first_name"
                                        ]

                                    );

                                    ?>

                                    <?php

                                    echo
                                    htmlspecialchars(

                                        $appointment[
                                            "patient_last_name"
                                        ]

                                    );

                                    ?>

                                </td>


                                <td>

                                    Dr.

                                    <?php

                                    echo
                                    htmlspecialchars(

                                        $appointment[
                                            "doctor_first_name"
                                        ]

                                    );

                                    ?>

                                    <?php

                                    echo
                                    htmlspecialchars(

                                        $appointment[
                                            "doctor_last_name"
                                        ]

                                    );

                                    ?>

                                </td>


                                <td>

                                    <?php

                                    echo
                                    htmlspecialchars(

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

                                    echo
                                    $appointment[
                                        "appointment_time"
                                    ]
                                    ?
                                    date(

                                        "h:i A",

                                        strtotime(

                                            $appointment[
                                                "appointment_time"
                                            ]

                                        )

                                    )
                                    :
                                    "--";

                                    ?>

                                </td>


                                <td>


                                    <span
                                        class="status
                                        <?php

                                        echo
                                        htmlspecialchars(

                                            $appointment[
                                                "status"
                                            ]

                                        );

                                        ?>"
                                    >

                                        <?php

                                        echo
                                        htmlspecialchars(

                                            ucfirst(

                                                $appointment[
                                                    "status"
                                                ]

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


            <div class="empty-state">


                <div>
                    📅
                </div>


                <h3>
                    No Appointments Found
                </h3>


                <p>
                    There are currently no appointments in the system.
                </p>


            </div>


        <?php endif; ?>


    </section>


    <!-- ================= QUEUE ================= -->

    <section
        class="queue-section"
        id="queue"
    >


        <h2>
            Live Queue
        </h2>


        <p>
            Queue management will appear here.
        </p>


        <div class="queue-placeholder">


            <span>
                ⏱
            </span>


            <h3>
                No Active Queue Management Yet
            </h3>


            <p>
                The receptionist will be able to manage
                patient tokens from here.
            </p>


        </div>


    </section>


</section>
```

</main>

</div>

</body>

</html>


