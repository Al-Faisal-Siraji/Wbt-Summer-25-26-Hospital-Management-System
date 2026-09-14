

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <title>Live Queue | MediCare HMS</title>


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
        href="<?= BASE_URL ?>/assets/css/queue.css"
    >

</head>


<body>


<div class="queue-page">


    <!-- HEADER -->

    <header class="queue-header">


        <a
            href="patient.php"
            class="back-btn"
        >
            ← Back to Dashboard
        </a>


        <div class="brand">


            <div class="logo">
                +
            </div>


            <div>

                <h2>
                    MediCare
                </h2>

                <p>
                    Hospital Management System
                </p>

            </div>


        </div>


        <div class="patient-info">


            <div class="avatar">

                <?php

                echo htmlspecialchars(

                    strtoupper(
                        substr($firstName, 0, 1)
                    )

                );

                ?>

            </div>


            <span>

                <?php
                echo htmlspecialchars($firstName);
                ?>

            </span>


        </div>


    </header>


    <!-- MAIN CONTENT -->

    <main class="queue-container">


        <div class="page-heading">


            <p>
                Your Appointment Status
            </p>


            <h1>
                Live Queue
            </h1>


            <span>
                Track your current position in the queue.
            </span>


        </div>


        <?php if ($appointment !== null): ?>


            <section class="queue-card">


                <div class="live-status">

                    <span class="live-dot"></span>

                    LIVE QUEUE

                </div>


                <!-- TOKEN NUMBER -->

                <div class="queue-number">

                    <?php

                    echo !empty($appointment["token_number"])

                        ? htmlspecialchars(
                            $appointment["token_number"]
                        )

                        : "--";

                    ?>

                </div>


                <p class="queue-label">
                    Your Token Number
                </p>


                <!-- PATIENTS AHEAD -->

                <div class="position-box">


                    <h2>

                        <?php
                        echo htmlspecialchars($patientsAhead);
                        ?>

                    </h2>


                    <p>
                        Patient<?php
                        echo $patientsAhead != 1 ? "s" : "";
                        ?>
                        Ahead of You
                    </p>


                </div>


                <!-- APPOINTMENT DETAILS -->

                <div class="queue-details">


                    <!-- Doctor -->

                    <div class="detail-item">

                        <span>
                            Doctor
                        </span>


                        <strong>

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

                        </strong>

                    </div>


                    <!-- Department -->

                    <div class="detail-item">

                        <span>
                            Department
                        </span>


                        <strong>

                            <?php

                            echo htmlspecialchars(
                                $appointment[
                                    "department_name"
                                ]
                            );

                            ?>

                        </strong>

                    </div>


                    <!-- Date -->

                    <div class="detail-item">

                        <span>
                            Appointment Date
                        </span>


                        <strong>

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

                        </strong>

                    </div>


                    <!-- Time -->

                    <div class="detail-item">

                        <span>
                            Appointment Time
                        </span>


                        <strong>

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

                        </strong>

                    </div>


                    <!-- Specialization -->

                    <div class="detail-item">

                        <span>
                            Specialization
                        </span>


                        <strong>

                            <?php

                            echo htmlspecialchars(
                                $appointment[
                                    "specialization"
                                ]
                            );

                            ?>

                        </strong>

                    </div>


                    <!-- Status -->

                    <div class="detail-item">

                        <span>
                            Appointment Status
                        </span>


                        <strong>

                            <?php

                            echo htmlspecialchars(

                                ucfirst(
                                    $appointment[
                                        "status"
                                    ]
                                )

                            );

                            ?>

                        </strong>

                    </div>


                </div>


            </section>


        <?php else: ?>


            <!-- NO ACTIVE APPOINTMENT -->

            <section class="empty-queue">


                <div class="empty-icon">
                    ⏱
                </div>


                <h2>
                    No Active Queue
                </h2>


                <p>

                    You currently don't have an
                    active appointment.

                </p>


                <a
                    href="doctors.php"
                    class="book-btn"
                >

                    Find a Doctor

                </a>


            </section>


        <?php endif; ?>


    </main>


</div>


</body>

</html>


