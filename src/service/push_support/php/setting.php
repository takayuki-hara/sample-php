<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Push配信支援システム</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
</head>
<body class="bodymain">
    <!-- ヘッダー -->
    <?php
        require_once 'view/header.php';
        HeaderView::createHeader("setting");
    ?>
    <!-- / ヘッダー -->

    <h1 class="title01">システム設定</h1>
    <!-- コンテンツ -->
    <?php
        // 変数POSTに値がある場合は設定保存処理
        if (isSet($_POST['morning'])) {
            require_once("database/setting_dao.php");
            require_once("database/setting_info.php");

            $android = is_checked(SettingInfo::platforms[0]);
            $ios = is_checked(SettingInfo::platforms[1]);
            $info = new SettingInfo($_POST['morning'], $_POST['day'], $_POST['night'], $android, $ios);
            SettingDao::updateSetting($info);
            echo "<div class='content'>";
            echo "<p class='resultsuccess'>登録成功しました！</p>";
            echo "</div>";
        }
    ?>
    <div class="content">
        <h2 class="title02">Push配信設定</h1>
        <center>
        <form method="post" action="setting.php">
            <table class="type03">
            <?php
                require_once("database/setting_dao.php");
                require_once("database/setting_info.php");

                $info = SettingDao::fetchSetting();
                echo "<tr>";
                echo "    <th scope='row'>配信時刻</th>";
                echo "    <td>朝：";
                create_selectTag("morning", SettingInfo::morning_times, $info->morningTime);
                echo "    <br>昼：";
                create_selectTag("day", SettingInfo::day_times, $info->dayTime);
                echo "    <br>夜：";
                create_selectTag("night", SettingInfo::night_times, $info->nightTime);
                echo "    </td>";
                echo "</tr>";
                echo "<tr>";
                echo "    <th scope='row'>配信対象</th>";
                echo "    <td>";
                create_checkbox(SettingInfo::platforms[0], $info->enableAndroid);
                create_checkbox(SettingInfo::platforms[1], $info->enableIos);
                echo "    </td>";
                echo "</tr>";
            ?>
            </table>
            <br>
            <input type="submit" value="" class="submit_btn_save">
        </form>
        </center>
    </div>
    <!-- コンテンツ -->

    <!-- フッター -->
    <div id="footer"></div>
    <!-- / フッター -->
</body>
</html>

<?php

function is_checked($type) {
    require_once("database/setting_info.php");

    // $platformsに含まれていない値があれば取り出す
    $diff = array_diff($_POST["platform"], SettingInfo::platforms);
    // 規定外の値が含まれていればエラー
    if (count($diff) != 0) {
        return 0;
    }

    $platform_checked = $_POST["platform"];
    if (is_array($platform_checked)){
        // 配列のとき、値が含まれていればtrue
        $isChecked = in_array($type, $platform_checked);
    } else {
        // 配列ではないとき、値が一致すればtrue
        $isChecked = ($type === $platform_checked);
    }
    if ($isChecked) {
        return 1;
    } else {
        return 0;
    }
}

function create_selectTag($type, $array, $setting_time) {
    echo "<select name={$type}>";
    foreach($array as $time) {
        if ($setting_time === $time) {
            echo "<option value={$time} selected>{$time}</option>";
        } else {
            echo "<option value={$time}>{$time}</option>";
        }
    }
    echo "</select>";
}

function create_checkbox($type, $checked) {
    if ($checked === 1) {
        echo "<input type='checkbox' name='platform[]' value={$type} checked>{$type}";
    } else {
        echo "<input type='checkbox' name='platform[]' value={$type}>{$type}";
    }
}

?>
