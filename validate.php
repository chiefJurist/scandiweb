<?php

    //DATABASE CONNECTION CLASS
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
        protected $sku;
        protected $name;
        protected $price;
    
        //Setters and Getters
        public function getSKU()
        {
            return $this->sku;
        }
        
        public function setSKU($sku)
        {
            $this->sku = $sku;
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
    
        abstract public function displayDetails();
    }

    //DVD CLASS


    //BOOK CLASS
    class Book extends Product{
        protected $weight;

        public function getWeight()
        {
            return $this->weight;
        }

        public function setWeight($weight)
        {
            $this->weight = $weight;
        }

        public function displayDetails()
        {
            // Display book-specific details
            // You can use HTML or any other appropriate format
            echo "<h1>Book Details</h1>";
            echo "<p>SKU: " . $this->getSKU() . "</p>";
            echo "<p>Name: " . $this->getName() . "</p>";
            echo "<p>Price: " . $this->getPrice() . "</p>";
            echo "<p>Weight: " . $this->getWeight() . "</p>";
        }
    }
?>