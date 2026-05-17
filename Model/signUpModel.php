<?php
class SignUpModel
{

    public function addGuest($connection,$tablename,$name, $email, $phone, $nationality, $password)
    {

        $sql = ("INSERT INTO `$tablename` (name, email, phone, nationality, password_hash, role) VALUES ( '" . $name . "', '" . $email . "', '" . $phone . "', '" . $nationality . "', '" . $password . "', 'guest')");
        $result = $connection->query($sql);
        return $result;
    }
}