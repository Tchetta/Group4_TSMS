<?php
session_start();
require_once './class-autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['phone_number'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $status = $_POST['status'] ?? null; // Allow null values
    $timeStatus = $_POST['time_status'] ?? null; // Allow null values

    // Ensure required fields are filled
    if (empty($phoneNumber) || empty($firstName) || empty($lastName) || empty($dob) || empty($gender) || empty($address)) {
        $_SESSION['message'] = "All required fields must be filled.";
        $_SESSION['message_type'] = "error";
        header("Location: create_subscriber.php");
        exit();
    }


    try {
        if ($_SESSION['type'] == 'admin') {
        $admin = new Admin($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['username'], $_SESSION['dob'], $_SESSION['email'], 'c', $_SESSION['gender'], $_SESSION['address'], $_SESSION['country']);
        $admin->setCompId($_SESSION['comp_id']);
        echo 'THe comp_id is'.$_SESSION['comp_id'];
        echo 'THe username is'.$_SESSION['username'];
        $bdate = date('Y-m-d', time() - 18*365*24*3600);
        $admin->addSubscriber($phoneNumber, $firstName, $lastName, $bdate, $gender, $address, $status, $timeStatus);
        } elseif ($_SESSION['type'] == 'emp') {
            $employee = new Employee($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['username'], $_SESSION['dob'], $_SESSION['email'], 'n', $_SESSION['gender'], $_SESSION['address'], $_SESSION['country']);
            $employee->setCompId($_SESSION['comp_id']);
            $employee->addSubscriber($phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus);
        } else {
            throw new Exception("Unauthorized user type");
        }
        
        echo 'compi_id'.$_SESSION['comp_id'];
        $_SESSION['message'] = "Subscriber added successfully.";
        $_SESSION['message_type'] = "success";
        header("Location: ../admin_home.php?{$_SESSION['message-type']}={$_SESSION['message']}");
    } catch (Exception $e) {
        $_SESSION['message'] = "Failed to add subscriber: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
        
        header("Location: ../admin_home.php?{$_SESSION['message-type']}={$_SESSION['message']}");
    }
    echo $_SESSION['message_type'].' = <br>'.$_SESSION['message'];
    exit();
     }  else {
        header("Location: ../create_subscriber.php");
        exit();
    }

