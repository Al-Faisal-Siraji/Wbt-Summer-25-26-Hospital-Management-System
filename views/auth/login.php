


<!DOCTYPE html>

<html lang="en">

<head>


    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <title>MediCare HMS | Login</title>


    <!-- ================= GOOGLE FONT ================= -->

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


    <!-- ================= CSS ================= -->

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/login.css"
    >


</head>


<body>


<div class="auth-container">


    <!-- =====================================================
         LEFT SIDE
         ===================================================== -->

    <div class="auth-left">


        <!-- ================= BRAND ================= -->

        <div class="brand">


            <div class="logo">

                +

            </div>


            <span>

                MediCare

            </span>


        </div>


        <!-- ================= WELCOME ================= -->

        <div class="welcome-content">


            <span class="welcome-badge">

                Hospital Management System

            </span>


            <h1>

                Your Health,<br>

                Our Priority.

            </h1>


            <p>

                Manage appointments, track your queue,

                and connect with healthcare professionals

                in one secure platform.

            </p>


            <!-- ================= FEATURES ================= -->

            <div class="features">


                <!-- FEATURE 1 -->

                <div class="feature">


                    <div class="feature-icon">

                        ✓

                    </div>


                    <div>

                        <h3>

                            Easy Appointment Management

                        </h3>


                        <p>

                            Schedule and manage your appointments easily.

                        </p>

                    </div>


                </div>


                <!-- FEATURE 2 -->

                <div class="feature">


                    <div class="feature-icon">

                        ✓

                    </div>


                    <div>

                        <h3>

                            Live Queue Tracking

                        </h3>


                        <p>

                            Track your position in the hospital queue.

                        </p>

                    </div>


                </div>


                <!-- FEATURE 3 -->

                <div class="feature">


                    <div class="feature-icon">

                        ✓

                    </div>


                    <div>

                        <h3>

                            Secure Healthcare System

                        </h3>


                        <p>

                            Your information is protected securely.

                        </p>

                    </div>


                </div>


            </div>


        </div>


        <!-- ================= FOOTER ================= -->

        <div class="left-footer">

            © 2026 MediCare HMS. All rights reserved.BY Siraji Enterprise

        </div>


    </div>



    <!-- =====================================================
         RIGHT SIDE
         ===================================================== -->

    <div class="auth-right">


        <div class="form-container">


            <!-- ================= MOBILE BRAND ================= -->

            <div class="mobile-brand">


                <div class="logo">

                    +

                </div>


                <span>

                    MediCare

                </span>


            </div>


            <!-- ================= FORM HEADER ================= -->

            <div class="form-header">


                <h2>

                    Welcome Back!

                </h2>


                <p>

                    Sign in to continue to your account.

                </p>


            </div>


            <!-- ================= ERROR MESSAGE ================= -->

            <?php if ($message !== ""): ?>


                <div class="message">

                    <?php

                    echo htmlspecialchars($message);

                    ?>

                </div>


            <?php endif; ?>


            <!-- =================================================
                 LOGIN FORM
                 ================================================= -->

            <form
                id="loginForm"
                method="POST"
                action=""
            >


                <!-- ================= EMAIL ================= -->

                <div class="input-group">


                    <label for="email">

                        Email Address

                    </label>


                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        value="<?php
                            echo htmlspecialchars(
                                $_POST["email"] ?? ""
                            );
                        ?>"
                        required
                    >


                </div>


                <!-- ================= PASSWORD ================= -->

                <div class="input-group">


                    <label for="password">

                        Password

                    </label>


                    <div class="password-wrapper">


                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword()"
                        >

                            👁

                        </button>


                    </div>


                </div>


                <!-- ================= OPTIONS ================= -->

                <div class="form-options">


                    <label class="remember">


                        <input
                            type="checkbox"
                            name="remember"
                        >


                        <span>

                            Remember me

                        </span>


                    </label>


                    <a
                        href="#"
                        class="forgot-password"
                    >

                        Forgot Password?

                    </a>


                </div>


                <!-- ================= LOGIN BUTTON ================= -->

                <button
                    type="submit"
                    class="login-btn"
                >

                    Sign In

                </button>


            </form>


            <!-- =================================================
                 SIGNUP
                 ================================================= -->

            <p class="signup-text">


                Don't have an account?


                <a href="signup.php">

                    Create Account

                </a>


            </p>


        </div>


    </div>


</div>


<!-- =========================================================
     JAVASCRIPT
     ========================================================= -->

<script src="<?= BASE_URL ?>/assets/js/auth.js"></script>


</body>

</html>
```
