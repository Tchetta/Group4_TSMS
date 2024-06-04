<?php
session_start();
require_once './class-autoloader.inc.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['type'])) {
    echo '<br>oooh = '.$_SESSION['type']. 'Unauthorized User';
    header("Location: ../login.php?error=unauthorized");
    exit();
}

// Get the company ID from the session
$companyId = $_SESSION['comp_id'];
echo 'Company no '.$companyId;

// Fetch services from the database
$service = new Service();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$services = $service->getServicesByCompanyId($companyId, $search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services - Telecom Subscriber Management</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
    <div class="container_view">
        <header>
            <h1 class="white">Services of the Company</h1>
            <div class="search-bar">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input type="text" name="search" placeholder="Search services..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Service Name</th>
                        <th>Service Description</th>
                        <th>Daily Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['service_id']); ?></td>
                            <td><?php echo htmlspecialchars($service['service_name']); ?></td>
                            <td><?php echo htmlspecialchars($service['service_description']); ?></td>
                            <td><?php echo htmlspecialchars($service['daily_cost']); ?></td>
                            <td><?php echo htmlspecialchars($service['status']); ?></td>
                            <td class="actions">
                                    <button class="btn-update" onclick="window.location.href='./update_service.php?id=<?php echo $service['service_id']; ?>'">Update</button>
                                    <button class="btn-delete" onclick="window.location.href='./delete_service.php?id=<?php echo $service['service_id']; ?>'">Delete</button> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
