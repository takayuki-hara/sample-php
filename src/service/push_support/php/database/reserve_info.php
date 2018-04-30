<?php

class ReserveInfo {
    public $reserveId;          // 配信予約ID
    public $registDatetime;     // 登録日時
    public $registUser;         // 登録ユーザー
    public $serviceName;        // サービス名（"serviceA" or "serviceB"）
    public $pushTime;           // 配信予定時間（0=朝、1=昼、2=夜）
    public $pushDate;           // 配信日
    public $pushTitle;          // プッシュタイトル
    public $pushBody;           // プッシュ本文
    public $pushUrl;            // プッシュURL
    public $sentDatetime;       // 配信実績時間      （送信後に登録：NULL許容）
    public $sentAndroidFlag;    // Android送信フラグ （送信後に登録：初期値=0）
    public $sentIosFlag;        // iOS送信フラグ     （送信後に登録：初期値=0）

    function __construct($reserve_id, $regist_datetime, $regist_user, $service_name, $push_time, $push_date, $push_title, $push_body, $push_url, $sent_datetime, $sent_android_flag, $sent_ios_flag) {
        $this->reserveId = $reserve_id;
        $this->registDatetime = $regist_datetime;
        $this->registUser = $regist_user;
        $this->serviceName = $service_name;
        $this->pushTime = $push_time;
        $this->pushDate = $push_date;
        $this->pushTitle = $push_title;
        $this->pushBody = $push_body;
        $this->pushUrl = $push_url;
        $this->sentDatetime = $sent_datetime;
        $this->sentAndroidFlag = $sent_android_flag;
        $this->sentIosFlag = $sent_ios_flag;
    }

}
