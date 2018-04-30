<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Push配信支援システム</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
</head>
<body class="bodyserviceA">
    <!-- ヘッダー -->
    <?php
        require_once 'view/header.php';
        HeaderView::createHeader("serviceA");
    ?>
    <!-- / ヘッダー -->

    <h1 class="title01">サービスA Push配信登録</h1>
    <!-- コンテンツ -->
    <?php
        require_once("database/reserve_dao.php");
        require_once("util/date_util.php");

        // 変数POSTに値がある場合は設定削除処理（アクションは今のところ削除しかない）
        if (isSet($_POST['id']) && isSet($_POST['action'])) {
            $id = $_POST['id'];
            if (ReserveDao::isAlreadSentRecord($id)) {
                create_result_body(false);
                return; // これ以上何も表示しない
            }
            ReserveDao::deleteReserve($id);
            create_result_body(true);
            return; // これ以上何も表示しない
        }

        // 指定されたレコードのデータを取得する
        if (!isSet($_GET['id'])) throw new Exception('ID不正');
        $id = (int) $_GET['id'];
        $reserve = ReserveDao::fetchReserve($id);
        $date_str = DateUtil::getReserveDateString($reserve->pushDate, $reserve->pushTime);

        // 指定されたレコードの内容を表示する
        echo "<div class='content'>";
        echo "    <h2 class='title02'>".$date_str." の配信予約</h1>";
        echo "    <center>";
        echo "    <table class='type03'>";
        echo "        <tr>";
        echo "            <th scope='row'>タイトル</th>";
        echo "            <td>".$reserve->pushTitle."</td>";
        echo "        </tr>";
        echo "        <tr>";
        echo "            <th scope='row'>本文</th>";
        echo "            <td>".$reserve->pushBody."</td>";
        echo "        </tr>";
        echo "        <tr>";
        echo "            <th scope='row'>URL</th>";
        echo "            <td>".$reserve->pushUrl."</td>";
        echo "        </tr>";
        echo "        <tr>";
        echo "            <th scope='row'>登録者</th>";
        echo "            <td>".$reserve->registUser."</td>";
        echo "        </tr>";
        echo "        <tr>";
        echo "            <th scope='row'>送信状況</th>";
        echo "            <td>Android:".$reserve->sentAndroidFlag."&emsp;iOS:".$reserve->sentIosFlag."</td>";
        echo "        </tr>";
        echo "    </table>";
        echo "    <br>";
        echo "    <form method='post' action='serviceA_confirm.php?'>";
        echo "        <input type='hidden' name='id' value=".$id.">";
        echo "        <input type='hidden' name='action' value='delete'>";
        echo "        <left><input type='submit' value='' class='submit_btn_delete'></left>";
        echo "    </form>";
        echo "    </center>";
        echo "</div>";
    ?>
    <!-- コンテンツ -->

    <!-- フッター -->
    <div id="footer"></div>
    <!-- / フッター -->
</body>
</html>

<?php
function create_result_body($success) {
    echo "<div class='content'>";
    if ($success) {
        echo "<p class='resultsuccess'>削除しました！</p>";
    } else {
        echo "<p class='caution'>送信済みのデータは削除できません！</p>";
    }
    echo "<br><a href='serviceA.php'>サービスAトップへ戻る</a>";
    echo "</div>";
    echo "<div id='footer'></div>";
}
?>
