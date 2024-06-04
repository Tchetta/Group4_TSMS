<?php
session_start();
require_once './class-autoloader.inc.php';

// Check if user is logged in and is an employee
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    echo '<br>oooh = '.$_SESSION['type'];
    header("Location: login.php?error=unauthorized");
    exit();
}

// Get the company ID from the session
$companyId = $_SESSION['comp_id'];
$companyName = $_SESSION['comp_name'];
echo '<h2>'.$companyName.'</h2>';

// Fetch employees from the database
$employee = new Employee();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$employees = $employee->searchEmployeesByCompanyId($companyId, $search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees - Telecom Subscriber Management</title>
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
    <div class="container_view">
        <header>
            <h1 class="white">Employees of the Company</h1>
            <div class="search-bar">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input type="text" name="search" placeholder="Search employees..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </header>
        <main>
            
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Employment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($employees as $employee) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee['emp_id']); ?></td>
                            <td><?php echo htmlspecialchars($employee['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['username']); ?></td>
                            <td><?php echo htmlspecialchars($employee['dob']); ?></td>
                            <td><?php echo htmlspecialchars($employee['email']); ?></td>
                            <td><?php echo htmlspecialchars($employee['gender']); ?></td>
                            <td><?php echo htmlspecialchars($employee['address']); ?></td>
                            <td><?php echo htmlspecialchars($employee['country']); ?></td>
                            <td><?php echo htmlspecialchars($employee['employment_date']); ?></td>
                            <td class="actions">
                                    <button class="btn-update" onclick="window.location.href='./update_employee.php?emp_id=<?php echo $employee['emp_id']; ?>'">Update</button>
                                    <button class="btn-delete" onclick="window.location.href='./delete_employee.php?emp_id=<?php echo $employee['emp_id']; ?>'">Delete</button>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
