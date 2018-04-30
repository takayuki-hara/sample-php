<?php

class DateUtil {

    // 指定された年月日を含む月の初日を返す
    static function getFirstDate($date) {
        $ret = new DateTime($date);
        $ret->modify('first day of this month');
        return $ret;
    }

    // 指定された年月日を含む月の最終日を返す
    static function getLastDate($date) {
        $ret = new DateTime($date);
        $ret->modify('last day of this month');
        return $ret;
    }

    // 指定された年月日を含む月の表示用の文字列を返す
    static function getDisplayDateString($date) {
        $ret = new DateTime($date);
        $ret->modify('first day of this month');
        //echo $ret->format('Y-m-d H:i:s');
        return $ret->format('Y年m月');
    }

    // 指定された年月日を含む月の翌月の文字列を返す
    static function getNextMonthString($date) {
        $ret = new DateTime($date);
        $ret->modify('first day of next month');
        return $ret->format('Y-m-d');
    }

    // 指定された年月日を含む月の前月の文字列を返す
    static function getBeforeMonthString($date) {
        $ret = new DateTime($date);
        $ret->modify('first day of last month');
        return $ret->format('Y-m-d');
    }

    // 指定された年月日・時間帯の文字列を返す
    static function getReserveDateString($date, $time) {
        if ($time == 0) {
            return $date.' : '.self::getTimeString($time);
        } else if ($time == 1) {
            return $date.' : '.self::getTimeString($time);
        } else if ($time == 2) {
            return $date.' : '.self::getTimeString($time);
        }
    }

    // 指定された時間帯の文字列を返す
    static function getTimeString($time) {
        if ($time == 0) {
            return '朝';
        } else if ($time == 1) {
            return '昼';
        } else if ($time == 2) {
            return '夜';
        }
    }

    // 指定された年月日を含む月の日数を返す
    static function getDays($date) {
        $ret = new DateTime($date);
        $ret->modify('last day of this month');
        return (int)$ret->format('d');
    }
}
