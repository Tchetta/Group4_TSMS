<?php

 $path = './class-autoloader.inc.php';
 if (file_exists($path)) {
     require_once './class-autoloader.inc.php';    
 }
 else {
     require_once './includes/class-autoloader.inc.php';
 }

class Service extends Dbh {
    private $serviceName;
    private $serviceDescription;
    private $dailyCost;
    private $status;
    private $companyId;

    public function __construct($serviceName = null, $serviceDescription = null, $dailyCost = null, $status = null, $companyId = null) {
        if($serviceName && $serviceDescription && $dailyCost && $status && $companyId) {
            $this->serviceName = $serviceName;
            $this->serviceDescription = $serviceDescription;
            $this->dailyCost = $dailyCost;
            $this->status = $status;
            $this->companyId = $companyId;
        }
        $this->connect();
    }

    public function addService() {
        $sql = "INSERT INTO service (service_name, service_description, daily_cost, status, company_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->serviceName, $this->serviceDescription, $this->dailyCost, $this->status, $this->companyId]);
    }

    public function viewServices($search) {
        $sql = "SELECT * FROM service WHERE service_name LIKE ? OR service_description LIKE ? OR daily_cost LIKE ? OR status LIKE ?";
        $searchelmt = "%{$search}%";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$searchelmt, $searchelmt, $searchelmt, $searchelmt]);
        return $stmt->fetchAll();
    }

    public function getServiceById($service_id) {
        $sql = "SELECT * FROM service WHERE service_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$service_id]);
        return $stmt->fetch();
    }

    public function updateService($service_id, $service_name, $service_description, $daily_cost, $status) {
        $sql = "UPDATE service SET service_name = ?, service_description = ?, daily_cost = ?, status = ? WHERE service_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$service_name, $service_description, $daily_cost, $status, $service_id]);
    }

    public function getServicesByCompanyId($companyId, $search = '') {
        $sql = "SELECT * FROM service WHERE company_id = ? AND (service_name LIKE ? OR service_description LIKE ? OR daily_cost LIKE ? OR status LIKE ?)";
        $searchelmt = "%{$search}%";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$companyId, $searchelmt, $searchelmt, $searchelmt, $searchelmt]);
        return $stmt->fetchAll();
    }

    public function deleteService($service_id) {
        $sql = "DELETE FROM service WHERE service_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$service_id]);
    }

    public function linkSubscriber($service_id, $sub_id, $start_date, $stop_date, $total_cost, $status) {
        $sql = "INSERT INTO subscription_link (service_id, sub_id, start_date, stop_date, total_cost, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$service_id, $sub_id, $start_date, $stop_date, $total_cost, $status]);
    }
}
?>
