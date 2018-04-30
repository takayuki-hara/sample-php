<?php

class DBConfig
{
    // DBアカウント
    const user = "hara";
    const pass = "hara";

    // DBホスト
    const host = "localhost";
    //const host = "";

    // DB名
    const dbName = "push_support";

    // Table名
    const tableUsers = "user_info";
    const tableSetting = "setting_info";
    const tableReserves = "push_reserve_info";

    // MySQLのDSN文字列
    const dsn = "mysql:host=".self::host.";dbname=".self::dbName.";charset=utf8";
}
