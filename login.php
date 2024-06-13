<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Telecom Subscriber Management</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        <h1>Login</h1>
        <main>
            <form action="./includes/login.inc.php" method="post">
                <div class="form-group">
                    <label for="username-email">Username or Email</label>
                    <input type="text" id="username-email" name="user_login" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn" name="submit_login">Login</button>
                <p class="exist">Don't have an account? <a href="signup_admin.php"> Sign Up</a></p>
            </form>
            <?php
                if(isset($_GET['error'])) {
                    echo "<p class=\"error\">{$_GET['error']}/<p>";
                }
            ?>
        </main>
        <footer>
            <p>&copy; 2024 Telecom Subscriber Management. All rights reserved.</p>
            <p><a href="mailto:franktchetta54@gmail.com">franktchetta54@gmail.com</a></p>
        </footer>
        </div>
    </div>
</body>
</html>
