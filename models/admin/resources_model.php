<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: router.php?page=login");
    exit();
}

require_once BASE_PATH . "/views/partials/database.php";

$firstName = $_SESSION["first_name"];


/* =========================================================
   DELETE RESOURCE
   ========================================================= */

if (isset($_GET["delete"])) {

    $resource_id = intval($_GET["delete"]);

    $delete = mysqli_prepare($conn, 
        "DELETE FROM resources WHERE resource_id = ?"
    );

    mysqli_stmt_bind_param($delete, "i", $resource_id);

    if (mysqli_stmt_execute($delete)) {
        $_SESSION["message"] = "Resource deleted successfully.";
        $_SESSION["message_type"] = "success";
    } else {
        $_SESSION["message"] = "Failed to delete resource.";
        $_SESSION["message_type"] = "error";
    }

    mysqli_stmt_close($delete);

    header("Location: admin_resources.php");
    exit();
}


/* =========================================================
   ADD RESOURCE
   ========================================================= */

if (isset($_POST["add_resource"])) {

    $resource_name = trim($_POST["resource_name"]);
    $resource_type = trim($_POST["resource_type"]);
    $quantity = intval($_POST["quantity"]);
    $available_quantity = intval($_POST["available_quantity"]);
    $description = trim($_POST["description"]);


    if ($resource_name === "" || $resource_type === "") {

        $_SESSION["message"] = "Resource name and type are required.";
        $_SESSION["message_type"] = "error";

    } elseif ($quantity < 0 || $available_quantity < 0) {

        $_SESSION["message"] = "Quantity cannot be negative.";
        $_SESSION["message_type"] = "error";

    } elseif ($available_quantity > $quantity) {

        $_SESSION["message"] =
            "Available quantity cannot be greater than total quantity.";

        $_SESSION["message_type"] = "error";

    } else {

        $insert = mysqli_prepare($conn, 
            "INSERT INTO resources
            (resource_name, resource_type, quantity, available_quantity, description)
            VALUES (?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param($insert, 
            "ssiis",
            $resource_name,
            $resource_type,
            $quantity,
            $available_quantity,
            $description
        );

        if (mysqli_stmt_execute($insert)) {

            $_SESSION["message"] =
                "Resource added successfully.";

            $_SESSION["message_type"] = "success";

        } else {

            $_SESSION["message"] =
                "Failed to add resource.";

            $_SESSION["message_type"] = "error";
        }

        mysqli_stmt_close($insert);
    }

    header("Location: admin_resources.php");
    exit();
}


/* =========================================================
   EDIT RESOURCE
   ========================================================= */

if (isset($_POST["edit_resource"])) {

    $resource_id = intval($_POST["resource_id"]);
    $resource_name = trim($_POST["resource_name"]);
    $resource_type = trim($_POST["resource_type"]);
    $quantity = intval($_POST["quantity"]);
    $available_quantity = intval($_POST["available_quantity"]);
    $description = trim($_POST["description"]);


    if ($resource_name === "" || $resource_type === "") {

        $_SESSION["message"] =
            "Resource name and type are required.";

        $_SESSION["message_type"] = "error";

    } elseif ($quantity < 0 || $available_quantity < 0) {

        $_SESSION["message"] =
            "Quantity cannot be negative.";

        $_SESSION["message_type"] = "error";

    } elseif ($available_quantity > $quantity) {

        $_SESSION["message"] =
            "Available quantity cannot be greater than total quantity.";

        $_SESSION["message_type"] = "error";

    } else {

        $update = mysqli_prepare($conn, 
            "UPDATE resources
             SET resource_name = ?,
                 resource_type = ?,
                 quantity = ?,
                 available_quantity = ?,
                 description = ?
             WHERE resource_id = ?"
        );

        mysqli_stmt_bind_param($update, 
            "ssiisi",
            $resource_name,
            $resource_type,
            $quantity,
            $available_quantity,
            $description,
            $resource_id
        );

        if (mysqli_stmt_execute($update)) {

            $_SESSION["message"] =
                "Resource updated successfully.";

            $_SESSION["message_type"] = "success";

        } else {

            $_SESSION["message"] =
                "Failed to update resource.";

            $_SESSION["message_type"] = "error";
        }

        mysqli_stmt_close($update);
    }

    header("Location: admin_resources.php");
    exit();
}


/* =========================================================
   GET RESOURCES
   ========================================================= */

$resources = mysqli_query($conn, 
    "SELECT *
     FROM resources
     ORDER BY resource_type, resource_name"
);


/* =========================================================
   RESOURCE STATISTICS
   ========================================================= */

$totalResources = 0;
$totalQuantity = 0;
$totalAvailable = 0;

$statsResult = mysqli_query($conn, 
    "SELECT
        COUNT(*) AS total_resources,
        COALESCE(SUM(quantity), 0) AS total_quantity,
        COALESCE(SUM(available_quantity), 0) AS total_available
     FROM resources"
);

if ($statsResult) {

    $stats = mysqli_fetch_assoc($statsResult);

    $totalResources = $stats["total_resources"];
    $totalQuantity = $stats["total_quantity"];
    $totalAvailable = $stats["total_available"];
}

?>