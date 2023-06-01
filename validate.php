<?php

    //DATABASE CONNECTION CLASS
    class DatabaseConnection{
        private $host;
        private $username;
        private $password;
        private $database;

        private $connection;

        public function __construct($host, $username, $password, $database){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        public function connect(){
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->connection) {
                die("Database connection error: " . mysqli_connect_error());
            }
        }

        public function executeQuery($query){
            return mysqli_query($this->connection, $query);
        }

        public function getResults($result){
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
        public function getSKU(){
            return $this->sku;
        }
        
        public function setSKU($sku){
            $this->sku = $sku;
        }
    
        public function getName(){
            return $this->name;
        }
    
        public function setName($name){
            $this->name = $name;
        }
    
        public function getPrice(){
            return $this->price;
        }
    
        public function setPrice($price){
            $this->price = $price;
        }
    
        abstract public function displayDetails();

        //Database Property
        protected static $db;

        // The function saves a product's details to a database table called "products".
        public function save(){
            $name = mysqli_real_escape_string(self::$db->getConnection(), $this->getName());
            $price = mysqli_real_escape_string(self::$db->getConnection(), $this->getPrice());

            $query = "INSERT INTO products (name, price) VALUES ('$name', '$price')";

            $result = self::$db->executeQuery($query);

            if (!$result){
                die("Product saving error: " . mysqli_error(self::$db->getConnection()));
            }
        }

        //This function sets the database connection for a static variable in a PHP class.
        public static function setDatabaseConnection($db){
            self::$db = $db;
        }
    }

    //DVD CLASS
    class DVD extends Product{
        protected $size;

        public function getSize(){
            return $this->size;
        }

        public function setSize($size){
            $this->size = $size;
        }

        public function displayDetails(){
            // Display book-specific details
            // You can use HTML or any other appropriate format
            echo "<h1>Book Details</h1>";
            echo "<p>SKU: " . $this->getSKU() . "</p>";
            echo "<p>Name: " . $this->getName() . "</p>";
            echo "<p>Price: " . $this->getPrice() . "</p>";
            echo "<p>Weight: " . $this->getSize() . "</p>";
        }
    }

    //BOOK CLASS
    class Book extends Product{
        protected $weight;

        public function getWeight(){
            return $this->weight;
        }

        public function setWeight($weight){
            $this->weight = $weight;
        }

        public function displayDetails(){
            // Display book-specific details
            // You can use HTML or any other appropriate format
            echo "<h1>Book Details</h1>";
            echo "<p>SKU: " . $this->getSKU() . "</p>";
            echo "<p>Name: " . $this->getName() . "</p>";
            echo "<p>Price: " . $this->getPrice() . "</p>";
            echo "<p>Weight: " . $this->getWeight() . "</p>";
        }
    }

    //FURNITURE CLASS
    class Furniture extends Product{
        protected $length;
        protected $width;
        protected $height;

        public function getLength(){
            return $this->length;
        }

        public function setLength($length){
            $this->length = $length;
        }

        public function getWidth(){
            return $this->width;
        }

        public function setWidth($width){
            $this->width = $width;
        }

        public function getHeight(){
            return $this->height;
        }

        public function setHeight($height){
            $this->height = $height;
        }

        public function displayDetails(){
            // Display book-specific details
            // You can use HTML or any other appropriate format
            echo "<h1>Book Details</h1>";
            echo "<p>SKU: " . $this->getSKU() . "</p>";
            echo "<p>Name: " . $this->getName() . "</p>";
            echo "<p>Price: " . $this->getPrice() . "</p>";
            echo "<p>Weight: " . $this->getLength() . "</p>";
            echo "<p>Weight: " . $this->getWidth() . "</p>";
            echo "<p>Weight: " . $this->getHeight() . "</p>";
        }
    }
?>