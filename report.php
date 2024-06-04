<?php
session_start();
require_once './includes/class-autoloader.inc.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['type'])) {
    echo '<h1>Unauthorized User</h1>';
    header("Location: ./login.php?error=unauthorized");
    exit();
}

// Get the company ID from the session
$companyId = $_SESSION['comp_id'];
$companyName = $_SESSION['comp_name'];

// Fetch the number of subscribers from the database
$subscriber = new Subscriber();
$subscribersCount = count($subscriber->searchSubscribersByCompanyId($companyId, ''));

// Fetch the number of employees from the database
$employee = new Employee();
$employeesCount = count($employee->searchEmployeesByCompanyId($companyId, ''));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Report - Telecom Subscriber Management</title>
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
    <div class="container_view">
        <header>
            <h1>Company Report</h1>
            <h2><?php echo htmlspecialchars($companyName); ?></h2>
        </header>
        <main>
            <div class="report-section">
                <h3>Number of Subscribers: <?php echo htmlspecialchars($subscribersCount); ?></h3>
                <h3>Number of Employees: <?php echo htmlspecialchars($employeesCount); ?></h3>
            </div>
            <div class="navigation">
                <a href="./includes/view_services.php">View Services</a>
                <a href="./includes/view_employee.php">View Employees</a>
                <a href="./includes/view_subscribers.php">View Subscribers</a>
            </div>
        </main>
    </div>
</body>
</html>
