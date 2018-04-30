<?php

class UserDao {

    static function addUser($name, $pass) {
        require_once("db_config.php");
        require_once("user_info.php");

        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO ".DBConfig::tableUsers." (user_name, pass_word, regist_datetime) VALUES(?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $pass, PDO::PARAM_STR);
        $stmt->bindValue(3, $now, PDO::PARAM_STR);
        $stmt->execute();
        $dbh = null;
    }

    static function fetchUsers() {
        require_once("db_config.php");
        require_once("user_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableUsers;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //print_r($result);
        $ret = [];
        foreach($result as $row) {
            $tmp = new UserInfo($row['user_id'], $row['user_name'], $row['pass_word'], $row['regist_datetime'], $row['update_datetime']);
            $ret[] = $tmp;
        }
        //print_r($ret);

        $dbh = null;
        return $ret;
    }

    static function updateUser($id, $name, $pass) {
        require_once("db_config.php");
        require_once("user_info.php");

        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE ".DBConfig::tableUsers." SET user_name = ?, pass_word = ?, update_datetime = ? WHERE user_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $pass, PDO::PARAM_STR);
        $stmt->bindValue(3, $now, PDO::PARAM_STR);
        $stmt->bindValue(4, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
    }

    static function deleteUser($user_id) {
        require_once("db_config.php");
        require_once("user_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM ".DBConfig::tableUsers." WHERE user_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
    }

}
