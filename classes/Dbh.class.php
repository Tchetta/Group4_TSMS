<?php
    class Dbh {
        private $host = 'localhost';
        private $dbname = 'TSMS';
        private $username = 'root';
        private $password = '';
        private $port = 3308;
        protected $conn;

        public function connect() {
            try {
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';port=' . $this->port;
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        public function getCon() {
            return $this->conn;
        }

    }
