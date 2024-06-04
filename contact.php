<?php
    if(isset($_POST['contact'])) {
        $message = "Message sent successfully";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Telecom Subscriber Management</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/css.css">
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
    <main class="main-content">
        <h1>Contact Us</h1>
            <h2>Get in Touch</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn" name="contact">Send Message</button>
            </form>
            <?php if(isset($message)) echo '<p style="color:green">'.$message.'</p>'; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Telecom Subscriber Management. All rights reserved.</p>
        <p>franktchetta54@gamil.com</p>
    </footer>
</body>
</html>
