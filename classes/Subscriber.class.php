<?php
/* include "../random.php"; */

$path = './class-autoloader.inc.php';
if (file_exists($path)) {
    require_once './class-autoloader.inc.php';    
}
else {
    require_once './includes/class-autoloader.inc.php';
}
class Subscriber extends Dbh {
    //private $conn;
    private $companyId;
    private $phoneNumber;
    private $firstName;
    private $lastName;
    private $dob;
    private $gender;
    private $address;
    private $status;
    private $timeStatus;

    
    public function __construct($companyId = null, $phoneNumber = '65465', $firstName = null, $lastName = null, $dob = null, $gender = null, $address = null, $status = null, $timeStatus = null) {

            if ($companyId && $phoneNumber && $firstName && $lastName && $dob && $gender && $address) {
                $this->companyId = $companyId;
                $this->phoneNumber = $phoneNumber;
                $this->firstName = $firstName;
                $this->lastName = $lastName;
                $this->dob = $dob;
                $this->gender = $gender;
                $this->address = $address;
                $this->status = $status;
                $this->timeStatus = $timeStatus;
            }
            
            $this->connect();
        }
    
    public function addSubscriber() {
        $sql = "INSERT INTO subscriber (company_id, phone_number, first_name, last_name, dob, gender, address, status, time_status, subscription_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->companyId, $this->phoneNumber, $this->firstName, $this->lastName, $this->dob, $this->gender, $this->address, $this->status, $this->timeStatus, date('Y-m-d')]);
    }

    public function searchSubscribersByCompanyId($companyId, $search) {
        $sql = "SELECT * FROM subscriber WHERE company_id = ? AND (first_name LIKE ? OR last_name LIKE ? OR phone_number LIKE ?)";
        $stmt = $this->conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->execute([$companyId, $searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getSubscriberById($sub_id) {
        $sql = "SELECT * FROM subscriber WHERE sub_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$sub_id]);
        return $stmt->fetch();
    }
    public function updateSubscriber($subId, $phoneNumber, $first_name, $last_name, $dob, $gender, $address) {
        $sql = "UPDATE subscriber SET phone_number = ?, first_name = ?, last_name = ?, dob = ?, gender = ?, address = ? WHERE sub_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$phoneNumber, $first_name, $last_name, $dob, $gender, $address, $subId]);
    }    

    public function deleteSubscriber($subId) {
        $sql = "DELETE FROM subscriber WHERE sub_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$subId]);
    }

    public function viewSubscribers() {
        $sql = "SELECT * FROM subscriber";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function linkService($sub_id, $service_id, $start_date, $stop_date, $total_cost, $status) {
        $sql = "INSERT INTO subscription_link (sub_id, service_id, start_date, stop_date, total_cost, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$sub_id, $service_id, $start_date, $stop_date, $total_cost, $status]);
    }
}
