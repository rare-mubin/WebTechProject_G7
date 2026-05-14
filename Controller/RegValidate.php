<?php
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
        echo "Only letters and white space allowed";
        }
         elseif(strlen($name)<3)
        {
          echo "Name should be more than 3 characters";

        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
        echo "Invalid email format </br>";
        }
        
        else{
            echo "OK";
        }

}