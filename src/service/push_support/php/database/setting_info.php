<?php

class SettingInfo {
    public $morningTime;    // 朝配信時刻
    public $dayTime;        // 昼配信時刻
    public $nightTime;      // 夜配信時刻
    public $enableAndroid;  // Android配信
    public $enableIos;      // iOS配信設定

    function __construct($morning, $day, $night, $android, $ios) {
        $this->morningTime = $morning;
        $this->dayTime = $day;
        $this->nightTime = $night;
        $this->enableAndroid = $android;
        $this->enableIos = $ios;
    }

    const morning_times = array("09:00:00", "09:05:00", "09:10:00", "09:15:00",
                                "09:20:00", "09:25:00", "09:30:00", "09:35:00",
                                "09:40:00", "09:45:00", "09:50:00", "09:55:00");
    const day_times = array("12:00:00", "12:05:00", "12:10:00", "12:15:00",
                            "12:20:00", "12:25:00", "12:30:00", "12:35:00",
                            "12:40:00", "12:45:00", "12:50:00", "12:55:00");
    const night_times = array("21:00:00", "21:05:00", "21:10:00", "21:15:00",
                              "21:20:00", "21:25:00", "21:30:00", "21:35:00",
                              "21:40:00", "21:45:00", "21:50:00", "21:55:00");

    const platforms = array("Android", "iOS");
}
