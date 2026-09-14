

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>My Appointments | MediCare HMS</title>


<!-- Google Font -->

<link rel="preconnect"
      href="https://fonts.googleapis.com">

<link rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin>


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet">


<!-- CSS -->

<link rel="stylesheet"
      href="<?= BASE_URL ?>/assets/css/appointments.css">
```

</head>

<body>

<div class="page-container">

```
<!-- ================= HEADER ================= -->

<header class="top-header">


    <a href="patient.php"
       class="back-btn">

        ← Back to Dashboard

    </a>


    <div class="header-brand">

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


    <div class="user-info">


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


<!-- ================= MAIN ================= -->

<main class="main-content">


    <!-- PAGE HEADING -->

    <div class="page-heading">


        <div>

            <p>
                Patient Portal
            </p>


            <h1>
                My Appointments
            </h1>


            <span>
                View and manage all your appointments.
            </span>


        </div>


        <a href="doctors.php"
           class="book-btn">

            + Book Appointment

        </a>


    </div>


    <!-- ================= APPOINTMENTS ================= -->

    <section class="appointments-section">


        <?php if (mysqli_num_rows($result) > 0): ?>


            <div class="appointment-list">


                <?php while (
                    $appointment = mysqli_fetch_assoc($result)
                ): ?>


                    <div class="appointment-card">


                        <!-- Doctor -->

                        <div class="doctor-section">


                            <div class="doctor-avatar">

                                <?php

                                echo htmlspecialchars(

                                    strtoupper(

                                        substr(
                                            $appointment[
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

                                <h2>

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

                                </h2>


                                <p>

                                    <?php

                                    echo htmlspecialchars(
                                        $appointment[
                                            "specialization"
                                        ]
                                    );

                                    ?>

                                </p>


                            </div>


                        </div>


                        <!-- Appointment Information -->

                        <div class="appointment-info">


                            <div class="info-item">

                                <span>
                                    📅 Date
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


                            <div class="info-item">

                                <span>
                                    🏥 Department
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


                            <!-- Appointment Time -->

                            <div class="info-item">

                                <span>
                                    🕒 Time
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

                                        echo "Not assigned";

                                    }

                                    ?>

                                </strong>

                            </div>


                            <!-- Token Number -->

                            <div class="info-item">

                                <span>
                                    🎫 Token
                                </span>


                                <strong>

                                    <?php

                                    if (
                                        !empty(
                                            $appointment[
                                                "token_number"
                                            ]
                                        )
                                    ) {

                                        echo htmlspecialchars(
                                            $appointment[
                                                "token_number"
                                            ]
                                        );

                                    } else {

                                        echo "Not assigned";

                                    }

                                    ?>

                                </strong>

                            </div>


                        </div>


                        <!-- STATUS -->

                        <div class="appointment-status">


                            <span
                                class="status
                                <?php
                                echo htmlspecialchars(
                                    $appointment["status"]
                                );
                                ?>"
                            >

                                <?php

                                echo htmlspecialchars(

                                    ucfirst(
                                        $appointment["status"]
                                    )

                                );

                                ?>

                            </span>


                        </div>


                    </div>


                <?php endwhile; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->

            <div class="empty-state">


                <div class="empty-icon">

                    📅

                </div>


                <h2>
                    No Appointments Found
                </h2>


                <p>

                    You haven't booked any appointments yet.

                </p>


                <a href="doctors.php"
                   class="book-btn">

                    Find a Doctor

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>
```

</div>

</body>

</html>


