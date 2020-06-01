<?php

class Request
{
    /**
     * Get requests
     * @return array
     */
    public static function index()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM requests ORDER BY REQUEST_TIME_FLOAT DESC LIMIT 100');
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        $requests = [];
        while ($row = $result->fetch()) {
            $time = date('Y-m-d H:i:s', $row['REQUEST_TIME_FLOAT']);
            $requests[$i]['REQUEST_TIME_FLOAT'] = $time;
            $requests[$i]['REMOTE_ADDR'] = $row['REMOTE_ADDR'];
            $requests[$i]['REQUEST_METHOD'] = $row['REQUEST_METHOD'];
            $requests[$i]['REQUEST_URI'] = $row['REQUEST_URI'];
            $requests[$i]['HTTP_USER_AGENT'] = $row['HTTP_USER_AGENT'];
            $requests[$i]['HTTP_ACCEPT_LANGUAGE'] = $row['HTTP_ACCEPT_LANGUAGE'];
            $requests[$i]['PHPSESSID'] = $row['PHPSESSID'];

            $user = User::getUser($row['USER_ID']);
            if (!$user) $user['username'] = 'Гість';
            $requests[$i]['USER_ID'] = $user['username'];
            $i ++;
        }

        return $requests;
    }

    /**
     * Create request
     */
    public static function create()
    {
        $db = Db::getConnection();

        $bag = '';
        if (array_key_exists('products', $_SESSION)) $bag = json_encode($_SESSION['products']);

        $userId = 0;
        if (array_key_exists('user', $_SESSION)) $userId = $_SESSION['user'];

        $sql = 'INSERT INTO requests (REQUEST_TIME_FLOAT, REMOTE_ADDR, REQUEST_METHOD, REQUEST_URI, HTTP_USER_AGENT, HTTP_ACCEPT_LANGUAGE, PHPSESSID, USER_ID, BAG)
                VALUES (:REQUEST_TIME_FLOAT, :REMOTE_ADDR, :REQUEST_METHOD, :REQUEST_URI, :HTTP_USER_AGENT, :HTTP_ACCEPT_LANGUAGE, :PHPSESSID, :USER_ID, :BAG)';
        $result = $db->prepare($sql);
        $result->bindParam(':REQUEST_TIME_FLOAT', $_SERVER['REQUEST_TIME_FLOAT'], PDO::PARAM_STR);
        $result->bindParam(':REMOTE_ADDR', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
        $result->bindParam(':REQUEST_METHOD', $_SERVER['REQUEST_METHOD'], PDO::PARAM_STR);
        $result->bindParam(':REQUEST_URI', $_SERVER['REQUEST_URI'], PDO::PARAM_STR);
        $result->bindParam(':HTTP_USER_AGENT', $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
        $result->bindParam(':HTTP_ACCEPT_LANGUAGE', $_SERVER['HTTP_ACCEPT_LANGUAGE'], PDO::PARAM_STR);
        $result->bindParam(':PHPSESSID', $_COOKIE['PHPSESSID'], PDO::PARAM_STR);
        $result->bindParam(':USER_ID', $userId, PDO::PARAM_INT);
        $result->bindParam(':BAG', $bag, PDO::PARAM_STR);
        $result->execute();
    }
}