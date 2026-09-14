

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Appointments | MediCare HMS</title>

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

    <!-- USE THE SAME CSS AS RECEPTIONIST DASHBOARD -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/receptionist.css"
    >

</head>


<body>


<div class="dashboard-container">


    <!-- ===============================
         SIDEBAR
    ================================ -->

    <aside class="sidebar">


        <div>

            <!-- BRAND -->

            <div class="brand">

                <div class="logo">
                    +
                </div>

                <div>

                    <h2>MediCare</h2>

                    <span>
                        Hospital Management
                    </span>

                </div>

            </div>


            <!-- PROFILE -->

            <div class="profile">

                <div class="profile-avatar">
                    R
                </div>

                <div>

                    <h3>
                        Receptionist
                    </h3>

                    <p>
                        Reception Management
                    </p>

                </div>

            </div>


            <!-- NAVIGATION -->

            <nav class="sidebar-menu">


                <!-- DASHBOARD -->

                <a
                    href="receptionist.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ▦
                    </span>

                    Dashboard

                </a>


                <!-- APPOINTMENTS -->

                <a
                    href="manage_appointments.php"
                    class="nav-item active"
                >

                    <span class="nav-icon">
                        📅
                    </span>

                    Appointments

                </a>


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

        <div>

            <a
                href="logout.php"
                class="logout-btn"
            >

                <span class="nav-icon">
                    ↪
                </span>

                Logout

            </a>

        </div>


    </aside>



    <!-- ===============================
         MAIN CONTENT
    ================================ -->

    <main class="main-content">


        <!-- TOP HEADER -->

        <header class="top-header">


            <div class="page-title">

                <p>
                    Reception Management
                </p>

                <h1>
                    Appointments
                </h1>

            </div>


            <div class="header-avatar">
                R
            </div>


        </header>



        <!-- ===============================
             CONTENT
        ================================ -->

        <div class="dashboard-content">


            <!-- PAGE INTRODUCTION -->

            <section class="welcome-section">

                <p>
                    Appointment Management
                </p>

                <h2>
                    Manage Patient Appointments
                </h2>

                <span>
                    Confirm, complete, or cancel patient appointments.
                </span>

            </section>



            <!-- MESSAGE -->

            <?php if ($message !== ""): ?>

                <div class="message">

                    <?php
                    echo htmlspecialchars($message);
                    ?>

                </div>

            <?php endif; ?>



            <!-- APPOINTMENTS -->

            <section class="appointments-section">


                <div class="section-header">

                    <h2>
                        All Appointments
                    </h2>

                    <p>
                        View and manage all patient appointments.
                    </p>

                </div>



                <?php if (
                    $result &&
                    mysqli_num_rows($result) > 0
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

                                    <th>
                                        Actions
                                    </th>

                                </tr>

                            </thead>



                            <tbody>


                                <?php

                                while (
                                    $appointment =
                                    mysqli_fetch_assoc($result)
                                ):

                                ?>


                                    <tr>


                                        <!-- TOKEN -->

                                        <td>

                                            <strong>

                                                <?php

                                                echo htmlspecialchars(

                                                    $appointment[
                                                        "token_number"
                                                    ] ??
                                                    "--"

                                                );

                                                ?>

                                            </strong>

                                        </td>



                                        <!-- PATIENT -->

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



                                        <!-- DOCTOR -->

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

                                            <small>

                                                <?php

                                                echo htmlspecialchars(

                                                    $appointment[
                                                        "specialization"
                                                    ]

                                                );

                                                ?>

                                            </small>

                                        </td>



                                        <!-- DEPARTMENT -->

                                        <td>

                                            <?php

                                            echo htmlspecialchars(

                                                $appointment[
                                                    "department_name"
                                                ]

                                            );

                                            ?>

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

                                            echo

                                            !empty(

                                                $appointment[
                                                    "appointment_time"
                                                ]

                                            )

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



                                        <!-- STATUS -->

                                        <td>

                                            <span
                                                class="status <?php

                                                echo htmlspecialchars(

                                                    $appointment[
                                                        "status"
                                                    ]

                                                );

                                                ?>"
                                            >

                                                <?php

                                                echo htmlspecialchars(

                                                    ucfirst(

                                                        $appointment[
                                                            "status"
                                                        ]

                                                    )

                                                );

                                                ?>

                                            </span>

                                        </td>



                                        <!-- ACTIONS -->

                                        <td>

                                            <div class="action-buttons">


                                                <?php if (
                                                    $appointment[
                                                        "status"
                                                    ] === "scheduled"
                                                ): ?>


                                                    <!-- CONFIRM -->

                                                    <a
                                                        href="manage_appointments.php?action=confirm&id=<?php

                                                        echo
                                                        $appointment[
                                                            "appointment_id"
                                                        ];

                                                        ?>"
                                                        class="action-btn confirm-btn"
                                                    >

                                                        Confirm

                                                    </a>



                                                    <!-- CANCEL -->

                                                    <a
                                                        href="manage_appointments.php?action=cancel&id=<?php

                                                        echo
                                                        $appointment[
                                                            "appointment_id"
                                                        ];

                                                        ?>"
                                                        class="action-btn cancel-btn"
                                                    >

                                                        Cancel

                                                    </a>


                                                <?php elseif (
                                                    $appointment[
                                                        "status"
                                                    ] === "confirmed"
                                                ): ?>


                                                    <!-- COMPLETE -->

                                                    <a
                                                        href="manage_appointments.php?action=complete&id=<?php

                                                        echo
                                                        $appointment[
                                                            "appointment_id"
                                                        ];

                                                        ?>"
                                                        class="action-btn complete-btn"
                                                    >

                                                        Complete

                                                    </a>



                                                    <!-- CANCEL -->

                                                    <a
                                                        href="manage_appointments.php?action=cancel&id=<?php

                                                        echo
                                                        $appointment[
                                                            "appointment_id"
                                                        ];

                                                        ?>"
                                                        class="action-btn cancel-btn"
                                                    >

                                                        Cancel

                                                    </a>


                                                <?php else: ?>


                                                    <span class="no-action">

                                                        No actions

                                                    </span>


                                                <?php endif; ?>


                                            </div>

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


        </div>


    </main>


</div>


</body>

</html>


