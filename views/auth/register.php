



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

```
<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>MediCare HMS | Create Account</title>

<!-- Google Font -->
<link rel="preconnect"
      href="https://fonts.googleapis.com">

<link rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/signup.css">
```

</head>

<body>

```
<div class="signup-container">

    <!-- LEFT SIDE -->

    <div class="signup-left">

        <div class="brand">

            <div class="logo">+</div>

            <span>MediCare</span>

        </div>


        <div class="signup-info">

            <span class="info-badge">
                Hospital Management System
            </span>

            <h1>
                Better Healthcare<br>
                Starts With You.
            </h1>

            <p>
                Create your account and get access to hospital services,
                appointments, queue tracking, and healthcare information.
            </p>


            <div class="benefits">

                <div class="benefit">

                    <div class="benefit-icon">✓</div>

                    <div>
                        <h3>Easy Appointment Booking</h3>

                        <p>
                            Manage your hospital appointments easily.
                        </p>
                    </div>

                </div>


                <div class="benefit">

                    <div class="benefit-icon">✓</div>

                    <div>
                        <h3>Track Your Queue</h3>

                        <p>
                            See your live queue position anytime.
                        </p>
                    </div>

                </div>


                <div class="benefit">

                    <div class="benefit-icon">✓</div>

                    <div>
                        <h3>Secure and Simple</h3>

                        <p>
                            Your information is kept safe and secure.
                        </p>
                    </div>

                </div>

            </div>

        </div>


        <div class="left-footer">
            © 2026 MediCare HMS. All rights reserved.
        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="signup-right">

        <div class="signup-form-container">


            <!-- Mobile Logo -->

            <div class="mobile-brand">

                <div class="logo">+</div>

                <span>MediCare</span>

            </div>


            <!-- Form Header -->

            <div class="form-header">

                <h2>Create Your Account</h2>

                <p>
                    Fill in your information to get started.
                </p>

            </div>
            <?php if ($message != ""): ?>

<div class="message">
    <?php echo htmlspecialchars($message); ?>
</div>

<?php endif; ?>






            <!-- Signup Form -->

            <form id="signupForm" method="POST" action="">

                <div class="name-row">

                    <!-- First Name -->

                    <div class="input-group">

                        <label for="firstName">
                            First Name
                        </label>

                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            placeholder="First name"
                            required
                        >

                    </div>


                    <!-- Last Name -->

                    <div class="input-group">

                        <label for="lastName">
                            Last Name
                        </label>

                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            placeholder="Last name"
                            required
                        >

                    </div>

                </div>


                <!-- Email -->

                <div class="input-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <!-- Role -->

                <div class="input-group">

                    <label for="role">
                        Select Role
                    </label>

                    <select id="role" name="role" required>

                        <option value="" selected disabled>
                            Select your role
                        </option>

                        <option value="patient">
                            Patient
                        </option>

                        <option value="doctor">
                            Doctor
                        </option>

                        <option value="receptionist">
                            Receptionist
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                    </select>

                </div>


                <!-- Password -->

                <div class="input-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Create a password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('password')"
                        >
                            👁
                        </button>

                    </div>

                </div>


                <!-- Confirm Password -->

                <div class="input-group">

                    <label for="confirmPassword">
                        Confirm Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="confirmPassword"
                            name="confirmPassword"
                            placeholder="Confirm your password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('confirmPassword')"
                        >
                            👁
                        </button>

                    </div>

                </div>


                <!-- Terms -->

                <label class="terms">

                    <input type="checkbox" required>

                    <span>
                        I agree to the
                        <a href="#">Terms and Conditions</a>
                        and
                        <a href="#">Privacy Policy</a>
                    </span>

                </label>


                <!-- Submit Button -->

                <button
                    type="submit"
                    class="signup-btn"
                >
                    Create Account
                </button>
                     </form>

                <!-- Login Link -->

                <p class="login-text">

                    Already have an account?

                    <a href="index.php">
                        Sign In
                    </a>

                </p>

            </form>

        </div>

    </div>

</div>


<script src="<?= BASE_URL ?>/assets/js/signup.js"></script>
```

</body>

</html>
