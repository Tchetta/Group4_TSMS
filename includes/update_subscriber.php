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
if (!isset($_SESSION['type'])) {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

$subscriber = new Subscriber();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sub_id = $_POST['sub_id'];
    $phone_number = $_POST['phone_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $subscriber->updateSubscriber($sub_id, $phone_number, $first_name, $last_name, $dob, $gender, $address);
    header("Location: ./view_subscriber.php");
    exit();
}

// Get subscriber details
$sub_id = $_GET['sub_id'];
$subscriberData = $subscriber->getSubscriberById($sub_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Subscriber</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/css.css">
</head>
<body>
    <div class="container_update container-in">
        <header>
            <h1>Update Subscriber</h1>
        </header>
        <main>
        <form action="update_subscriber.php" method="post">
    <input type="hidden" name="sub_id" value="<?php echo htmlspecialchars($subscriberData['sub_id']); ?>">
    <div class="form-group">
        <label for="pn">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo htmlspecialchars($subscriberData['phone_number']); ?>" required>
    </div>
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($subscriberData['first_name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($subscriberData['last_name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo htmlspecialchars($subscriberData['dob']); ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="Male" <?php if ($subscriberData['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($subscriberData['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($subscriberData['address']); ?>" required>
    </div>
    <button type="submit" class="btn">Update Subscriber</button>
</form>

        </main>
    </div>
</body>
</html>
