<?php
session_start();

echo $_SESSION['username'].'<br>';
echo $_SESSION['email'].'<br>';
echo '<br>Loging in as'.$_SESSION['type'];

if($_SESSION['type'] == 'admin') {
    header("location: ../admin_home.php");
} else {
    header("location: ../employee_home.php");
}

