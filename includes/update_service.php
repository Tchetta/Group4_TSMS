<?php
session_start();
/* include "./random.php"; */
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

$service = new Service();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $daily_cost = $_POST['daily_cost'];
    $status = $_POST['status'];

    $service->updateService($service_id, $service_name, $service_description, $daily_cost, $status);
    header("Location: ./view_services.php");
    exit();
}

// Get service details
$service_id = $_GET['id'];
$serviceData = $service->getServiceById($service_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/css.css">
</head>
<body>
    <div class="container_update container">
        <header>
            <h1>Update Service</h1>
        </header>
        <main>
        <form action="update_service.php" method="post">
    <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($serviceData['service_id']); ?>">
    <div class="form-group">
        <label for="service_name">Service Name:</label>
        <input type="text" name="service_name" value="<?php echo htmlspecialchars($serviceData['service_name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="service_description">Service Description:</label>
        <input type="text" name="service_description" value="<?php echo htmlspecialchars($serviceData['service_description']); ?>" required>
    </div>
    <div class="form-group">
        <label for="daily_cost">Daily Cost:</label>
        <input type="text" name="daily_cost" value="<?php echo htmlspecialchars($serviceData['daily_cost']); ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo htmlspecialchars($serviceData['status']); ?>" required>
    </div>
    <button type="submit" class="btn">Update Service</button>
</form>

        </main>
    </div>
</body>
</html>
