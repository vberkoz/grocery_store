<?php

class User
{
    /**
     * Creates new user in database
     * @param $username
     * @param $email
     * @param $secret
     * @return bool
     */
    public static function register($username, $email, $secret)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (username, email, secret, role) VALUES (:username, :email, :secret, :role)';

        $role = 'client';

        $result = $db->prepare($sql);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':secret', $secret, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Checks is string length meets requirements
     * @param $string
     * @param $length
     * @return bool
     */
    public static function checkLength($string, $length)
    {
        if (strlen($string) >= $length) return true;
        return false;
    }

    /**
     * Checks if string is valid email address
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }

    /**
     * Checks if email already exists in database
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn()) return true;
        return false;
    }

    /**
     * Checks if passwords match
     * @param $secret
     * @param $secret2
     * @return bool
     */
    public static function checkSecretMatch($secret, $secret2)
    {
        if ($secret === $secret2) return true;
        return false;
    }

    /**
     * Checks if user, with provided email and password, exists
     * @param $email
     * @param $secret
     * @return bool
     */
    public static function checkUserData($email, $secret)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE email = :email AND secret = :secret';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':secret', $secret, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) return $user['id'];
        return false;
    }

    /**
     * User authentication
     * @param $userId
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * Checks if user logged
     */
    public static function checkLogged()
    {
        if ($_SESSION['user']) return $_SESSION['user'];
        header("Location: /signin/");
    }

    /**
     * Checks if user is guest
     * @return bool
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) return false;
        return true;
    }

    /**
     * Gets user by id
     * @param $userId
     * @return mixed
     */
    public static function getUser($userId)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }

    /**
     * Update user
     * @param $userId
     * @param $username
     * @param $phone
     * @param $address
     * @param $secret
     * @return bool
     */
    public static function update($userId, $username, $phone, $address, $secret)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE users
            SET username = :username, secret = :secret, phone = :phone, address = :address
            WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->bindParam(':secret', $secret, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function updateUserDiscount($userId, $discount)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE users SET discount = :discount WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id',$userId, PDO::PARAM_INT);
        $result->bindParam(':discount',$discount, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function setChangeSecretLink($email, $link)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE users SET change_secret_link = :link WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email',$email, PDO::PARAM_STR);
        $result->bindParam(':link',$link, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function changeSecret($link, $password)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE users SET secret = :secret WHERE change_secret_link = :link';
        $result = $db->prepare($sql);
        $result->bindParam(':link',$link, PDO::PARAM_STR);
        $result->bindParam(':secret',$password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function deleteChangeSecretLink($link)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE users SET change_secret_link = :change_secret_link WHERE change_secret_link = :link';
        $result = $db->prepare($sql);
        $change_secret_link = '';
        $result->bindParam(':link',$link, PDO::PARAM_STR);
        $result->bindParam(':change_secret_link',$change_secret_link, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkLinkExists($link)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM users WHERE change_secret_link = :link';
        $result = $db->prepare($sql);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn()) return true;
        return false;
    }

    /**
     * Get users
     * @return array
     */
    public static function getUsers()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM users");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }
}