

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Doctor Management - Admin</title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: Arial, Helvetica, sans-serif;

            background: #f5f7fb;

            color: #1f2937;
        }


        /* =================================================
           DASHBOARD
           ================================================= */

        .dashboard-container {
            display: flex;

            min-height: 100vh;
        }


        /* =================================================
           SIDEBAR
           ================================================= */

        .sidebar {
            width: 270px;

            height: 100vh;

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            background: #ffffff;

            border-right: 1px solid #e5e7eb;

            padding: 25px 18px;

            overflow-y: auto;

            z-index: 1000;
        }


        .logo {
            font-size: 25px;

            font-weight: bold;

            color: #2563eb;

            padding: 5px 12px 30px;
        }


        .admin-label {
            font-size: 13px;

            color: #6b7280;

            padding: 0 12px 20px;
        }


        .nav-menu {
            display: flex;

            flex-direction: column;

            gap: 8px;
        }


        .nav-item {
            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px 15px;

            text-decoration: none;

            color: #4b5563;

            border-radius: 10px;

            font-size: 15px;

            transition: 0.2s;
        }


        .nav-item:hover {
            background: #eff6ff;

            color: #2563eb;
        }


        .nav-item.active {
            background: #2563eb;

            color: white;
        }


        .logout {
            margin-top: 20px;

            color: #dc2626;
        }


        .logout:hover {
            background: #fef2f2;

            color: #dc2626;
        }


        /* =================================================
           MAIN CONTENT
           ================================================= */

        .main-content {
            margin-left: 270px;

            width: calc(100% - 270px);

            min-height: 100vh;

            padding: 35px;
        }


        /* =================================================
           PAGE HEADER
           ================================================= */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }


        .page-header h1 {
            font-size: 28px;

            color: #111827;
        }


        .page-header p {
            margin-top: 6px;

            color: #6b7280;
        }


        .add-btn {
            background: #2563eb;

            color: white;

            border: none;

            padding: 12px 20px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 14px;

            font-weight: bold;
        }


        .add-btn:hover {
            background: #1d4ed8;
        }


        /* =================================================
           MESSAGE
           ================================================= */

        .message {
            padding: 13px 16px;

            border-radius: 8px;

            margin-bottom: 20px;

            font-size: 14px;
        }


        .success {
            background: #dcfce7;

            color: #166534;
        }


        .error {
            background: #fee2e2;

            color: #991b1b;
        }


        /* =================================================
           TABLE CARD
           ================================================= */

        .card {
            background: white;

            border-radius: 12px;

            padding: 25px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.05);

            overflow-x: auto;
        }


        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 850px;
        }


        th {
            text-align: left;

            padding: 15px;

            background: #f8fafc;

            color: #475569;

            font-size: 13px;

            border-bottom: 1px solid #e5e7eb;
        }


        td {
            padding: 15px;

            border-bottom: 1px solid #eef0f4;

            font-size: 14px;
        }


        tr:hover {
            background: #fafcff;
        }


        .doctor-name {
            font-weight: bold;

            color: #111827;
        }


        .doctor-email {
            font-size: 12px;

            color: #6b7280;

            margin-top: 3px;
        }


        /* =================================================
           STATUS
           ================================================= */

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }


        .available {
            background: #dcfce7;

            color: #166534;
        }


        .unavailable {
            background: #fee2e2;

            color: #991b1b;
        }


        /* =================================================
           ACTION BUTTONS
           ================================================= */

        .actions {
            display: flex;

            gap: 7px;

            flex-wrap: wrap;
        }


        .action-btn {
            border: none;

            text-decoration: none;

            padding: 7px 11px;

            border-radius: 6px;

            font-size: 12px;

            font-weight: bold;

            display: inline-block;

            cursor: pointer;
        }


        .edit-btn {
            background: #dbeafe;

            color: #1d4ed8;
        }


        .toggle-btn {
            background: #fef3c7;

            color: #92400e;
        }


        .delete-btn {
            background: #fee2e2;

            color: #b91c1c;
        }


        /* =================================================
           MODAL
           ================================================= */

        .modal {
            display: none;

            position: fixed;

            z-index: 2000;

            left: 0;
            top: 0;

            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.45);

            align-items: center;

            justify-content: center;
        }


        .modal-content {
            background: white;

            width: 500px;

            max-width: 92%;

            max-height: 90vh;

            overflow-y: auto;

            border-radius: 12px;

            padding: 30px;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, 0.2);
        }


        .modal-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;
        }


        .modal-header h2 {
            font-size: 21px;
        }


        .close {
            font-size: 26px;

            color: #6b7280;

            cursor: pointer;
        }


        .form-group {
            margin-bottom: 17px;
        }


        .form-group label {
            display: block;

            margin-bottom: 7px;

            font-size: 14px;

            font-weight: bold;

            color: #374151;
        }


        .form-group input,
        .form-group select {
            width: 100%;

            padding: 11px 12px;

            border: 1px solid #d1d5db;

            border-radius: 7px;

            font-size: 14px;

            outline: none;
        }


        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
        }


        .submit-btn {
            width: 100%;

            padding: 12px;

            border: none;

            background: #2563eb;

            color: white;

            border-radius: 7px;

            cursor: pointer;

            font-weight: bold;

            margin-top: 5px;
        }


        .submit-btn:hover {
            background: #1d4ed8;
        }


        /* =================================================
           RESPONSIVE
           ================================================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }


            .main-content {
                margin-left: 220px;

                width: calc(100% - 220px);

                padding: 20px;
            }

        }

    </style>

</head>


<body>


<div class="dashboard-container">


    <!-- =================================================
         SIDEBAR
         ================================================= -->

    <aside class="sidebar">


        <div class="logo">
            MediCare
        </div>


        <div class="admin-label">
            Administrator
        </div>


        <nav class="nav-menu">


            <a
                href="admin.php"
                class="nav-item"
            >
                🏠 Dashboard
            </a>


            <a
                href="admin_doctors.php"
                class="nav-item active"
            >
                👨‍⚕️ Doctors
            </a>


            <a
                href="admin_departments.php"
                class="nav-item"
            >
                🏥 Departments
            </a>


            <a
                href="admin_resources.php"
                class="nav-item"
            >
                🛏️ Resources
            </a>


            <a
                href="admin_performance.php"
                class="nav-item"
            >
                📊 Performance
            </a>


            <a
                href="logout.php"
                class="nav-item logout"
            >
                🚪 Logout
            </a>


        </nav>


    </aside>


    <!-- =================================================
         MAIN CONTENT
         ================================================= -->

    <main class="main-content">


        <div class="page-header">


            <div>

                <h1>
                    Doctor Management
                </h1>

                <p>
                    Manage doctors, departments, fees and availability.
                </p>

            </div>


            <button
                class="add-btn"
                onclick="openAddModal()"
            >
                + Add Doctor
            </button>


        </div>


        <!-- =================================================
             MESSAGES
             ================================================= -->

        <?php if (isset($_GET["message"])): ?>


            <?php if ($_GET["message"] === "added"): ?>

                <div class="message success">
                    Doctor added successfully.
                </div>


            <?php elseif ($_GET["message"] === "updated"): ?>

                <div class="message success">
                    Doctor information updated successfully.
                </div>


            <?php elseif ($_GET["message"] === "deleted"): ?>

                <div class="message success">
                    Doctor deleted successfully.
                </div>


            <?php elseif ($_GET["message"] === "status"): ?>

                <div class="message success">
                    Doctor availability updated successfully.
                </div>


            <?php elseif ($_GET["message"] === "exists"): ?>

                <div class="message error">
                    This user is already registered as a doctor.
                </div>


            <?php elseif ($_GET["message"] === "invalid_user"): ?>

                <div class="message error">
                    Selected user is not a doctor account.
                </div>


            <?php endif; ?>


        <?php endif; ?>


        <!-- =================================================
             DOCTOR TABLE
             ================================================= -->

        <div class="card">


            <table>


                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Doctor
                        </th>

                        <th>
                            Specialization
                        </th>

                        <th>
                            Department
                        </th>

                        <th>
                            Consultation Fee
                        </th>

                        <th>
                            Availability
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php if (
                    $doctors
                    && mysqli_num_rows($doctors) > 0
                ): ?>


                    <?php while (
                        $doctor = mysqli_fetch_assoc($doctors)
                    ): ?>


                        <tr>


                            <td>

                                #<?php
                                echo $doctor["doctor_id"];
                                ?>

                            </td>


                            <td>


                                <div class="doctor-name">

                                    Dr.
                                    <?php

                                    echo htmlspecialchars(
                                        $doctor["first_name"]
                                        . " "
                                        . $doctor["last_name"]
                                    );

                                    ?>

                                </div>


                                <div class="doctor-email">

                                    <?php

                                    echo htmlspecialchars(
                                        $doctor["email"]
                                    );

                                    ?>

                                </div>


                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $doctor["specialization"]
                                );

                                ?>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $doctor["department_name"]
                                );

                                ?>

                            </td>


                            <td>

                                ৳<?php

                                echo number_format(
                                    $doctor["consultation_fee"],
                                    2
                                );

                                ?>

                            </td>


                            <td>


                                <?php if (
                                    $doctor["availability_status"]
                                    === "available"
                                ): ?>


                                    <span
                                        class="status available"
                                    >
                                        Available
                                    </span>


                                <?php else: ?>


                                    <span
                                        class="status unavailable"
                                    >
                                        Unavailable
                                    </span>


                                <?php endif; ?>


                            </td>


                            <td>


                                <div class="actions">


                                    <button
                                        class="action-btn edit-btn"
                                        onclick='openEditModal(
                                            <?php
                                            echo htmlspecialchars(
                                                json_encode($doctor),
                                                ENT_QUOTES,
                                                "UTF-8"
                                            );
                                            ?>
                                        )'
                                    >
                                        Edit
                                    </button>


                                    <a
                                        href="admin_doctors.php?toggle=<?php
                                        echo $doctor["doctor_id"];
                                        ?>"
                                        class="action-btn toggle-btn"
                                    >
                                        Toggle
                                    </a>


                                    <a
                                        href="admin_doctors.php?delete=<?php
                                        echo $doctor["doctor_id"];
                                        ?>"
                                        class="action-btn delete-btn"
                                        onclick="return confirm(
                                            'Are you sure you want to delete this doctor?'
                                        );"
                                    >
                                        Delete
                                    </a>


                                </div>


                            </td>


                        </tr>


                    <?php endwhile; ?>


                <?php else: ?>


                    <tr>

                        <td
                            colspan="7"
                            style="
                                text-align:center;
                                padding:35px;
                            "
                        >

                            No doctors found.

                        </td>

                    </tr>


                <?php endif; ?>


                </tbody>


            </table>


        </div>


    </main>


</div>


<!-- =====================================================
     ADD DOCTOR MODAL
     ===================================================== -->

<div
    class="modal"
    id="addModal"
>


    <div class="modal-content">


        <div class="modal-header">


            <h2>
                Add New Doctor
            </h2>


            <span
                class="close"
                onclick="closeAddModal()"
            >
                &times;
            </span>


        </div>


        <form method="POST">


            <div class="form-group">


                <label>
                    Doctor User Account
                </label>


                <select
                    name="user_id"
                    required
                >


                    <option value="">
                        Select Doctor
                    </option>


                    <?php if ($doctorUsers): ?>


                        <?php while (
                            $user =
                            mysqli_fetch_assoc($doctorUsers)
                        ): ?>


                            <option
                                value="<?php
                                echo $user["user_id"];
                                ?>"
                            >

                                <?php

                                echo htmlspecialchars(
                                    $user["first_name"]
                                    . " "
                                    . $user["last_name"]
                                );

                                ?>

                                -

                                <?php

                                echo htmlspecialchars(
                                    $user["email"]
                                );

                                ?>

                            </option>


                        <?php endwhile; ?>


                    <?php endif; ?>


                </select>


            </div>


            <div class="form-group">


                <label>
                    Department
                </label>


                <select
                    name="department_id"
                    required
                >


                    <option value="">
                        Select Department
                    </option>


                    <?php if ($departments): ?>


                        <?php while (
                            $department =
                            mysqli_fetch_assoc($departments)
                        ): ?>


                            <option
                                value="<?php
                                echo $department["department_id"];
                                ?>"
                            >

                                <?php

                                echo htmlspecialchars(
                                    $department["department_name"]
                                );

                                ?>

                            </option>


                        <?php endwhile; ?>


                    <?php endif; ?>


                </select>


            </div>


            <div class="form-group">


                <label>
                    Specialization
                </label>


                <input
                    type="text"
                    name="specialization"
                    placeholder="e.g. Cardiologist"
                    required
                >


            </div>


            <div class="form-group">


                <label>
                    Consultation Fee
                </label>


                <input
                    type="number"
                    name="consultation_fee"
                    placeholder="e.g. 1500"
                    min="0"
                    step="0.01"
                    required
                >


            </div>


            <div class="form-group">


                <label>
                    Availability
                </label>


                <select
                    name="availability_status"
                    required
                >

                    <option value="available">
                        Available
                    </option>

                    <option value="unavailable">
                        Unavailable
                    </option>

                </select>


            </div>


            <input
                type="hidden"
                name="add_doctor"
                value="1"
            >


            <button
                type="submit"
                class="submit-btn"
            >
                Add Doctor
            </button>


        </form>


    </div>


</div>


<!-- =====================================================
     EDIT DOCTOR MODAL
     ===================================================== -->

<div
    class="modal"
    id="editModal"
>


    <div class="modal-content">


        <div class="modal-header">


            <h2>
                Edit Doctor
            </h2>


            <span
                class="close"
                onclick="closeEditModal()"
            >
                &times;
            </span>


        </div>


        <form method="POST">


            <input
                type="hidden"
                name="doctor_id"
                id="edit_doctor_id"
            >


            <div class="form-group">


                <label>
                    Doctor
                </label>


                <input
                    type="text"
                    id="edit_doctor_name"
                    readonly
                >


            </div>


            <div class="form-group">


                <label>
                    Department
                </label>


                <select
                    name="department_id"
                    id="edit_department"
                    required
                >


                    <?php while (
                        $department =
                        mysqli_fetch_assoc($editDepartments)
                    ): ?>


                        <option
                            value="<?php
                            echo $department["department_id"];
                            ?>"
                        >

                            <?php

                            echo htmlspecialchars(
                                $department["department_name"]
                            );

                            ?>

                        </option>


                    <?php endwhile; ?>


                </select>


            </div>


            <div class="form-group">


                <label>
                    Specialization
                </label>


                <input
                    type="text"
                    name="specialization"
                    id="edit_specialization"
                    required
                >


            </div>


            <div class="form-group">


                <label>
                    Consultation Fee
                </label>


                <input
                    type="number"
                    name="consultation_fee"
                    id="edit_fee"
                    min="0"
                    step="0.01"
                    required
                >


            </div>


            <div class="form-group">


                <label>
                    Availability
                </label>


                <select
                    name="availability_status"
                    id="edit_availability"
                    required
                >

                    <option value="available">
                        Available
                    </option>

                    <option value="unavailable">
                        Unavailable
                    </option>

                </select>


            </div>


            <input
                type="hidden"
                name="edit_doctor"
                value="1"
            >


            <button
                type="submit"
                class="submit-btn"
            >
                Save Changes
            </button>


        </form>


    </div>


</div>


<script>

/* =====================================================
   ADD MODAL
   ===================================================== */

function openAddModal() {

    document.getElementById("addModal").style.display = "flex";

}


function closeAddModal() {

    document.getElementById("addModal").style.display = "none";

}


/* =====================================================
   EDIT MODAL
   ===================================================== */

function openEditModal(doctor) {

    document.getElementById("edit_doctor_id").value =
        doctor.doctor_id;


    document.getElementById("edit_doctor_name").value =
        "Dr. " +
        doctor.first_name +
        " " +
        doctor.last_name;


    document.getElementById("edit_department").value =
        doctor.department_id;


    document.getElementById("edit_specialization").value =
        doctor.specialization;


    document.getElementById("edit_fee").value =
        doctor.consultation_fee;


    document.getElementById("edit_availability").value =
        doctor.availability_status;


    document.getElementById("editModal").style.display =
        "flex";
}


function closeEditModal() {

    document.getElementById("editModal").style.display =
        "none";

}


/* =====================================================
   CLOSE MODAL WHEN CLICKING OUTSIDE
   ===================================================== */

window.onclick = function(event) {

    const addModal =
        document.getElementById("addModal");

    const editModal =
        document.getElementById("editModal");


    if (event.target === addModal) {

        closeAddModal();

    }


    if (event.target === editModal) {

        closeEditModal();

    }

};

</script>


</body>

</html>
```
