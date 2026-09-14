

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Department Management</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        /* =====================================================
           DASHBOARD CONTAINER
           ===================================================== */

        .dashboard-container {
            min-height: 100vh;
        }

        /* =====================================================
           SIDEBAR
           ===================================================== */

        .sidebar {
            width: 270px;
            height: 100vh;
            min-height: 100vh;

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
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;

            padding: 10px 12px 30px;
        }

        .logo span {
            color: #111827;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;

            align-items: center;

            text-decoration: none;

            color: #4b5563;

            font-size: 15px;
            font-weight: 600;

            padding: 14px 16px;

            border-radius: 10px;

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

        .nav-icon {
            width: 28px;
            font-size: 18px;
        }

        .logout {
            margin-top: 25px;
            color: #dc2626;
        }

        .logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* =====================================================
           MAIN CONTENT
           ===================================================== */

        .main-content {
            margin-left: 270px;

            width: calc(100% - 270px);

            min-height: 100vh;

            padding: 35px 40px;
        }

        /* =====================================================
           HEADER
           ===================================================== */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;

            font-size: 28px;

            color: #111827;
        }

        .page-header p {
            margin: 7px 0 0;

            color: #6b7280;

            font-size: 14px;
        }

        .admin-name {
            background: white;

            padding: 12px 18px;

            border-radius: 10px;

            border: 1px solid #e5e7eb;

            font-weight: 600;
        }

        /* =====================================================
           MESSAGE
           ===================================================== */

        .message {
            padding: 14px 18px;

            border-radius: 10px;

            margin-bottom: 25px;

            font-size: 14px;

            font-weight: 600;
        }

        .message.success {
            background: #dcfce7;
            color: #166534;

            border: 1px solid #bbf7d0;
        }

        .message.error {
            background: #fee2e2;
            color: #991b1b;

            border: 1px solid #fecaca;
        }

        /* =====================================================
           TOP SECTION
           ===================================================== */

        .section-top {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }

        .section-top h2 {
            margin: 0;

            font-size: 20px;

            color: #111827;
        }

        .add-btn {
            border: none;

            background: #2563eb;

            color: white;

            padding: 12px 20px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        /* =====================================================
           TABLE
           ===================================================== */

        .table-card {
            background: white;

            border-radius: 12px;

            border: 1px solid #e5e7eb;

            overflow: hidden;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th {
            background: #f8fafc;

            color: #374151;

            font-size: 13px;

            text-align: left;

            padding: 16px;

            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px;

            border-bottom: 1px solid #f0f2f5;

            font-size: 14px;

            color: #4b5563;

            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafcff;
        }

        .department-name {
            font-weight: bold;

            color: #111827;
        }

        .doctor-count {
            display: inline-block;

            background: #eff6ff;

            color: #2563eb;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }

        .description {
            max-width: 350px;
        }

        /* =====================================================
           ACTION BUTTONS
           ===================================================== */

        .action-buttons {
            display: flex;

            gap: 8px;

            flex-wrap: wrap;
        }

        .action-btn {
            border: none;

            padding: 8px 12px;

            border-radius: 7px;

            cursor: pointer;

            font-size: 12px;

            font-weight: bold;

            text-decoration: none;

            display: inline-block;
        }

        .edit-btn {
            background: #eff6ff;

            color: #2563eb;
        }

        .edit-btn:hover {
            background: #dbeafe;
        }

        .delete-btn {
            background: #fef2f2;

            color: #dc2626;
        }

        .delete-btn:hover {
            background: #fee2e2;
        }

        /* =====================================================
           EMPTY
           ===================================================== */

        .empty-message {
            text-align: center;

            padding: 50px;

            color: #6b7280;
        }

        /* =====================================================
           MODAL
           ===================================================== */

        .modal {
            display: none;

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.45);

            align-items: center;

            justify-content: center;

            z-index: 2000;
        }

        .modal-content {
            background: white;

            width: 500px;

            max-width: 90%;

            border-radius: 14px;

            padding: 30px;

            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;
        }

        .modal-header h2 {
            margin: 0;

            font-size: 21px;

            color: #111827;
        }

        .close {
            font-size: 28px;

            color: #6b7280;

            cursor: pointer;

            line-height: 1;
        }

        .close:hover {
            color: #111827;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            font-size: 13px;

            font-weight: bold;

            color: #374151;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;

            padding: 12px 13px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            font-size: 14px;

            outline: none;

            font-family: inherit;
        }

        .form-group textarea {
            min-height: 100px;

            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
        }

        .modal-buttons {
            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 25px;
        }

        .cancel-btn {
            border: 1px solid #d1d5db;

            background: white;

            color: #4b5563;

            padding: 11px 18px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: bold;
        }

        .save-btn {
            border: none;

            background: #2563eb;

            color: white;

            padding: 11px 18px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: bold;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        /* =====================================================
           RESPONSIVE
           ===================================================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;

                width: calc(100% - 220px);

                padding: 25px;
            }

            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 850px;
            }
        }

        @media (max-width: 650px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;

                min-height: auto;
            }

            .main-content {
                margin-left: 0;

                width: 100%;
            }

            .page-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .section-top {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }
        }

    </style>

</head>

<body>

<div class="dashboard-container">

    <!-- =====================================================
         SIDEBAR
         ===================================================== -->

    <aside class="sidebar">

        <div class="logo">
            MediCare <span>HMS</span>
        </div>

        <nav class="nav-menu">

            <a href="admin.php" class="nav-item">
                <span class="nav-icon">🏠</span>
                Dashboard
            </a>

            <a href="admin_doctors.php" class="nav-item">
                <span class="nav-icon">👨‍⚕️</span>
                Doctors
            </a>

            <a href="admin_departments.php" class="nav-item active">
                <span class="nav-icon">🏢</span>
                Departments
            </a>

            <a href="admin_resources.php" class="nav-item">
                <span class="nav-icon">🏥</span>
                Resources
            </a>

            <a href="admin_performance.php" class="nav-item">
                <span class="nav-icon">📊</span>
                Performance
            </a>

            <a href="logout.php" class="nav-item logout">
                <span class="nav-icon">🚪</span>
                Logout
            </a>

        </nav>

    </aside>


    <!-- =====================================================
         MAIN CONTENT
         ===================================================== -->

    <main class="main-content">

        <div class="page-header">

            <div>

                <h1>Department Management</h1>

                <p>
                    Manage hospital departments and their information.
                </p>

            </div>

            <div class="admin-name">
                👤 <?php echo htmlspecialchars($firstName); ?>
            </div>

        </div>


        <!-- =================================================
             MESSAGE
             ================================================= -->

        <?php if (isset($_SESSION["message"])): ?>

            <div class="message <?php echo $_SESSION["message_type"]; ?>">

                <?php
                    echo htmlspecialchars($_SESSION["message"]);

                    unset($_SESSION["message"]);
                    unset($_SESSION["message_type"]);
                ?>

            </div>

        <?php endif; ?>


        <!-- =================================================
             SECTION HEADER
             ================================================= -->

        <div class="section-top">

            <h2>All Departments</h2>

            <button
                class="add-btn"
                onclick="openAddModal()"
            >
                + Add Department
            </button>

        </div>


        <!-- =================================================
             DEPARTMENT TABLE
             ================================================= -->

        <div class="table-card">

            <?php if ($departments && mysqli_num_rows($departments) > 0): ?>

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Department</th>

                            <th>Description</th>

                            <th>Doctors</th>

                            <th>Created</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while ($department = mysqli_fetch_assoc($departments)): ?>

                        <tr>

                            <td>
                                <?php echo $department["department_id"]; ?>
                            </td>

                            <td>

                                <div class="department-name">

                                    <?php
                                    echo htmlspecialchars(
                                        $department["department_name"]
                                    );
                                    ?>

                                </div>

                            </td>

                            <td>

                                <div class="description">

                                    <?php

                                    if (
                                        !empty(
                                            $department["description"]
                                        )
                                    ) {

                                        echo htmlspecialchars(
                                            $department["description"]
                                        );

                                    } else {

                                        echo "No description";
                                    }

                                    ?>

                                </div>

                            </td>

                            <td>

                                <span class="doctor-count">

                                    <?php
                                    echo $department["doctor_count"];
                                    ?>

                                    Doctor<?php
                                    echo $department["doctor_count"] == 1
                                        ? ""
                                        : "s";
                                    ?>

                                </span>

                            </td>

                            <td>

                                <?php
                                echo date(
                                    "d M Y",
                                    strtotime(
                                        $department["created_at"]
                                    )
                                );
                                ?>

                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button
                                        class="action-btn edit-btn"
                                        onclick='openEditModal(
                                            <?php echo json_encode($department); ?>
                                        )'
                                    >
                                        Edit
                                    </button>


                                    <?php if ($department["doctor_count"] == 0): ?>

                                        <a
                                            href="admin_departments.php?delete=<?php echo $department["department_id"]; ?>"
                                            class="action-btn delete-btn"
                                            onclick="return confirm(
                                                'Are you sure you want to delete this department?'
                                            );"
                                        >
                                            Delete
                                        </a>

                                    <?php else: ?>

                                        <button
                                            class="action-btn delete-btn"
                                            onclick="alert(
                                                'This department cannot be deleted because doctors are assigned to it.'
                                            );"
                                        >
                                            Delete
                                        </button>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty-message">

                    No departments found.

                </div>

            <?php endif; ?>

        </div>

    </main>

</div>


<!-- =========================================================
     ADD DEPARTMENT MODAL
     ========================================================= -->

<div id="addModal" class="modal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Add Department</h2>

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
                    Department Name
                </label>

                <input
                    type="text"
                    name="department_name"
                    placeholder="e.g. Cardiology"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Description
                </label>

                <textarea
                    name="description"
                    placeholder="Enter department description"
                ></textarea>

            </div>


            <div class="modal-buttons">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeAddModal()"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    name="add_department"
                    class="save-btn"
                >
                    Add Department
                </button>

            </div>

        </form>

    </div>

</div>


<!-- =========================================================
     EDIT DEPARTMENT MODAL
     ========================================================= -->

<div id="editModal" class="modal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Edit Department</h2>

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
                name="department_id"
                id="edit_department_id"
            >


            <div class="form-group">

                <label>
                    Department Name
                </label>

                <input
                    type="text"
                    name="department_name"
                    id="edit_department_name"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Description
                </label>

                <textarea
                    name="description"
                    id="edit_description"
                ></textarea>

            </div>


            <div class="modal-buttons">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeEditModal()"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    name="edit_department"
                    class="save-btn"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


<script>

/* =========================================================
   ADD MODAL
   ========================================================= */

function openAddModal() {

    document.getElementById("addModal").style.display = "flex";

}

function closeAddModal() {

    document.getElementById("addModal").style.display = "none";

}


/* =========================================================
   EDIT MODAL
   ========================================================= */

function openEditModal(department) {

    document.getElementById("edit_department_id").value =
        department.department_id;

    document.getElementById("edit_department_name").value =
        department.department_name;

    document.getElementById("edit_description").value =
        department.description || "";

    document.getElementById("editModal").style.display = "flex";

}

function closeEditModal() {

    document.getElementById("editModal").style.display = "none";

}


/* =========================================================
   CLOSE MODAL WHEN CLICKING OUTSIDE
   ========================================================= */

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