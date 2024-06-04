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

$employee = new Employee();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_id = $_POST['emp_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $employment_date = $_POST['employment_date'];

    $employee->updateEmployee($emp_id, $first_name, $last_name, $username, $dob, $email, $gender, $address, $country, $employment_date);
    header("Location: ./view_employee.php");
    exit();
}

// Get employee details
$emp_id = $_GET['emp_id'];
$employeeData = $employee->getEmployeeById($emp_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/css.css">
</head>
<body>
    <div class="container-in">
        <header>
            <h1>Update Employee</h1>
        </header>
        <main>
            <form action="update_employee.php" method="post">
                <input type="hidden" name="emp_id" value="<?php echo htmlspecialchars($employeeData['emp_id']); ?>">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($employeeData['first_name']); ?>" required>
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($employeeData['last_name']); ?>" required>
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($employeeData['username']); ?>" required>
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" value="<?php echo htmlspecialchars($employeeData['dob']); ?>" required>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($employeeData['email']); ?>" required>
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="Male" <?php if ($employeeData['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($employeeData['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
                <label for="address">Address:</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($employeeData['address']); ?>" required>
                <label for="country">Country:</label>
                <input type="text" name="country" value="<?php echo htmlspecialchars($employeeData['country']); ?>" required>
                <label for="employment_date">Employment Date:</label>
                <input type="date" name="employment_date" value="<?php echo htmlspecialchars($employeeData['employment_date']); ?>" required>
                <button type="submit" class="btn">Update Employee</button>
            </form>
        </main>
    </div>
</body>
</html>
