<?php
    abstract class Product
    {
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