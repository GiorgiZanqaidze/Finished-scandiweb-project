<?php

class ProductValidator {
    
    // form data after submition
    private $data;

    // errors for display
    private $errors = [];

    // existing data in database for unique sku
    private $products;
     
    // constructor which takes two parameter. Form data after submition and existing data in database
    public function __construct($post_data, $products) {
        $this->data = $post_data;
        $this->products = $products;
    }

    // public funcion to evaluate neccessary functions in this class
    public function validateForm() {

        $this->validateSku();
        $this->validateName();
        $this->validateprice();
        $this->validateDescription();
        // return errors array for display
        return $this->errors;
    }

    // validate function for sku input
    private function validateSku() {
        // remove empty spaces for sku
        $val = trim($this->data['sku']);
        // boolean sku is unique or not 
        $flag = false;

        // check if prodycts exist in database
        if (!empty($this->products)) {
        }
        // loop through array to check current sku exists in database or not
        foreach($this->products as $product) {
            if ($val == $product['sku']) {
                $flag = true;
            } 
        }

        // if sku do not validate evaluate addEror function with two parameter
        if (empty($val)) {
            // empty value
            $this->addError('sku', "Sku can not be empty");
        } elseif (strlen($val) > 20) {
            // length of value is more
            $this->addError('sku', "Sku can not be more then 20 character");
        } elseif($flag) {
            // error for unique sku
            $this->addError('sku', "Sku input must be unique");
            // change to false after submit
            $flag = false;
        }
    }

    // validate function for name input
    private function validateName() {
        // remove empty spaces for name
        $val = trim($this->data['name']);
        // if name do not validate evaluate addEror function with two parameter
        if (empty($val)) {
            $this->addError('name', "Name can not be empty");
        } elseif (strlen($val) > 20) {
            $this->addError('name', "Name can not be more then 20 character");
        } 
    }

    // validate function for price input
    private function validatePrice() {
        // remove empty spaces for price
        $val = trim($this->data['price']);
        // if price do not validate evaluate addEror function with two parameter
        if (empty($val)) {
            $this->addError('price', "Price can not be empty");
        } elseif (strlen($val) > 20) {
            $this->addError('price', "Price can not be more then 20 character");
        } elseif (!is_numeric($val)) {
            // erorr for number price
            $this->addError('price', "Price must be a number");
        }
    }

    // validate function for description input
    private function validateDescription() {
        // check which type is submited in select input
        if ($this->data['type'] == 'furniture') {
            // remove empty spaces
            $height = trim($this->data['height']);
            $lenght = trim($this->data['length']);
            $width = trim($this->data['width']);
           
            // check are empty or not. Values are numbers or not
            if (empty($height) || empty($lenght) || empty($width)) {
                $this->addError('type', "Type can not be empty");
            } elseif (!is_numeric($height) ||!is_numeric($lenght) || !is_numeric($width)) {
                $this->addError('type', "Dimmensions must be a number");
            }   

        } elseif ($this->data['type'] == 'book') {
            // remove empty spaces
            $weight = trim($this->data['weight']);

            // check is empty or not. Value is number or not
            if (empty($weight)) {
                $this->addError('type', "Type can not be empty");
            } elseif (!is_numeric($weight)) {
                $this->addError('type', "Weight must be a number");
            }  

        } elseif ($this->data['type'] == 'DVD') {
            // remove empty spaces
            $size = trim($this->data['size']);

            // check is empty or not. Value is number or not
            if (empty($size)) {
                $this->addError('type', "Type can not be a empty");
            } elseif (!is_numeric($size)) {
                $this->addError('type', "Size must be a number");
            }  
        } elseif (isset($this->data['type']) == 'null') {
            // if type is not submited at all
            $this->addError('type', "Type can not be empty");
        }
    }

    // function to collect errors which were occured after sumbition
    // takes two parameters. name of input type and error string for display
    private function addError($key, $errorStr) {
        $this->errors[$key] = $errorStr;
    }
}

?>