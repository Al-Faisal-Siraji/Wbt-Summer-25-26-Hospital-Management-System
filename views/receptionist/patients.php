

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Patients | MediCare HMS</title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
    >

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    >

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

                        echo htmlspecialchars($firstName);

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
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ⌂
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>


                <!-- APPOINTMENTS -->

                <a
                    href="manage_appointments.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        📅
                    </span>

                    <span>
                        Appointments
                    </span>

                </a>


                <!-- PATIENTS -->

                <a
                    href="receptionist_patients.php"
                    class="nav-item active"
                >

                    <span class="nav-icon">
                        👤
                    </span>

                    <span>
                        Patients
                    </span>

                </a>


                <!-- LIVE QUEUE -->

                <a
                    href="receptionist_queue.php"
                    class="nav-item"
                >

                    <span class="nav-icon">
                        ⏱
                    </span>

                    <span>
                        Live Queue
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


    <!-- ===============================
         MAIN CONTENT
    ================================ -->

    <main class="main-content">


        <!-- HEADER -->

        <header class="top-header">

            <div class="page-title">

                <p>
                    Reception Portal
                </p>

                <h1>
                    Patients
                </h1>

            </div>


            <div class="header-profile">

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
             PAGE CONTENT
        ================================ -->

        <section class="dashboard-content">


            <!-- WELCOME -->

            <div class="welcome-section">

                <div>

                    <p>
                        MediCare Hospital
                    </p>

                    <h2>
                        Patient Directory 👥
                    </h2>

                    <span>
                        View and manage registered patients.
                    </span>

                </div>

            </div>


            <!-- ===============================
                 STATISTICS
            ================================ -->

            <div class="stats-grid">

                <div class="stat-card">

                    <div class="stat-icon">
                        👤
                    </div>

                    <div>

                        <p>
                            Total Patients
                        </p>

                        <h3>
                            <?php echo $totalPatients; ?>
                        </h3>

                    </div>

                </div>

            </div>


            <!-- ===============================
                 PATIENT TABLE
            ================================ -->

            <section
                class="appointments-section"
                id="patients"
            >

                <div class="section-header">

                    <div>

                        <h2>
                            Registered Patients
                        </h2>

                        <p>
                            All patients registered in the system
                        </p>

                    </div>

                </div>


                <?php

                if (
                    $patientResult &&
                    mysqli_num_rows($patientResult) > 0
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
                                        Email
                                    </th>

                                    <th>
                                        Appointments
                                    </th>

                                    <th>
                                        Registered
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                            <?php

                            while (
                                $patient =
                                mysqli_fetch_assoc($patientResult)
                            ):

                            ?>

                                <tr>

                                    <!-- PATIENT -->

                                    <td>

                                        <?php

                                        echo htmlspecialchars(
                                            $patient["first_name"]
                                        );

                                        ?>

                                        <?php

                                        echo htmlspecialchars(
                                            $patient["last_name"]
                                        );

                                        ?>

                                    </td>


                                    <!-- EMAIL -->

                                    <td>

                                        <?php

                                        echo htmlspecialchars(
                                            $patient["email"]
                                        );

                                        ?>

                                    </td>


                                    <!-- APPOINTMENTS -->

                                    <td>

                                        <?php

                                        echo htmlspecialchars(
                                            $patient["total_appointments"]
                                        );

                                        ?>

                                    </td>


                                    <!-- REGISTERED -->

                                    <td>

                                        <?php

                                        if (
                                            !empty(
                                                $patient["created_at"]
                                            )
                                        ) {

                                            echo date(
                                                "d M Y",
                                                strtotime(
                                                    $patient["created_at"]
                                                )
                                            );

                                        } else {

                                            echo "--";

                                        }

                                        ?>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <span class="status confirmed">
                                            Active
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
                            👤
                        </div>

                        <h3>
                            No Patients Found
                        </h3>

                        <p>
                            There are currently no registered patients.
                        </p>

                    </div>

                <?php endif; ?>

            </section>

        </section>

    </main>

</div>


</body>

</html>

