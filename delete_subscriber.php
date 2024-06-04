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
    header("Location: login.php?error=unauthorized");
    exit();
}

if (isset($_GET['sub_id'])) {
    $subscriber = new Subscriber();
    $sub_id = $_GET['sub_id'];
    $subscriber->deleteSubscriber($sub_id);
    header("Location: ./includes/view_subscriber.php");
    exit();
}
?>
