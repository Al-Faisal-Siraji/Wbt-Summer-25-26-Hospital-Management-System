

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hospital Resources</title>


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
           STATISTICS
           ===================================================== */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

            margin-bottom: 30px;
        }


        .stat-card {

            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 22px;
        }


        .stat-title {

            font-size: 13px;

            color: #6b7280;

            margin-bottom: 8px;

            font-weight: 600;
        }


        .stat-value {

            font-size: 28px;

            font-weight: bold;

            color: #111827;
        }


        /* =====================================================
           SECTION TOP
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


        .resource-name {

            font-weight: bold;

            color: #111827;
        }


        .resource-type {

            display: inline-block;

            background: #eff6ff;

            color: #2563eb;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }


        .quantity {

            font-weight: bold;

            color: #111827;
        }


        /* =====================================================
           AVAILABILITY
           ===================================================== */

        .availability {

            font-weight: bold;
        }


        .available {

            color: #16a34a;
        }


        .low-stock {

            color: #d97706;
        }


        .out-of-stock {

            color: #dc2626;
        }


        .stock-bar {

            width: 120px;

            height: 7px;

            background: #e5e7eb;

            border-radius: 10px;

            overflow: hidden;

            margin-top: 6px;
        }


        .stock-progress {

            height: 100%;

            border-radius: 10px;

            background: #2563eb;
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
           DESCRIPTION
           ===================================================== */

        .description {

            max-width: 250px;

            line-height: 1.4;
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

            width: 520px;

            max-width: 90%;

            max-height: 90vh;

            overflow-y: auto;

            border-radius: 14px;

            padding: 30px;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.2);
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


        /* =====================================================
           FORM
           ===================================================== */

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

        .form-group select,

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

            min-height: 90px;

            resize: vertical;
        }


        .form-group input:focus,

        .form-group select:focus,

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

        @media (max-width: 1000px) {

            .stats-grid {

                grid-template-columns:
                    1fr 1fr;
            }

            .table-card {

                overflow-x: auto;
            }

            table {

                min-width: 1000px;
            }
        }


        @media (max-width: 700px) {

            .sidebar {

                position: relative;

                width: 100%;

                height: auto;

                min-height: auto;
            }


            .main-content {

                margin-left: 0;

                width: 100%;

                padding: 25px;
            }


            .stats-grid {

                grid-template-columns: 1fr;
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


            <a
                href="admin.php"
                class="nav-item"
            >

                <span class="nav-icon">🏠</span>

                Dashboard

            </a>


            <a
                href="admin_doctors.php"
                class="nav-item"
            >

                <span class="nav-icon">👨‍⚕️</span>

                Doctors

            </a>


            <a
                href="admin_departments.php"
                class="nav-item"
            >

                <span class="nav-icon">🏢</span>

                Departments

            </a>


            <a
                href="admin_resources.php"
                class="nav-item active"
            >

                <span class="nav-icon">🏥</span>

                Resources

            </a>


            <a
                href="admin_performance.php"
                class="nav-item"
            >

                <span class="nav-icon">📊</span>

                Performance

            </a>


            <a
                href="logout.php"
                class="nav-item logout"
            >

                <span class="nav-icon">🚪</span>

                Logout

            </a>


        </nav>

    </aside>



    <!-- =====================================================
         MAIN CONTENT
         ===================================================== -->

    <main class="main-content">


        <!-- HEADER -->

        <div class="page-header">

            <div>

                <h1>
                    Hospital Resources
                </h1>

                <p>
                    Manage hospital beds, equipment and other resources.
                </p>

            </div>


            <div class="admin-name">

                👤
                <?php
                echo htmlspecialchars($firstName);
                ?>

            </div>

        </div>



        <!-- =================================================
             MESSAGE
             ================================================= -->

        <?php if (isset($_SESSION["message"])): ?>

            <div
                class="message
                <?php
                echo $_SESSION["message_type"];
                ?>"
            >

                <?php

                echo htmlspecialchars(
                    $_SESSION["message"]
                );

                unset($_SESSION["message"]);

                unset($_SESSION["message_type"]);

                ?>

            </div>

        <?php endif; ?>



        <!-- =================================================
             STATISTICS
             ================================================= -->

        <div class="stats-grid">


            <div class="stat-card">

                <div class="stat-title">
                    Resource Types
                </div>

                <div class="stat-value">

                    <?php
                    echo $totalResources;
                    ?>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Total Quantity
                </div>

                <div class="stat-value">

                    <?php
                    echo $totalQuantity;
                    ?>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Available Quantity
                </div>

                <div class="stat-value">

                    <?php
                    echo $totalAvailable;
                    ?>

                </div>

            </div>


        </div>



        <!-- =================================================
             SECTION HEADER
             ================================================= -->

        <div class="section-top">

            <h2>
                All Resources
            </h2>


            <button
                class="add-btn"
                onclick="openAddModal()"
            >

                + Add Resource

            </button>

        </div>



        <!-- =================================================
             RESOURCE TABLE
             ================================================= -->

        <div class="table-card">


            <?php if ($resources && mysqli_num_rows($resources) > 0): ?>


                <table>


                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Resource
                            </th>

                            <th>
                                Type
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Available
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php while ($resource = mysqli_fetch_assoc($resources)): ?>


                        <?php

                        $quantity =
                            intval($resource["quantity"]);

                        $available =
                            intval(
                                $resource["available_quantity"]
                            );


                        $percentage = 0;

                        if ($quantity > 0) {

                            $percentage =
                                ($available / $quantity) * 100;
                        }


                        if ($available == 0) {

                            $stockClass =
                                "out-of-stock";

                            $stockText =
                                "Out of Stock";

                        } elseif ($percentage <= 25) {

                            $stockClass =
                                "low-stock";

                            $stockText =
                                "Low Stock";

                        } else {

                            $stockClass =
                                "available";

                            $stockText =
                                "Available";
                        }

                        ?>


                        <tr>


                            <td>

                                <?php
                                echo $resource["resource_id"];
                                ?>

                            </td>


                            <td>

                                <div class="resource-name">

                                    <?php
                                    echo htmlspecialchars(
                                        $resource["resource_name"]
                                    );
                                    ?>

                                </div>

                            </td>


                            <td>

                                <span class="resource-type">

                                    <?php
                                    echo htmlspecialchars(
                                        $resource["resource_type"]
                                    );
                                    ?>

                                </span>

                            </td>


                            <td>

                                <span class="quantity">

                                    <?php
                                    echo $quantity;
                                    ?>

                                </span>

                            </td>


                            <td>

                                <div
                                    class="availability
                                    <?php
                                    echo $stockClass;
                                    ?>"
                                >

                                    <?php
                                    echo $available;
                                    ?>

                                    —
                                    <?php
                                    echo $stockText;
                                    ?>

                                </div>


                                <div class="stock-bar">

                                    <div
                                        class="stock-progress"
                                        style="
                                            width:
                                            <?php
                                            echo min(
                                                100,
                                                $percentage
                                            );
                                            ?>%;
                                        "
                                    ></div>

                                </div>

                            </td>


                            <td>

                                <div class="description">

                                    <?php

                                    if (
                                        !empty(
                                            $resource["description"]
                                        )
                                    ) {

                                        echo htmlspecialchars(
                                            $resource["description"]
                                        );

                                    } else {

                                        echo "No description";
                                    }

                                    ?>

                                </div>

                            </td>


                            <td>

                                <div class="action-buttons">


                                    <button
                                        class="action-btn edit-btn"
                                        onclick='openEditModal(
                                            <?php
                                            echo json_encode($resource);
                                            ?>
                                        )'
                                    >

                                        Edit

                                    </button>


                                    <a
                                        href="
                                        admin_resources.php?delete=
                                        <?php
                                        echo $resource["resource_id"];
                                        ?>"
                                        class="action-btn delete-btn"
                                        onclick="
                                            return confirm(
                                                'Are you sure you want to delete this resource?'
                                            );
                                        "
                                    >

                                        Delete

                                    </a>


                                </div>

                            </td>


                        </tr>


                    <?php endwhile; ?>


                    </tbody>

                </table>


            <?php else: ?>


                <div class="empty-message">

                    No resources found.

                </div>


            <?php endif; ?>


        </div>


    </main>

</div>



<!-- =========================================================
     ADD RESOURCE MODAL
     ========================================================= -->

<div
    id="addModal"
    class="modal"
>


    <div class="modal-content">


        <div class="modal-header">

            <h2>
                Add Resource
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
                    Resource Name
                </label>

                <input
                    type="text"
                    name="resource_name"
                    placeholder="e.g. Hospital Beds"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Resource Type
                </label>

                <select
                    name="resource_type"
                    required
                >

                    <option value="">
                        Select Type
                    </option>

                    <option value="Bed">
                        Bed
                    </option>

                    <option value="Equipment">
                        Equipment
                    </option>

                    <option value="Medicine">
                        Medicine
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Total Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    min="0"
                    value="0"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Available Quantity
                </label>

                <input
                    type="number"
                    name="available_quantity"
                    min="0"
                    value="0"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Description
                </label>

                <textarea
                    name="description"
                    placeholder="Enter resource description"
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
                    name="add_resource"
                    class="save-btn"
                >

                    Add Resource

                </button>


            </div>


        </form>

    </div>

</div>



<!-- =========================================================
     EDIT RESOURCE MODAL
     ========================================================= -->

<div
    id="editModal"
    class="modal"
>


    <div class="modal-content">


        <div class="modal-header">

            <h2>
                Edit Resource
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
                name="resource_id"
                id="edit_resource_id"
            >


            <div class="form-group">

                <label>
                    Resource Name
                </label>

                <input
                    type="text"
                    name="resource_name"
                    id="edit_resource_name"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Resource Type
                </label>

                <select
                    name="resource_type"
                    id="edit_resource_type"
                    required
                >

                    <option value="Bed">
                        Bed
                    </option>

                    <option value="Equipment">
                        Equipment
                    </option>

                    <option value="Medicine">
                        Medicine
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Total Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    id="edit_quantity"
                    min="0"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Available Quantity
                </label>

                <input
                    type="number"
                    name="available_quantity"
                    id="edit_available_quantity"
                    min="0"
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
                    name="edit_resource"
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

function openEditModal(resource) {

    document.getElementById("edit_resource_id").value =
        resource.resource_id;

    document.getElementById("edit_resource_name").value =
        resource.resource_name;

    document.getElementById("edit_resource_type").value =
        resource.resource_type;

    document.getElementById("edit_quantity").value =
        resource.quantity;

    document.getElementById("edit_available_quantity").value =
        resource.available_quantity;

    document.getElementById("edit_description").value =
        resource.description || "";

    document.getElementById("editModal").style.display = "flex";

}


function closeEditModal() {

    document.getElementById("editModal").style.display = "none";

}


/* =========================================================
   CLOSE MODAL OUTSIDE CLICK
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