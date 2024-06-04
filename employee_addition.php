<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container-in">
        <h1>Add Employee</h1>    
        <main>
            <form action="./includes/add_employee.inc.php" method="post">
                <!-- <div class="form-group">
                
                    <input type="hidden" name="uname" value = '<?php //echo $_SESSION['username']; ?>'>
                </div> -->
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>   
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address">
                </div>
                <button type="submit" name="submit_emp_add" class="btn">Add</button>
                <!-- <p class="exist">Already have an account? <a href="login.php"> Login</a></p> -->
            </form>
            <?php
            // Display error messages
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == "none") {
                    $cdate = $_GET['cdate'];
                    $first_name = $_GET['first_name'];
                    echo "<p class='error-none'>Employee {$first_name} created Successfully.</p>";
                    echo "<p>Creation Date: {$cdate}</p>";
                } elseif ($error == "emptyfirstname") {
                    echo "<p class='error-msg'>First name field is required.</p>";
                } elseif ($error == "emptylastname") {
                    echo "<p class='error-msg'>Last name field is required.</p>";
                } elseif ($error == "emptypassword") {
                    echo "<p class='error-msg'>Password field is required.</p>";
                } elseif ($error == "passwordmismatch") {
                    echo "<p class='error-msg'>Passwords do not match.</p>";
                } elseif ($error == "invalidemail") {
                    echo "<p class='error-msg'>Invalid email address.</p>";
                } elseif ($error == "emptydob") {
                    echo "<p class='error-msg'>Date of Birth field is required.</p>";
                } elseif ($error == "invalidgender") {
                    echo "<p class='error-msg'>Invalid gender selection.</p>";
                } elseif ($error == "emptycountry") {
                    echo "<p class='error-msg'>Country field is required.</p>";
                } elseif ($error == "signupnotsubmitted") {
                    echo "<p class='error-msg'>Sign up form not submitted.</p>";
                }
                elseif ($error == "unknown") {
                    echo '<p class="error-msg">'. $_SESSION['Error']. '.</p>';
                }
            }
            ?>
        </main>
    </div>
</body>
</html>
