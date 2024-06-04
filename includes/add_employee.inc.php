<?php
session_start();
    require_once './class-autoloader.inc.php';

    if (isset($_POST['submit_emp_add'])) {
        
        echo $_POST['uname'].'<br>';
        // Validating first name
        if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
            $first_name = htmlentities($_POST['first_name']);
        } else {
            header("location: ../employee_addition.php?error=emptyfirstname");
            exit();
        }
    
        // Validating last name
        if (isset($_POST['last_name']) && !empty($_POST['last_name'])) {
            $last_name = htmlentities($_POST['last_name']);
        } else {
            header("location: ../employee_addition?error=emptylastname");
            exit();
        }
    
        // Validating email
        if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlentities($_POST['email']);
        } else {
            header("location: ../employee_addition.php?error=invalidemail");
            exit();
        }
    
        // Validating gender
        if (isset($_POST['gender']) && ($_POST['gender'] == 'male' || $_POST['gender'] == 'female' || $_POST['gender'] == 'other')) {
            $gender = $_POST['gender'];
        } else {
            header("location: ../employee_addition.php?error=invalidgender");
            exit();
        }
    
        // Validating country
        if (isset($_POST['country'])) {
            $country = htmlentities($_POST['country']);
        } else {
            header("location: ../employee_addition.php?error=emptycountry");
            exit();
        }
    
        // Validating address (optional)
        $address = isset($_POST['address']) ? htmlentities($_POST['address']) : '';

        if(isset($_SESSION['username'])){
            $admin_uname = $_SESSION['username'];
        }
        else {
            $admin_uname = $_POST['uname'];
        }

        $db = new Dbh();
        $db->connect();
        
        $sql2 = "SELECT * FROM administrator WHERE username = ?";
        $stmt2 = $db->getCon()->prepare($sql2);
        $stmt2->execute([$admin_uname]);
        $admin_array = $stmt2->fetch();
        $admin_id = $admin_array['admin_id'];
        echo "Admin id is {$admin_id}";


        $sql = "SELECT company_id
                FROM company
                WHERE admin_id = ?;
                ";
        $stmt = $db->getCon()->prepare($sql);
        $stmt->execute([$admin_id]);
        $company = $stmt->fetch();
        
        $comp_id = $company['company_id'];
        
        $admin_obj = new Admin($admin_array['first_name'], $admin_array['last_name'], $admin_array['username'], $admin_array['dob'], $admin_array['email'], $admin_array['password'], $admin_array['gender'], $admin_array['address'], $admin_array['country']);
        $admin_obj->setCompId($comp_id);
        $cdate = date('Y-m-d', time() - 18*365*24*3600);
        if($employee=$admin_obj->addEmployee($first_name, $last_name, '', $cdate, $email, 'd5610', $gender, $address, $country)) {
            header("Location: ../admin_home.php?error=none;fname={$first_name}");
            //echo $employee->getcompId();
        }
        else {
            echo 'Failed to add employee!';
        }
        
    } else {
        header("location: ../employee_addition.php?error=empnotadded");
        exit();
    }
    