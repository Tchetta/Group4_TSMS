<?php
/* include "../random.php"; */
$path = './class-autoloader.inc.php';
if (file_exists($path)) {
    require_once './class-autoloader.inc.php';    
}
else {
    require_once './includes/class-autoloader.inc.php';
}
    class Employee extends User {
        private $companyId;

        public function __construct($firstName = null, $lastName = null, $username = null, $dob = null, $email = null, $password = null, $gender = null, $address = null, $country = null) {
            parent::__construct($firstName, $lastName, $username, $dob, $email, $password, $gender, $address, $country);
            if ($firstName && $lastName && $username && $dob && $email && $password && $gender && $address && $country) {
                $this->firstName = $firstName;
                $this->lastName = $lastName;
                $this->username = $username;
                $this->dob = $dob;
                $this->email = $email;
                $this->password = $password;
                $this->gender = $gender;
                $this->address = $address;
                $this->country = $country;
                $this->type = 'emp';
            }
        }

        public function getEmployeeById($emp_id) {
            $sql = "SELECT * FROM employee WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$emp_id]);
            return $stmt->fetch();
        }
    
        public function updateEmployee($emp_id, $first_name, $last_name, $username, $dob, $email, $gender, $address, $country, $employment_date) {
            $sql = "UPDATE employee SET first_name = ?, last_name = ?, username = ?, dob = ?, email = ?, gender = ?, address = ?, country = ?, employment_date = ? WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$first_name, $last_name, $username, $dob, $email, $gender, $address, $country, $employment_date, $emp_id]);
        }
    
        public function deleteEmployee($emp_id) {
            $sql = "DELETE FROM employee WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$emp_id]);
        }
    
        public function searchEmployeesByCompanyId($companyId, $search) {
            $sql = "SELECT * FROM employee WHERE company_id = ? AND (first_name LIKE ? OR last_name LIKE ? OR username LIKE ?)";
            $stmt = $this->conn->prepare($sql);
            $searchTerm = "%$search%";
            $stmt->execute([$companyId, $searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function empCreation($compId) {
            $this->cdate = date('Y-m-d');
            //$this->userId = $this->conn->lastInsertId() + 1;
            $this->username = $this->firstName . ceil(rand(100,1000));
            //$this->username = $this->firstName . $this->userId;
            $this->companyId = $compId;

            $sql = "INSERT INTO employee (company_id, first_name, last_name, username, dob, email, password, gender, address, country, employment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->companyId, $this->firstName, $this->lastName, $this->username, $this->dob, $this->email, $this->password, $this->gender, $this->address, $this->country, $this->cdate]);

            $this->userId = $this->conn->lastInsertId();
            $this->username = $this->firstName . $this->userId;

            $sql2 = "UPDATE employee SET username = ? WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql2);
            $stmt->execute([$this->username,$this->userId]);
        }

        public function getPass() {
            return $this->password;
        }
        public function setCompId($comp_id) {
            $this->companyId = $comp_id;
        }
        public function getcompId() {
            return $this->companyId;
        }

        public function addSubscriber($phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus) {
            $subscriber = new Subscriber($this->companyId, $phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus);
            $subscriber->addSubscriber();
            return $subscriber;
        }

        // Update Subscriber
        public function updateSubscriber($subId, $phoneNumber, $expiryDate, $address) {
            $sql = "UPDATE Subscriber SET phone_number = ?, time_status = ?, address = ? WHERE sub_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$phoneNumber, $expiryDate, $address, $subId]);
        }

        // Delete Subscriber
        public function deleteSubscriber($subId) {
            $sql = "DELETE FROM Subscriber WHERE sub_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$subId]);
        }

        // View Subscribers
        public function viewSubscribers() {
            $sql = "SELECT * FROM Subscriber";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // Update User Details
        public function updateUserDetails($empId, $firstName, $lastName, $password) {
            $sql = "UPDATE Employee SET first_name = ?, last_name = ?, password = ? WHERE emp_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$firstName, $lastName, password_hash($password, PASSWORD_DEFAULT), $empId]);
        }
    }