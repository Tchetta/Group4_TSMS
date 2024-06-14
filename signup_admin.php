<?php
    session_start();
    /* include "./random.php"; */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Telecom Subscriber Management</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/css.css">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        footer {
            position: static;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
    <header class="ini">
        <div class="logo">
            <img src="favicon.ico.png" alt="TSMS logo">
            <h2>Subscriber Management System</h2>
        </div>
        <div class="ini-row">
            <ul>
                <li><a href="./index.php" style="color: white;">Home Page</a></li>
                <li><a href="./about.html" style="color: white;">About</a></li>
                <li><a href="./contact.php" style="color: white;">Contact Us</a></li>
            </ul>
        </div>
    </header>
    <div class="container-in">
        <main>
            <h1>Register Your Company</h1>
            <form action="./includes/signup.inc.php" method="post">
                <div class="row">
                    <div class="col">
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
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="reenter-password">Re-enter Password</label>
                            <input type="password" id="reenter-password" name="reenter_pwd" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="cname">Company Name</label>
                            <input type="text" id="cname" name="cname" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" required>
                        </div>
                        <button type="submit" name="submit_signup" class="btn">Sign Up</button>
                    </div>
                </div>
                <p class="exist">Already have an account? <a href="login.php"> Login</a></p>
            </form>
            <?php
            // Display error messages
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == "emptyusername") {
                    echo "<p class='error-msg'>Username field is required.</p>";
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
                if($error == 'none') {
                    echo "<p style='color: green'>Sign UP successful</p>";
                } else {
                    echo "<script>alert('" . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8') . "');</script>";
                }
            }
            
            ?>
        </main>
        </div>
        <footer>
            <p>&copy; 2024 Telecom Subscriber Management. All rights reserved.</p>
            <p><a href="mailto:franktchetta54@gmail.com">franktchetta54@gmail.com</a></p>
        </footer>
    </div>
</body>
</html>
