

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Queue Management | MediCare HMS</title>

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
        href="<?= BASE_URL ?>/assets/css/receptionist_queue.css"
    >

</head>

<body>

<div class="queue-layout">


    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-logo">
                +
            </div>

            <div class="brand-text">

                <h2>MediCare</h2>

                <span>
                    Hospital Management
                </span>

            </div>

        </div>


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

            <div class="profile-info">

                <strong>
                    <?php
                    echo htmlspecialchars($firstName);
                    ?>
                </strong>

                <span>
                    Receptionist
                </span>

            </div>

        </div>


        <nav class="navigation">

            <a href="receptionist.php">
                <span class="nav-icon">⌂</span>
                Dashboard
            </a>

            <a href="receptionist.php">
                <span class="nav-icon">▣</span>
                Appointments
            </a>

            <a href="receptionist.php">
                <span class="nav-icon">♙</span>
                Patients
            </a>

            <a
                href="receptionist_queue.php"
                class="active"
            >
                <span class="nav-icon">☷</span>
                Live Queue
            </a>

        </nav>


        <div class="sidebar-bottom">

            <a
                href="logout.php"
                class="logout"
            >
                <span class="nav-icon">↪</span>
                Logout
            </a>

        </div>

    </aside>



    <!-- MAIN CONTENT -->

    <main class="main-content">


        <!-- TOP BAR -->

        <header class="topbar">

            <div>

                <p class="page-label">
                    Reception Desk
                </p>

                <h1>
                    Queue Management
                </h1>

            </div>

            <div class="topbar-date">

                <span>Selected Date</span>

                <strong>
                    <?php
                    echo date(
                        "d M Y",
                        strtotime($selectedDate)
                    );
                    ?>
                </strong>

            </div>

        </header>



        <!-- CONTENT -->

        <div class="content">


            <!-- DATE SELECTOR -->

            <section class="date-section">

                <form method="GET">

                    <div class="date-input">

                        <label for="date">
                            Queue Date
                        </label>

                        <input
                            type="date"
                            id="date"
                            name="date"
                            value="<?php
                            echo htmlspecialchars($selectedDate);
                            ?>"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="view-btn"
                    >
                        View Queue
                    </button>

                </form>

            </section>



            <!-- STATISTICS -->

            <section class="stats-grid">


                <div class="stat-card">

                    <div class="stat-icon">
                        👥
                    </div>

                    <div>

                        <span>
                            Total Patients
                        </span>

                        <strong>
                            <?php
                            echo $totalPatients;
                            ?>
                        </strong>

                    </div>

                </div>



                <div class="stat-card">

                    <div class="stat-icon">
                        ⏳
                    </div>

                    <div>

                        <span>
                            Waiting
                        </span>

                        <strong>
                            <?php
                            echo $waitingPatients;
                            ?>
                        </strong>

                    </div>

                </div>



                <div class="stat-card">

                    <div class="stat-icon">
                        📢
                    </div>

                    <div>

                        <span>
                            Calling
                        </span>

                        <strong>
                            <?php
                            echo $callingPatients;
                            ?>
                        </strong>

                    </div>

                </div>



                <div class="stat-card">

                    <div class="stat-icon">
                        ✓
                    </div>

                    <div>

                        <span>
                            Completed
                        </span>

                        <strong>
                            <?php
                            echo $completedPatients;
                            ?>
                        </strong>

                    </div>

                </div>


            </section>



            <!-- CURRENT PATIENT -->

            <?php if ($currentPatient !== null): ?>

                <section class="current-patient">

                    <div class="current-left">

                        <div class="live-indicator">

                            <span></span>

                            NOW CALLING

                        </div>

                        <h2>
                            Token
                            <?php
                            echo htmlspecialchars(
                                $currentPatient["token_number"]
                            );
                            ?>
                        </h2>

                        <p>

                            <?php
                            echo htmlspecialchars(
                                $currentPatient["patient_first_name"]
                            );

                            echo " ";

                            echo htmlspecialchars(
                                $currentPatient["patient_last_name"]
                            );
                            ?>

                        </p>

                    </div>


                    <div class="current-details">

                        <span>Doctor</span>

                        <strong>

                            Dr.
                            <?php
                            echo htmlspecialchars(
                                $currentPatient["doctor_first_name"]
                            );

                            echo " ";

                            echo htmlspecialchars(
                                $currentPatient["doctor_last_name"]
                            );
                            ?>

                        </strong>

                        <span>Department</span>

                        <strong>

                            <?php
                            echo htmlspecialchars(
                                $currentPatient["department_name"]
                            );
                            ?>

                        </strong>

                    </div>

                </section>

            <?php endif; ?>



            <!-- QUEUE TABLE -->

            <section class="queue-section">

                <div class="section-header">

                    <div>

                        <h2>
                            Patient Queue
                        </h2>

                        <p>
                            Manage today's patient appointments
                        </p>

                    </div>

                    <span class="patient-count">

                        <?php
                        echo $totalPatients;
                        ?>

                        Patients

                    </span>

                </div>



                <?php if ($totalPatients > 0): ?>

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
                                        Time
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                            <?php foreach ($appointments as $appointment): ?>

                                <tr>


                                    <!-- TOKEN -->

                                    <td>

                                        <div class="token">

                                            <?php

                                            if (
                                                $appointment["token_number"]
                                                !== null
                                            ) {

                                                echo htmlspecialchars(
                                                    $appointment["token_number"]
                                                );

                                            } else {

                                                echo "—";

                                            }

                                            ?>

                                        </div>

                                    </td>



                                    <!-- PATIENT -->

                                    <td>

                                        <div class="patient-cell">

                                            <div class="patient-avatar">

                                                <?php

                                                echo htmlspecialchars(
                                                    strtoupper(
                                                        substr(
                                                            $appointment[
                                                                "patient_first_name"
                                                            ],
                                                            0,
                                                            1
                                                        )
                                                    )
                                                );

                                                ?>

                                            </div>

                                            <div>

                                                <strong>

                                                    <?php

                                                    echo htmlspecialchars(
                                                        $appointment[
                                                            "patient_first_name"
                                                        ]
                                                    );

                                                    echo " ";

                                                    echo htmlspecialchars(
                                                        $appointment[
                                                            "patient_last_name"
                                                        ]
                                                    );

                                                    ?>

                                                </strong>

                                            </div>

                                        </div>

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

                                        echo " ";

                                        echo htmlspecialchars(
                                            $appointment[
                                                "doctor_last_name"
                                            ]
                                        );

                                        ?>

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



                                    <!-- TIME -->

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

                                            echo "Not assigned";

                                        }

                                        ?>

                                    </td>



                                    <!-- STATUS -->

                                    <td>

                                        <?php

                                        $status =
                                            $appointment["status"];

                                        ?>

                                        <span
                                            class="status status-<?php
                                            echo htmlspecialchars(
                                                $status
                                            );
                                            ?>"
                                        >

                                            <?php

                                            echo ucwords(
                                                str_replace(
                                                    "_",
                                                    " ",
                                                    $status
                                                )
                                            );

                                            ?>

                                        </span>

                                    </td>



                                    <!-- ACTION -->

                                    <td>

                                        <div class="actions">


                                            <?php if (
                                                $status === "scheduled"
                                            ): ?>

                                                <form method="POST">

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
                                                        name="status"
                                                        value="waiting"
                                                    >

                                                    <button
                                                        class="action-btn waiting-btn"
                                                        type="submit"
                                                    >
                                                        Add to Queue
                                                    </button>

                                                </form>

                                            <?php endif; ?>



                                            <?php if (
                                                $status === "waiting"
                                            ): ?>

                                                <form method="POST">

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
                                                        name="status"
                                                        value="calling"
                                                    >

                                                    <button
                                                        class="action-btn call-btn"
                                                        type="submit"
                                                    >
                                                        Call Patient
                                                    </button>

                                                </form>

                                            <?php endif; ?>



                                            <?php if (
                                                $status === "calling"
                                            ): ?>

                                                <form method="POST">

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
                                                        name="status"
                                                        value="in_consultation"
                                                    >

                                                    <button
                                                        class="action-btn start-btn"
                                                        type="submit"
                                                    >
                                                        Start
                                                    </button>

                                                </form>

                                            <?php endif; ?>



                                            <?php if (
                                                $status === "in_consultation"
                                            ): ?>

                                                <form method="POST">

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
                                                        name="status"
                                                        value="completed"
                                                    >

                                                    <button
                                                        class="action-btn complete-btn"
                                                        type="submit"
                                                    >
                                                        Complete
                                                    </button>

                                                </form>

                                            <?php endif; ?>



                                            <?php if (
                                                $status === "waiting" ||
                                                $status === "calling"
                                            ): ?>

                                                <form method="POST">

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
                                                        name="status"
                                                        value="skipped"
                                                    >

                                                    <button
                                                        class="skip-btn"
                                                        type="submit"
                                                    >
                                                        Skip
                                                    </button>

                                                </form>

                                            <?php endif; ?>


                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="empty-state">

                        <div class="empty-icon">
                            📅
                        </div>

                        <h3>
                            No Appointments
                        </h3>

                        <p>
                            There are no appointments scheduled
                            for this date.
                        </p>

                    </div>

                <?php endif; ?>

            </section>


        </div>

    </main>

</div>

</body>

</html>

