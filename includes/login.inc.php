<?php
session_start();

require_once './class-autoloader.inc.php';

if (isset($_POST['submit_login'])) {
    // Validating login field
    if (isset($_POST['user_login']) && !empty($_POST['user_login'])) {
        $login_cred = htmlentities($_POST['user_login']);
        echo '<br>'.$login_cred;
    } else {
        header("location: ../login.php?error=emptyusernameoremail");
        exit();
    }

    // Validating Password
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
        echo '<br>'.$password;
    } else {
        header("location: ../login.php?error=emptypassword");
        exit();
    }

    // Verify
    $login = new Login();
    $user = $login->getUser($login_cred, $password);
    
    $_SESSION['username'] = $user[0]['username'];
    $_SESSION['email'] = $user[0]['email'];

    $_SESSION['first_name'] = $user[0]['first_name'];
    $_SESSION['last_name'] = $user[0]['last_name'];
    $_SESSION['dob'] = $user[0]['dob'];
    $_SESSION['gender'] = $user[0]['gender'];
    $_SESSION['address'] = $user[0]['address'];
    $_SESSION['country'] = $user[0]['country'];

    $_SESSION['type'] = $login->getUsertype();
    $_SESSION['user_id'] = $login->getuID();
    $_SESSION['comp_id'] = $login->getCompId();
    $_SESSION['comp_name'] = $login->getCompName();
    
    echo $_SESSION['username'];
    echo 'Comp id'.$_SESSION['comp_id'];
    
    header("location: ./user_check.php?error=none");
    
}