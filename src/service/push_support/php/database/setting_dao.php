<?php

class SettingDao {

    static function fetchSetting() {
        require_once("db_config.php");
        require_once("setting_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableSetting;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //print_r($result);
        $ret = new SettingInfo($result[0]['morning_time'], $result[0]['day_time'], $result[0]['night_time'], $result[0]['enable_android'], $result[0]['enable_ios']);

        $dbh = null;
        return $ret;
    }

    static function updateSetting($info) {
        require_once("db_config.php");
        require_once("setting_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE ".DBConfig::tableSetting." SET morning_time = ?, day_time = ?, night_time = ?, enable_android = ?, enable_ios = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $info->morningTime, PDO::PARAM_STR);
        $stmt->bindValue(2, $info->dayTime, PDO::PARAM_STR);
        $stmt->bindValue(3, $info->nightTime, PDO::PARAM_STR);
        $stmt->bindValue(4, $info->enableAndroid, PDO::PARAM_INT);
        $stmt->bindValue(5, $info->enableIos, PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
    }
}
