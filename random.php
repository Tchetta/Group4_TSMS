<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tsms"; // Replace with your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=3308", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Function to generate random data
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )), 1, $length);
}

function generateRandomDate($start_date, $end_date) {
    $timestamp = mt_rand(strtotime($start_date), strtotime($end_date));
    return date("Y-m-d", $timestamp);
}

// Insert random services
function insertRandomServices($conn, $num) {
    for ($i = 0; $i < $num; $i++) {
        $serviceName = generateRandomString(10);
        $serviceDescription = generateRandomString(50);
        $dailyCost = rand(10, 100);
        $status = "active";
        $companyId = rand(1, 10); // Assuming there are 10 companies

        $sql = "INSERT INTO service (service_name, service_description, daily_cost, status, company_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$serviceName, $serviceDescription, $dailyCost, $status, $companyId]);
    }
}

// Insert random subscribers
function insertRandomSubscribers($conn, $num) {
    for ($i = 0; $i < $num; $i++) {
        $companyId = rand(1, 10); // Assuming there are 10 companies
        $phoneNumber = '6' . rand(100000000, 999999999);
        $firstName = generateRandomString(8);
        $lastName = generateRandomString(8);
        $dob = generateRandomDate('1980-01-01', '2000-12-31');
        $gender = rand(0, 1) ? 'Male' : 'Female';
        $address = generateRandomString(20);
        $status = "active";
        $timeStatus = "permanent";

        $sql = "INSERT INTO subscriber (company_id, phone_number, first_name, last_name, dob, gender, address, status, time_status, subscription_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$companyId, $phoneNumber, $firstName, $lastName, $dob, $gender, $address, $status, $timeStatus, date('Y-m-d')]);
    }
}

// Insert random subscription links
function insertRandomSubscriptionLinks($conn, $num) {
    for ($i = 0; $i < $num; $i++) {
        $sub_id = rand(1, 100); // Assuming there are 100 subscribers
        $service_id = rand(1, 100); // Assuming there are 100 services
        $start_date = generateRandomDate('2022-01-01', '2023-01-01');
        $stop_date = generateRandomDate('2023-01-02', '2024-01-01');
        $total_cost = rand(100, 1000);
        $status = "active";

        $sql = "INSERT INTO subscription_link (sub_id, service_id, start_date, stop_date, total_cost, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$sub_id, $service_id, $start_date, $stop_date, $total_cost, $status]);
    }
}

// Number of records to insert
$numServices = 100;
$numSubscribers = 100;
$numSubscriptionLinks = 200;

insertRandomServices($conn, $numServices);
insertRandomSubscribers($conn, $numSubscribers);
insertRandomSubscriptionLinks($conn, $numSubscriptionLinks);

echo "Random data inserted successfully";

?>
