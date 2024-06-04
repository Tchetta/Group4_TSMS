<?php
session_start();

require_once './class-autoloader.inc.php';
//require_once '../classes/Admin.class.php';

if (isset($_POST['submit_signup'])) {
    // Validating username
    /* if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = htmlentities($_POST['username']);
    } else {
        header("location: ../signup.php?error=emptyusername");
        exit();
    } */

    // Validating first name
    if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
        $first_name = htmlentities($_POST['first_name']);
    } else {
        header("location: ../signup.php?error=emptyfirstname");
        exit();
    }

    // Validating last name
    if (isset($_POST['last_name']) && !empty($_POST['last_name'])) {
        $last_name = htmlentities($_POST['last_name']);
    } else {
        header("location: ../signup.php?error=emptylastname");
        exit();
    }

    // Validating password
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        header("location: ../signup.php?error=emptypassword");
        exit();
    }

    // Validating re-entered password
    if (isset($_POST['reenter_pwd']) && !empty($_POST['reenter_pwd']) && $_POST['reenter_pwd'] === $password) {
        $reenter_pwd = $_POST['reenter_pwd'];
    } else {
        header("location: ../signup.php?error=passwordmismatch");
        exit();
    }

    // Validating email
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = htmlentities($_POST['email']);
    } else {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    // Validating date of birth
    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = $_POST['dob'];
    } else {
        header("location: ../signup.php?error=emptydob");
        exit();
    }

    // Validating gender
    if (isset($_POST['gender']) && ($_POST['gender'] == 'male' || $_POST['gender'] == 'female' || $_POST['gender'] == 'other')) {
        $gender = $_POST['gender'];
    } else {
        header("location: ../signup.php?error=invalidgender");
        exit();
    }

    // Validating country
    if (isset($_POST['country']) && !empty($_POST['country'])) {
        $country = htmlentities($_POST['country']);
    } else {
        header("location: ../signup.php?error=emptycountry");
        exit();
    }

    // Validating Company name
    if (isset($_POST['cname']) && !empty($_POST['cname'])) {
        $cname = htmlentities($_POST['cname']);
    } else {
        header("location: ../signup.php?error=emptycname");
        exit();
    }

    // Validating country
    if (isset($_POST['location']) && !empty($_POST['location'])) {
        $location = htmlentities($_POST['location']);
    } else {
        header("location: ../signup.php?error=emptycountry");
        exit();
    }

    // Validating address (optional)
    $address = isset($_POST['address']) ? htmlentities($_POST['address']) : '';

    //try {
        $admin = new Admin($first_name, $last_name, '', $dob, $email, $password, $gender, $address, $country);
        $admin->adminCreation($cname, $location);
        header("location: ../login.php?error=none");
    //} catch (\Throwable $th) {
        //$_SESSION['Error'] = 'An Error occured <br>' . $th->getMessage();
        //echo $_SESSION['Error'];
        //header("location: ../signup.php?error=unknown");
    //}
    
    
} else {
    header("location: ../signup.php?error=signupnotsubmitted");
    exit();
}
