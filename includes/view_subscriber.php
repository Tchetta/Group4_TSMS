<?php
session_start();
require_once './class-autoloader.inc.php';

// Check if user is logged in and is an employee
if (!isset($_SESSION['type'])) {
    echo '<br>oooh = '.$_SESSION['type']. '<h1>Unauthorised User</h1>';
    header("Location: ../login.php?error=unauthorized");
    exit();
}

// Get the company ID from the session
$companyId = $_SESSION['comp_id'];

// Fetch subscribers from the database
$subscriber = new Subscriber();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$subscribers = $subscriber->searchSubscribersByCompanyId($companyId, $search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Subscribers - Telecom Subscriber Management</title>
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
            <h1 class="white">Subscribers of Company</h1>
            <div class="search-bar">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <input type="text" name="search" placeholder="Search subscribers..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Subscriber ID</th>
                        <th>Phone Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Time Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subscribers as $subscriber) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subscriber['sub_id']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['dob']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['gender']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['address']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['status']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['time_status']); ?></td>
                            <td class="actions">
                                <button class="btn-update" onclick="window.location.href='./update_subscriber.php?sub_id=<?php echo $subscriber['sub_id']; ?>'">Update</button>
                                <button class="btn-delete" onclick="window.location.href='./delete_subscriber.php?sub_id=<?php echo $subscriber['sub_id']; ?>'">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
