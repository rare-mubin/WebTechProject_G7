<?php

include '../Model/signUpModel.php';
include '../Model/dataConnection.php';

$connection = new db();
$connection = $connection->connection();

if(isset($_POST['action']) && $_POST['action'] === 'Add') {
        $name = $_POST['name']??'';
        $email = $_POST['email']??'';
        $phone = $_POST['phone']??'';
        $nationality = $_POST['nationality']??'';
        $password = $_POST['password']??'';

        if(empty($name) || empty($email) || empty($phone) || empty($nationality) || empty($password))
             {
            echo "All fields are required";
            exit;
        } 
        elseif (!preg_match("/^[a-zA-Z-' ]*$/",$name))
        {
        echo "Only letters and white space allowed in name";
        }
         elseif(strlen($name)<3)
        {
          echo "Name should be more than 3 characters";

        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
        echo "Invalid email format </br>";
        }
        else if(!preg_match("/^[0-9]{10}$/", $phone)) 
        {
        echo "Invalid phone number. It should be 10 digits.";
        }
        else if(strlen($password)<5)
        {
          echo "Password should be more than 5 characters";
        }
        else if(empty($nationality))
        {
          echo "Nationality is required";
        }else if(empty($password))
        {
          echo "Password is required";
        }
        else{
              $signUpModel = new SignUpModel();
              $result = $signUpModel->addGuest($connection,'users', $name, $email, $phone, $nationality, $password); 
            echo "OK";
        }

}