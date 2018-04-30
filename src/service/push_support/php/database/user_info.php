<?php

class UserInfo {
    public $userId;         // ユーザID
    public $userName;       // ユーザ名
    public $passWord;       // パスワード
    public $registDatetime; // 登録日時
    public $updateDatetime; // 更新日時

    function __construct($user_id, $user_name, $pass_word, $regist_datetime, $update_datetime) {
        $this->userId = $user_id;
        $this->userName = $user_name;
        $this->passWord = $pass_word;
        $this->registDatetime = $regist_datetime;
        $this->updateDatetime = $update_datetime;
    }

}
