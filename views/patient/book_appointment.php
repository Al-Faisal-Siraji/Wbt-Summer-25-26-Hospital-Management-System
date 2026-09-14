

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"

>

<title>Book Appointment | MediCare HMS</title>

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
    href="<?= BASE_URL ?>/assets/css/appointment.css"
>

</head>

<body>

<div class="appointment-page">

<!-- HEADER -->

<header class="top-header">

```
<a
    href="doctors.php"
    class="back-btn"
>

    ← Back to Doctors

</a>


<div class="brand">


    <div class="logo">
        +
    </div>


    <div>

        <h2>MediCare</h2>

        <p>Hospital Management System</p>

    </div>


</div>


<div class="patient-name">

    <?php
    echo htmlspecialchars($firstName);
    ?>

</div>
```

</header>

<!-- MAIN CONTENT -->

<main class="booking-container">

```
<div class="booking-card">


    <div class="booking-header">


        <p>
            Schedule Your Visit
        </p>


        <h1>
            Book Appointment
        </h1>


        <span>
            Select a date to book your appointment.
        </span>


    </div>


    <!-- DOCTOR INFORMATION -->

    <div class="doctor-summary">


        <div class="doctor-avatar">

            <?php

            echo htmlspecialchars(

                strtoupper(

                    substr(
                        $doctor["first_name"],
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
                    $doctor["first_name"]
                );
                ?>


                <?php
                echo htmlspecialchars(
                    $doctor["last_name"]
                );
                ?>


            </h2>


            <p>

                <?php
                echo htmlspecialchars(
                    $doctor["specialization"]
                );
                ?>

            </p>


            <span>

                <?php
                echo htmlspecialchars(
                    $doctor["department_name"]
                );
                ?>

            </span>


        </div>


        <div class="fee">


            <p>
                Consultation Fee
            </p>


            <h3>

                ৳<?php

                echo htmlspecialchars(
                    $doctor["consultation_fee"]
                );

                ?>

            </h3>


        </div>


    </div>


    <!-- MESSAGE -->

    <?php if ($message !== ""): ?>


        <div
            class="message <?php
            echo $messageType;
            ?>"
        >

            <?php
            echo htmlspecialchars($message);
            ?>

        </div>


    <?php endif; ?>


    <!-- BOOKING FORM -->

    <form
        method="POST"
        class="appointment-form"
    >


        <div class="input-group">


            <label for="appointment_date">

                Select Appointment Date

            </label>


            <input
                type="date"
                id="appointment_date"
                name="appointment_date"
                min="<?php echo date("Y-m-d"); ?>"
                required
            >


        </div>


        <div class="appointment-info">


            <h3>
                Appointment Information
            </h3>


            <p>

                Your appointment will initially be
                scheduled for the selected date.

            </p>


            <p>

                <strong>
                    Appointment Time:
                </strong>

                10:00 AM

            </p>


            <p>

                Your token number will be generated
                automatically after booking.

            </p>


        </div>


        <button
            type="submit"
            class="confirm-btn"
        >

            Confirm Appointment

        </button>


    </form>


</div>
```

</main>

</div>

</body>

</html>


