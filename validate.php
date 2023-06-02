<?php

    //CREATING THE PRODUCTS CLASS
    abstract class Product{
        private $sku;
        private $name;
        private $price;

        private $errors = [];

        public function __construct($post_data){
            $this->sku = $post_data["sku"];
            $this->name = $post_data["name"];
            $this->price = $post_data["price"];
        }

        //Validate Form
        public function validateForm(){
            if (empty($this->sku)) {
                $this->addError("sku", "sku cannot be empty");
                return;
            }elseif (empty($this->name)) {
                $this->addError("name", "name cannot be empty");
                return;
            }elseif (empty($this->price)) {
                $this->addError("price", "price cannot be empty");
                return;
            }
        }

        //Add Errors
        public function addError($key, $val){
            $this->errors[$key] = $val;
        }

        //Getters and setters
    }

    //CREATING DVD CLASS
    class Dvd extends Product{
        private $size;

        public function __construct($post_data){
            $this->size = $post_data["size"];
            parent::__construct($post_data);
        }

        //Check if DVD is the selected type
        protected function validateDVD(){
            if (!empty($this->size)) {
                if (!preg_match('/^\d+$/', $this->size)) {
                    $this->addError("size", "Please input DVD size in MB");
                    return;
                }
            }else{
                $this->size = null;
            }
        }
    }

    //CREATING BOOK CLASS
    class Book extends Product{
        private $weight;

        public function __construct($post_data){
            $this->weight = $post_data["weight"];
            parent::__construct($post_data);
        }

        //Check if Book is the selected type
        protected function validateBook(){
            if (!empty($this->weight)) {
                if (!preg_match('/^\d+$/', $this->weight)) {
                    $this->addError("weight", "Please input Book weight in KG");
                    return;
                }
            }else{
                $this->weight = null;
            }
        }
    }

    //CREATING FURNITURE CLASS
    class Furniture extends Product{
        private $length;
        private $width;
        private $height;

        public function __construct($post_data){
            $this->length = $post_data["length"];
            $this->width = $post_data["width"];
            $this->height = $post_data["height"];
            parent::__construct($post_data);
        }

        //Check if Book is the selected type
        protected function validateFurniture(){
            if (!empty($this->length) or !empty($this->width) or !empty($this->height)) {
                if (empty($this->length)) {
                    $this->addError("length", "length cannot be empty");
                    return;
                }elseif (empty($this->width)) {
                    $this->addError("width", "width cannot be empty");
                    return;
                }elseif (empty($this->height)) {
                    $this->addError("height", "height cannot be empty");
                    return;
                }
            }else{
                $this->length = null;
                $this->width = null;
                $this->height = null;
            }
        }
    }
?>