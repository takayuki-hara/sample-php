<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Push配信支援システム</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
</head>
<body class="bodyserviceB">
    <!-- ヘッダー -->
    <?php
        require_once 'view/header.php';
        HeaderView::createHeader("serviceA");
    ?>
    <!-- / ヘッダー -->

    <h1 class="title01">サービスA Push配信予約リスト</h1>
    <!-- コンテンツ -->
    <?php
        require_once("database/reserve_dao.php");
        require_once("util/date_util.php");
        
        $date = new DateTime();
        $date_str = $date->format('Y-m-d');
        if (isSet($_GET['date'])) {
            $date_str = $_GET['date'];
        }
        $reserves = ReserveDao::fetchReserves($date_str);

        $disp = DateUtil::getDisplayDateString($date_str);
        $next = DateUtil::getNextMonthString($date_str);
        $defore = DateUtil::getBeforeMonthString($date_str);
        $days = DateUtil::getDays($date_str);

        echo "<div class='content'>";
        echo "<h2 class='title02'>".$disp."</h1>";
        echo "<a href='serviceA.php?date=".$defore."'>＜＜前月</a>&emsp;<a href='serviceA.php?date=".$next."'>＞＞翌月</a><br>";
        echo "<table class='type01'>";
        echo "    <thead>";
        echo "    <tr>";
        echo "        <th scope='cols'>予約</th>";
        echo "        <th scope='cols'>日</th>";
        echo "        <th scope='cols'>時間</th>";
        echo "        <th scope='cols'>タイトル</th>";
        echo "        <th scope='cols'>本文</th>";
        echo "        <th scope='cols'>URL</th>";
        echo "        <th scope='cols'>登録者</th>";
        echo "    </tr>";
        echo "    </thead>";
        echo "    <tbody>";
        $calendar = DateUtil::getFirstDate($date_str);
        for ($i = 1; $i <= $days; $i++) {
            create_table_row($reserves, $i, $calendar->format('Y-m-d'), 1);  // 1=昼
            create_table_row($reserves, $i, $calendar->format('Y-m-d'), 2);  // 2=夜
            $calendar->modify('+1 days');
        }
        echo "    </tbody>";
        echo "</table>";
        echo "</div>";
    ?>
    <br><br>
    <!-- コンテンツ -->

    <!-- フッター -->
    <div id="footer"></div>
    <!-- / フッター -->
</body>
</html>

<?php
function create_table_row($reserves, $i, $date, $time) {
    $flag = 0;
    foreach($reserves as $row) {
        if (($row->pushDate === $date) && ($row->pushTime === $time)) {
            $flag = 1;
            break;
        }
    }
    if ($flag) {
        echo "<tr>";
        echo "    <th scope='row'><a href='serviceA_confirm.php?id=".$row->reserveId."'>確認</a></th>";
        echo "    <th scope='row'>".$i."日</th>";
        echo "    <th scope='row'>".DateUtil::getTimeString($time)."</th>";
        echo "    <td>".$row->pushTitle."</td>";
        echo "    <td>".$row->pushBody."</td>";
        echo "    <td>".$row->pushUrl."</td>";
        echo "    <td>".$row->sentDatetime."</td>";
        echo "</tr>";
    } else {
        echo "<tr>";
        echo "    <th scope='row'><a href='serviceA_create.php?date=".$date."&time=".$time."&page=1'>登録</a></th>";
        echo "    <th scope='row'>".$i."日</th>";
        echo "    <th scope='row'>".DateUtil::getTimeString($time)."</th>";
        echo "    <td></td>";
        echo "    <td></td>";
        echo "    <td></td>";
        echo "    <td></td>";
        echo "</tr>";
    }
}
?>
