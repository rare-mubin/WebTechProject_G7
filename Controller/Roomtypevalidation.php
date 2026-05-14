<?php


if(isset($_POST['action']) && $_POST['action'] === 'Add') {
        $roomtypeName = $_POST['roomtypeName']??'';
        $perNightRate = $_POST['perNightRate']??'';
        $description = $_POST['description']??'';
        $maxCapacity = $_POST['maxCapacity']??'';
        $wifi = $_POST['wifi']??0;
        $ac = $_POST['ac']??0;
        $smartTv = $_POST['smartTv']??0;
        $breakfast = $_POST['breakfast']??0;


        if(empty($roomtypeName) || empty($perNightRate) || empty($description) || empty($maxCapacity) || $wifi===0 || $ac===0 || $smartTv===0 || $breakfast===0)
             {
            echo "All fields are required";
            exit;
        } 
        elseif (!preg_match("/^[a-zA-Z-' ]*$/",$roomtypeName))
        {
        echo "Only letters and white space allowed in room type name";
        }
         elseif(strlen($roomtypeName)<4)
        {
          echo "Room type name should be more than 4 characters";

        }
        elseif(!is_numeric($perNightRate)) 
        {
        echo "Per night rate should be a valid number";
        }
        
        else{
            echo "OK";
        }

}






?>