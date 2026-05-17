<?php
class LoginModel
{
    public function validateUser($connection, $email, $password)
    {
        $sql = $connection->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1");

        if (!$sql) {
            return false;
        }

        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        $user = $result->fetch_assoc();
        $sql->close();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }
}
?>
