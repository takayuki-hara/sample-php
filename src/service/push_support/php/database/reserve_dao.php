<?php

class ReserveDao {

    static function addReserve($reserve) {
        require_once("db_config.php");
        require_once("reserve_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO ".DBConfig::tableReserves." (regist_datetime, regist_user, service_name, push_time, push_date, push_title, push_body, push_url, sent_android_flag, sent_ios_flag) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue( 1, $reserve->registDatetime, PDO::PARAM_STR);
        $stmt->bindValue( 2, $reserve->registUser, PDO::PARAM_STR);
        $stmt->bindValue( 3, $reserve->serviceName, PDO::PARAM_STR);
        $stmt->bindValue( 4, $reserve->pushTime, PDO::PARAM_INT);
        $stmt->bindValue( 5, $reserve->pushDate, PDO::PARAM_STR);
        $stmt->bindValue( 6, $reserve->pushTitle, PDO::PARAM_STR);
        $stmt->bindValue( 7, $reserve->pushBody, PDO::PARAM_STR);
        $stmt->bindValue( 8, $reserve->pushUrl, PDO::PARAM_STR);
        $stmt->bindValue( 9, $reserve->sentAndroidFlag, PDO::PARAM_INT);
        $stmt->bindValue(10, $reserve->sentIosFlag, PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
    }

    static function fetchReserve($id) {
        require_once("db_config.php");
        require_once("reserve_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableReserves." WHERE reserve_id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //print_r($result);
        $ret = new ReserveInfo($result['reserve_id'], $result['regist_datetime'], $result['regist_user'], $result['service_name'], $result['push_time'], $result['push_date'], $result['push_title'], $result['push_body'], $result['push_url'], $result['sent_datetime'], $result['sent_android_flag'], $result['sent_ios_flag']);

        $dbh = null;
        return $ret;
    }

    static function fetchReserves($date) {
        require_once("db_config.php");
        require_once("reserve_info.php");
        require_once("util/date_util.php");
        
        $first_day = DateUtil::getFirstDate($date);
        $last_day = DateUtil::getLastDate($date);

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableReserves." WHERE push_date BETWEEN :first AND :last";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':first', $first_day->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':last', $last_day->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //print_r($result);
        $ret = [];
        foreach($result as $row) {
            $tmp = new ReserveInfo($row['reserve_id'], $row['regist_datetime'], $row['regist_user'], $row['service_name'], $row['push_time'], $row['push_date'], $row['push_title'], $row['push_body'], $row['push_url'], $row['sent_datetime'], $row['sent_android_flag'], $row['sent_ios_flag']);
            $ret[] = $tmp;
        }
        //print_r($ret);

        $dbh = null;
        return $ret;
    }

    static function deleteReserve($reserve_id) {
        require_once("db_config.php");
        require_once("reserve_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM ".DBConfig::tableReserves." WHERE reserve_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $reserve_id, PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
    }

    static function isAlreadSentRecord($id) {
        require_once("db_config.php");
        require_once("reserve_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableReserves." WHERE reserve_id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //print_r($result);
        $dbh = null;

        if ($result['sent_android_flag'] || $result['sent_ios_flag']) {
            return 1;
        }
        return 0;
    }

    static function isExistSameUrlRecord($url) {
        require_once("db_config.php");
        require_once("reserve_info.php");
        
        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableReserves." WHERE push_url = :url";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':url', $url, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //print_r($result);
        $dbh = null;

        if ($result) {
            return 1;
        }
        return 0;
    }

    static function isExistSameTimingRecord($date, $time) {
        require_once("db_config.php");
        require_once("reserve_info.php");

        $dbh = new PDO(DBConfig::dsn, DBConfig::user, DBConfig::pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ".DBConfig::tableReserves." WHERE push_date = :date AND push_time = :time";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':time', $time, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //print_r($result);
        $dbh = null;

        if ($result) {
            return 1;
        }
        return 0;
    }


    // --- Test ---------------------------------------------------------------

    static function addTestdata() {
        require_once("reserve_info.php");

        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');
        $today = $date->format('Y-m-d');
        $info = new ReserveInfo(999,                        // reserve_id（ダミー）
                                $now,                       // regist_datetime
                                'hara',                     // regist_user
                                'serviceA',                 // service_name
                                1,                          // push_time
                                $today,                     // push_date
                                'push title',               // push_title
                                'push body',                // push_body
                                'htt://www.service.co.jp',  // push_url
                                $now,                       // sent_datetime（ダミー）
                                0,                          // sent_android_flag
                                0);                         // sent_ios_flag

        self::addReserve($info);
    }
}
