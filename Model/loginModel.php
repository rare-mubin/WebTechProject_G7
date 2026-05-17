<?php
class LoginModel
{
    public function validateUser($connection, $email, $password)
    {
        $stmt = $connection->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }
}
?>
