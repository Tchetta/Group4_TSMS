<?php

    require_once './class-autoloader.inc.php';
    class Company extends Dbh {

        private $cid;
        private $cname;
        private $admin_id;
        private $location;
        private $cdate;

        public function __construct($cname, $location)
        {
            $this->cname = $cname;
            $this->location = $location;
            $this->connect();
        }

        public function compCreation($admin_id) {
            echo $admin_id.'<br>';
            $this->admin_id = $admin_id;
            $this->cdate = date('Y-m-d');

            $this->cid = $admin_id . ceil(rand(100,1000));
            echo $this->cid."<br>";

            $sql = "INSERT INTO company (admin_id, company_name, location, creation_date) VALUES (?, ?, ?, ?)";
            echo $sql."<br>";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->admin_id, $this->cname, $this->location, $this->cdate]);

            $this->cid = $this->conn->lastInsertId();
            echo $this->cid.'<br>';
            return $this->cid;
        }

    }