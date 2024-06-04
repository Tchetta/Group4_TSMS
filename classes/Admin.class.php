<?php
/* include "../random.php"; */

require_once './class-autoloader.inc.php';

    class Admin extends User {
        // Add Employee
        private $compId;

        public function __construct($firstName, $lastName, $username, $dob, $email, $password, $gender, $address, $country)
        {
            parent::__construct($firstName, $lastName, $username, $dob, $email, $password, $gender, $address, $country);

            $this->type = 'admin';
        }

        public function adminCreation($cname, $location) {
            $this->cdate = date('Y-m-d');
            //$this->userId = $this->conn->lastInsertId() + 1;
            $this->username = $this->firstName . ceil(rand(100,1000));

            $sql = "INSERT INTO administrator (first_name, last_name, username, dob, email, password, gender, address, country, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->firstName, $this->lastName, $this->username, $this->dob, $this->email, $this->password, $this->gender, $this->address, $this->country, $this->cdate]);

            $this->userId = $this->conn->lastInsertId();
            $this->username = "{$this->firstName}{$this->userId}";
            $sql2 = "UPDATE administrator SET username = ? WHERE admin_id = ?";
            $stmt = $this->conn->prepare($sql2);
            $stmt->execute([$this->username,$this->userId]);

            $company = new Company($cname, $location);
            $this->compId = $company->compCreation($this->userId);
            
        }

        public function setCompId($comp_id) {
            $this->compId = $comp_id;
        }

        public function addEmployee($firstName, $lastName, $username, $dob, $email, $password, $gender, $address, $country) {
            $employee = new Employee($firstName, $lastName, $username, $dob, $email, $password, $gender, $address, $country);
            $employee->empCreation($this->compId);
            return $employee;
        }

        
    public function addSubscriber($phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus) {
        $subscriber = new Subscriber($this->compId, $phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus);
        $subscriber->addSubscriber();
        return $subscriber;
    }

    public function viewEmployees() {
        $sql = "SELECT * FROM employee";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Update Employee Details
    public function updateEmployeeDetails($empId, $firstName, $lastName, $password) {
        $sql = "UPDATE employee SET first_name = ?, last_name = ?, password = ? WHERE emp_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$firstName, $lastName, password_hash($password, PASSWORD_DEFAULT), $empId]);
    }

    // Delete Employee
    public function deleteEmployee($empId) {
        $sql = "DELETE FROM employee WHERE emp_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$empId]);
    }

    // View Subscribers
    public function viewSubscribers() {
        $sql = "SELECT * FROM subscriber";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Update Subscriber Details
    public function updateSubscriberDetails($subId, $phoneNumber, $expiryDate, $address) {
        $sql = "UPDATE subscriber SET phone_number = ?, time_status = ?, address = ? WHERE sub_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$phoneNumber, $expiryDate, $address, $subId]);
    }

    // Delete Subscriber
    public function deleteSubscriber($subId) {
        $sql = "DELETE FROM subscriber WHERE sub_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$subId]);
    }
    
    public function addService($serviceName, $serviceDescription, $dailyCost, $status, $compId) {
        try {
            $sql = "INSERT INTO service (service_name, service_description, daily_cost, status, company_id) VALUES (?, ?, ?, ? ,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$serviceName, $serviceDescription, $dailyCost, $status, $compId]);
            $_SESSION['message'] = "Service added successfully.";
            $_SESSION['message_type'] = "success";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to add service: " . $e->getMessage();
            $_SESSION['message_type'] = "error";
        }
    }
    
       /*  // Update Employee Name
        public function updateEmployee($empId, $firstName, $lastName, $address) {
            $sql = "UPDATE Employee SET first_name = ?, last_name = ?, address = ? WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$firstName, $lastName, $address, $empId]);
        }

        // Delete Employee
        public function deleteEmployee($empId) {
            $sql = "DELETE FROM Employee WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$empId]);
        }

        // Update Employee Password
        public function updateEmployeePassword($empId, $password) {
            $sql = "UPDATE Employee SET password = ? WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $empId]);
        }

        /* public function addSubscriber($companyId, $phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus) {
            $sql = "INSERT INTO Subscriber (company_id, phone_number, first_name, last_name, dob, gender, address, status, time_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$companyId, $phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus]);
        }

        public function addSubscriber($phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus) {
            $subscriber = new Subscriber($this->compId, $phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus);
            $subscriber->addSubscriber();
            return $subscriber;
        }

     // Check if a username already exists in the database
     public function usernameExists($username) {
        $sql = "SELECT COUNT(*) AS count FROM Administrator WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            header("location: ../signup.php?error=usernameexists");
            exit();
        }
        else {
            return $result['count'] = 0;    
        }
        
    }

    // Check if an email already exists in the database
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) AS count FROM Administrator WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            header("location: ../signup.php?error=usernameexists");
            exit();  
        }
        else {
            return $result['count'] = 0;    
        }
    } */

}