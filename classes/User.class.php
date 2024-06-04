<?php
class User extends Dbh {
    // Add Subscriber
    protected $userId;
    protected $firstName;
    protected $lastName;
    protected $username;
    protected $dob; 
    protected $email;
    protected $password;
    protected $gender;
    protected $address;
    protected $country;
    protected $cdate;
    protected $type = 'emp';
    
    public function __construct($firstName, $lastName, $username, $dob, $email, $password, $gender, $address, $country, $type = 'emp')
    {
        // Initialize class properties
        //$this->cdate = date('Y-m-d');
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->email = $email;
        if(strlen($password) < 20){
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
        else {
            $this->password = $password;
        }
        $this->gender = $gender;
        $this->address = $address;
        $this->country = $country;
        $this->username = $username;
        $this->connect();
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

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
?>
