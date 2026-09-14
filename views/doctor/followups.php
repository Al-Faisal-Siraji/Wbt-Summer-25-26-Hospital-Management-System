

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Follow Up - MediCare</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 270px;
            height: 100vh;

            background: #ffffff;

            border-right: 1px solid #e5e7eb;

            padding: 25px 18px;

            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;

            color: #2563eb;

            margin-bottom: 35px;

            padding-left: 12px;
        }

        .logo span {
            color: #111827;
        }

        .nav-title {
            font-size: 12px;
            font-weight: bold;

            color: #9ca3af;

            margin: 20px 12px 10px;

            text-transform: uppercase;
        }

        .nav-item {
            display: flex;
            align-items: center;

            gap: 12px;

            padding: 13px 14px;

            margin-bottom: 6px;

            text-decoration: none;

            color: #4b5563;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 500;

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
            color: #dc2626;
        }

        .logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 270px;

            padding: 35px 40px;

            min-height: 100vh;
        }

        /* =========================
           HEADER
        ========================= */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 28px;

            color: #111827;
        }

        .page-header p {
            margin-top: 6px;

            color: #6b7280;

            font-size: 14px;
        }

        .add-btn {
            background: #2563eb;

            color: white;

            border: none;

            padding: 11px 18px;

            border-radius: 7px;

            cursor: pointer;

            font-size: 14px;

            font-weight: 600;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        /* =========================
           STATS
        ========================= */

        .stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 25px;
        }

        .stat-card {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 10px;

            padding: 20px;
        }

        .stat-card h3 {
            font-size: 13px;

            color: #6b7280;

            margin-bottom: 10px;
        }

        .number {
            font-size: 27px;

            font-weight: bold;

            color: #111827;
        }

        /* =========================
           TABLE
        ========================= */

        .section {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            overflow: hidden;
        }

        .section-header {
            padding: 20px 22px;

            border-bottom: 1px solid #e5e7eb;
        }

        .section-header h2 {
            font-size: 18px;

            color: #111827;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th {
            background: #f9fafb;

            color: #6b7280;

            font-size: 12px;

            text-transform: uppercase;

            padding: 14px 16px;

            text-align: left;

            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 15px 16px;

            border-bottom: 1px solid #f0f0f0;

            font-size: 14px;

            color: #374151;

            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .patient-name {
            font-weight: 600;

            color: #111827;
        }

        .email {
            color: #6b7280;

            font-size: 12px;

            margin-top: 3px;
        }

        .notes {
            max-width: 280px;

            line-height: 1.5;

            color: #4b5563;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;

            text-transform: capitalize;
        }

        .status.pending {
            background: #fef3c7;

            color: #92400e;
        }

        .status.completed {
            background: #dcfce7;

            color: #166534;
        }

        .status.cancelled {
            background: #fee2e2;

            color: #991b1b;
        }

        /* =========================
           ACTIONS
        ========================= */

        .actions {
            display: flex;

            gap: 7px;

            align-items: center;
        }

        .action-btn {
            border: none;

            border-radius: 6px;

            padding: 7px 10px;

            font-size: 12px;

            cursor: pointer;

            font-weight: 600;
        }

        .complete-btn {
            background: #dcfce7;

            color: #166534;
        }

        .cancel-btn {
            background: #fee2e2;

            color: #991b1b;
        }

        .delete-btn {
            background: #f3f4f6;

            color: #374151;
        }

        .action-btn:hover {
            opacity: 0.8;
        }

        /* =========================
           MODAL
        ========================= */

        .modal {
            display: none;

            position: fixed;

            z-index: 2000;

            left: 0;
            top: 0;

            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.45);

            justify-content: center;

            align-items: center;
        }

        .modal-content {
            background: white;

            width: 500px;

            max-width: 90%;

            border-radius: 12px;

            padding: 25px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .modal-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 22px;
        }

        .modal-header h2 {
            font-size: 20px;

            color: #111827;
        }

        .close {
            font-size: 25px;

            color: #6b7280;

            cursor: pointer;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 7px;

            color: #374151;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;

            padding: 11px 12px;

            border: 1px solid #d1d5db;

            border-radius: 7px;

            outline: none;

            font-family: Arial, sans-serif;

            font-size: 14px;
        }

        .form-group textarea {
            min-height: 100px;

            resize: vertical;
        }

        .form-group select:focus,
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
        }

        .submit-btn {
            width: 100%;

            padding: 12px;

            background: #2563eb;

            color: white;

            border: none;

            border-radius: 7px;

            cursor: pointer;

            font-weight: bold;

            font-size: 14px;
        }

        .submit-btn:hover {
            background: #1d4ed8;
        }

        .empty {
            padding: 45px;

            text-align: center;

            color: #6b7280;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;

                padding: 25px;
            }

            .page-header {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

<!-- =========================
     SIDEBAR
========================= -->

<div class="sidebar">

    <div class="logo">
        Medi<span>Care</span>
    </div>

    <div class="nav-title">
        Doctor Menu
    </div>

    <a href="doctor.php" class="nav-item">
        🏠 Dashboard
    </a>

    <a href="doctor_queue.php" class="nav-item">
        ⏱ Live Queue
    </a>

    <a href="doctor_appointments.php" class="nav-item">
        📅 Appointments
    </a>

    <a href="doctor_patients.php" class="nav-item">
        👥 Patients
    </a>

    <a href="doctor_followups.php" class="nav-item active">
        🔄 Follow Up
    </a>

    <div class="nav-title">
        Account
    </div>

    <a href="logout.php" class="nav-item logout">
        🚪 Logout
    </a>

</div>


<!-- =========================
     MAIN CONTENT
========================= -->

<div class="main">

    <?php if ($followup_message !== ''): ?>
        <div style="margin-bottom: 18px; padding: 12px 16px; border-radius: 8px; background: #dbeafe; color: #1e40af;">
            <?php echo htmlspecialchars($followup_message); ?>
        </div>
    <?php endif; ?>

    <div class="page-header">

        <div>

            <h1>Follow Up Management</h1>

            <p>
                Manage patient follow-up appointments and notes.
            </p>

        </div>

        <button
            class="add-btn"
            onclick="openModal()">

            + Add Follow Up

        </button>

    </div>


    <!-- =========================
         STATISTICS
    ========================= -->

    <div class="stats">

        <div class="stat-card">

            <h3>Total Follow Ups</h3>

            <div class="number">
                <?php echo $total_followups; ?>
            </div>

        </div>

        <div class="stat-card">

            <h3>Pending</h3>

            <div class="number">
                <?php echo $pending_followups; ?>
            </div>

        </div>

        <div class="stat-card">

            <h3>Completed</h3>

            <div class="number">
                <?php echo $completed_followups; ?>
            </div>

        </div>

        <div class="stat-card">

            <h3>Cancelled</h3>

            <div class="number">
                <?php echo $cancelled_followups; ?>
            </div>

        </div>

    </div>


    <!-- =========================
         FOLLOW UP TABLE
    ========================= -->

    <div class="section">

        <div class="section-header">

            <h2>
                Follow Up Records
            </h2>

        </div>

        <div class="table-container">

            <?php if (count($followups) > 0): ?>

                <table>

                    <thead>

                        <tr>

                            <th>Patient</th>

                            <th>Follow Up Date</th>

                            <th>Previous Token</th>

                            <th>Notes</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($followups as $followup): ?>

                            <tr>

                                <td>

                                    <div class="patient-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $followup['first_name']
                                            . " "
                                            . $followup['last_name']
                                        );
                                        ?>

                                    </div>

                                    <div class="email">

                                        <?php
                                        echo htmlspecialchars(
                                            $followup['email']
                                        );
                                        ?>

                                    </div>

                                </td>


                                <td>

                                    <?php
                                    echo date(
                                        "d M Y",
                                        strtotime(
                                            $followup['followup_date']
                                        )
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    if (
                                        !empty(
                                            $followup['token_number']
                                        )
                                    ) {

                                        echo "#"
                                            . htmlspecialchars(
                                                $followup['token_number']
                                            );

                                    } else {

                                        echo "N/A";

                                    }
                                    ?>

                                </td>


                                <td>

                                    <div class="notes">

                                        <?php

                                        if (
                                            !empty(
                                                $followup['notes']
                                            )
                                        ) {

                                            echo nl2br(
                                                htmlspecialchars(
                                                    $followup['notes']
                                                )
                                            );

                                        } else {

                                            echo "No notes added.";

                                        }

                                        ?>

                                    </div>

                                </td>


                                <td>

                                    <span
                                        class="status <?php echo htmlspecialchars($followup['status']); ?>">

                                        <?php
                                        echo ucfirst(
                                            htmlspecialchars(
                                                $followup['status']
                                            )
                                        );
                                        ?>

                                    </span>

                                </td>


                                <td>

                                    <div class="actions">

                                        <?php if ($followup['status'] === 'pending'): ?>

                                            <form method="POST">

                                                <input
                                                    type="hidden"
                                                    name="followup_id"
                                                    value="<?php echo $followup['followup_id']; ?>">

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="completed">

                                                <button
                                                    type="submit"
                                                    name="update_status"
                                                    class="action-btn complete-btn">

                                                    Complete

                                                </button>

                                            </form>


                                            <form method="POST">

                                                <input
                                                    type="hidden"
                                                    name="followup_id"
                                                    value="<?php echo $followup['followup_id']; ?>">

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="cancelled">

                                                <button
                                                    type="submit"
                                                    name="update_status"
                                                    class="action-btn cancel-btn">

                                                    Cancel

                                                </button>

                                            </form>

                                        <?php endif; ?>


                                        <form
                                            method="POST"
                                            onsubmit="return confirm('Delete this follow-up?');">

                                            <input
                                                type="hidden"
                                                name="followup_id"
                                                value="<?php echo $followup['followup_id']; ?>">

                                            <button
                                                type="submit"
                                                name="delete_followup"
                                                class="action-btn delete-btn">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty">

                    No follow-up records found.

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>


<!-- =========================
     ADD FOLLOW-UP MODAL
========================= -->

<div
    class="modal"
    id="followupModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>
                Add Follow Up
            </h2>

            <span
                class="close"
                onclick="closeModal()">

                &times;

            </span>

        </div>


        <form method="POST">

            <div class="form-group">

                <label>
                    Select Patient
                </label>

                <select
                    name="patient_id"
                    required>

                    <option value="">
                        Select a patient
                    </option>

                    <?php foreach ($patients as $patient): ?>

                        <option
                            value="<?php echo $patient['user_id']; ?>">

                            <?php
                            echo htmlspecialchars(
                                $patient['first_name']
                                . " "
                                . $patient['last_name']
                            );
                            ?>

                            -
                            <?php
                            echo htmlspecialchars(
                                $patient['email']
                            );
                            ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Follow Up Date
                </label>

                <input
                    type="date"
                    name="followup_date"
                    min="<?php echo date('Y-m-d'); ?>"
                    required>

            </div>


            <div class="form-group">

                <label>
                    Notes
                </label>

                <textarea
                    name="notes"
                    placeholder="Write follow-up notes..."></textarea>

            </div>


            <button
                type="submit"
                name="add_followup"
                class="submit-btn">

                Save Follow Up

            </button>

        </form>

    </div>

</div>


<script>

    function openModal() {

        document.getElementById("followupModal").style.display = "flex";

    }


    function closeModal() {

        document.getElementById("followupModal").style.display = "none";

    }


    window.onclick = function(event) {

        const modal =
            document.getElementById("followupModal");

        if (event.target === modal) {

            closeModal();

        }

    };

</script>

</body>

</html>
