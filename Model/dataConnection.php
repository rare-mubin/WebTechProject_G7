<?php
    class db
    {
        function connection()
        {
            $db_host = "localhost";
            $db_user= "root";
            $db_password="";
            $db_name="hotel_r";

            $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
            if($connection->connect_error)
            {
                throw new Exception("Could not Connect Database: ".$connection->connect_error);
            }
            return $connection;
        }

        function getRecords($connection, $tablename)
        {   
            $sql = "SELECT * FROM $tablename";
            $result = $connection->query($sql);
            return $result;
        }
    }
?>
