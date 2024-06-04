<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecom Subscriber Management</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/css.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    
        <main>
            <?php include_once "./intro.php"; ?>
            <div class="buttons">
                <a href="signup_admin.php" class="btn"><i class="fas fa-user-plus"></i> Sign Up</a>
                <a href="login.php" class="btn"><i class="fas fa-sign-in-alt"></i> Login</a>
            </div>
        </main>
    </div>
</body>
</html>