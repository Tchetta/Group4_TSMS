<?php

    class Login extends Dbh {
        private $user_type;
        private $uid;
        private $comp_id;
        private $comp_name;
    
        public function __construct() {
            $this->connect();
        }
    
        public function getUser($login, $pwd) {
            $sql_admin = "SELECT password FROM administrator WHERE username = ? OR email = ?";
            $sql_emp = "SELECT password FROM employee WHERE username = ? OR email = ?";
            $stmt_admin = $this->conn->prepare($sql_admin);
            $stmt_emp = $this->conn->prepare($sql_emp);
    
            if(!$stmt_admin->execute(array($login, $login))) {
                $stmt_admin = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }
    
            if(!$stmt_emp->execute(array($login, $login))) {
                $stmt_emp = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }
    
            $adminCount = $stmt_admin->rowCount();
            $empCount = $stmt_emp->rowCount();
    
            if ($adminCount > 0) {
                $stmt = $stmt_admin;
                $this->user_type = 'admin';
                $sql_comp = "SELECT company_id FROM company WHERE admin_id = ?";
                $stmt_comp = $this->conn->prepare($sql_comp);
            } elseif ($empCount > 0) {
                $stmt = $stmt_emp;
                $this->user_type = 'emp';
                $sql_comp = "SELECT company_id FROM employee WHERE emp_id = ?";
                $stmt_comp = $this->conn->prepare($sql_comp);
            } else {
                header("location: ../login.php?error=usernotfound");
                exit();
            }
    
            $hashedPass = $stmt->fetch();
            $stored_Pass = $hashedPass['password'];
            $checkPass = password_verify($pwd, $stored_Pass);
    
            if (!$checkPass) {
                echo 'Raw password=' . $pwd;
                echo 'fetched password=' . $stored_Pass . '</br>';
                echo 'same pass=' . password_verify($pwd, $stored_Pass);
                /* header("location: ../login.php?error=wrongPassword&pass={$pwd}"); */
                exit();
            } else {
                $sql2 = "SELECT * FROM " . ($this->user_type === 'admin' ? 'administrator' : 'employee') . " WHERE password = ? AND ( username = ? OR email = ? )";
                $statement = $this->conn->prepare($sql2);
    
                if(!$statement->execute(array($stored_Pass, $login, $login))) {
                    $statement = null;
                    header("location: ../login.php?error=stmtfailed2");
                    exit();
                }
    
                if($statement->rowCount() == 0){
                    $statement = null;
                    header("location: ../login.php?error=usernotfound2");
                    exit();
                }
    
                $user = $statement->fetchAll();
                if ($this->user_type === 'admin') {
                    $this->uid = $user[0]['admin_id'];
                } elseif ($this->user_type === 'emp') {
                    $this->uid = $user[0]['emp_id'];
                }

                $stmt_comp->execute([$this->uid]);
                if ($stmt_comp->rowCount() > 0){
                    echo 'cool';
                    $comp = $stmt_comp->fetch();
                    $this->comp_id = $comp['company_id'];
                    $this->comp_name = $comp['company_name'];
                }
    
                return $user;
            }
        }

        public function getCompId(){
            return $this->comp_id;
        }
        public function getCompName(){
            return $this->comp_name;
        }
    
        public function getUsertype() {
            return $this->user_type;
        }
    
        public function getuID() {
            return $this->uid;
        }
    }
    