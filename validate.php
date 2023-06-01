<?php

    //Database Connection Class
    class DatabaseConnection{
        private $host;
        private $username;
        private $password;
        private $database;

        private $connection;

        public function __construct($host, $username, $password, $database)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        public function connect()
        {
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->connection) {
                die("Database connection error: " . mysqli_connect_error());
            }
        }

        public function executeQuery($query)
        {
            return mysqli_query($this->connection, $query);
        }

        public function getResults($result)
        {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
    }


    //PRODUCTS CLASS
    abstract class Product{
        protected $id;
        protected $name;
        protected $price;
        protected $description;
    
        public function getId()
        {
            return $this->id;
        }
    
        public function getName()
        {
            return $this->name;
        }
    
        public function setName($name)
        {
            $this->name = $name;
        }
    
        public function getPrice()
        {
            return $this->price;
        }
    
        public function setPrice($price)
        {
            $this->price = $price;
        }
    
        public function getDescription()
        {
            return $this->description;
        }
    
        public function setDescription($description)
        {
            $this->description = $description;
        }
    
        abstract public function displayDetails();
    
        abstract public function save();
    }
    
?>