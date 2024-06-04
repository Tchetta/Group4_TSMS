<?php
session_start();
$path = './class-autoloader.inc.php';
if (file_exists($path)) {
    require_once './class-autoloader.inc.php';    
}
else {
    require_once './includes/class-autoloader.inc.php';
}

// Check if user is logged in and is an admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

if (isset($_GET['service_id'])) {
    $service = new Service();
    $service_id = $_GET['id'];
    $service->deleteService($service_id);
    header("Location: ./view_service.php");
    exit();
}
?>
