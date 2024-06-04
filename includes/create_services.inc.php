<?php
session_start();
require_once './class-autoloader.inc.php';

// Check if user is logged in and has appropriate permissions
if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    header("Location: login.php;notadmin");
    exit();
}



// Instantiate Admin class
$admin = new Admin($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['username'], $_SESSION['dob'], $_SESSION['email'], 'c', $_SESSION['gender'], $_SESSION['address'], $_SESSION['country']);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceName = $_POST['service_name'];
    $serviceDescription = $_POST['service_description'];
    $dailyCost = $_POST['daily_cost'];
    $status = $_POST['status'];

    // Add service
    $admin->addService($serviceName, $serviceDescription, $dailyCost, $status, $_SESSION['comp_id']);

    // Redirect to admin home or display success message
    header("Location: ../admin_home.php?msg=success");
    exit();
}
