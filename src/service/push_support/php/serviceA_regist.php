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

        // 必要なPOST変数が揃っている場合は登録処理
        if (isSet($_POST['date']) && isSet($_POST['time']) && isSet($_POST['url']) && isSet($_POST['title']) && isSet($_POST['body'])) {
            if (ReserveDao::isExistSameTimingRecord($_POST['date'], $_POST['time'])) {
                create_result_body(false);
                return; // これ以上何も表示しない
            }
            $date = new DateTime();
            $now = $date->format('Y-m-d H:i:s');
            $info = new ReserveInfo(NULL, $now, 'hara', 'serviceA', $_POST['time'], $_POST['date'], $_POST['title'], $_POST['body'], $_POST['url'], NULL, 0, 0);
            ReserveDao::addReserve($info);
            create_result_body(true);
            return; // これ以上何も表示しない
        }

        // 記事を選択して遷移してきた時の処理
        if (!isSet($_GET['date']) || !isSet($_GET['time']) || !isSet($_POST['article'])) throw new Exception('パラメータ不正');

        // TODO:記事データ取得
        $tmp_title = 'タイトル';
        $tmp_body = 'ボディ';
        $tmp_url = 'serviceA://method=push?url='.$_POST['article'];
        $tmp_writer = 'writer';
        // -----

        $date_str = DateUtil::getReserveDateString($_GET['date'], $_GET['time']);
        echo "<div class='content'>";
        echo "    <h2 class='title02'>".$date_str." の配信予約登録</h1>";
        if (ReserveDao::isExistSameUrlRecord($tmp_url)) {
            echo "<p class='caution'>その記事は既に予約されています！</p>";
        }
        echo "    <center>";
        echo "    <form method='post' action='serviceA_regist.php'>";
        echo "        <table class='type03'>";
        echo "            <tr>";
        echo "                <th scope='row'>タイトル</th>";
        echo "                <td><textarea name='title' cols='100' rows='2' maxlength='200'>".$tmp_title."</textarea></td>";
        echo "            </tr>";
        echo "            <tr>";
        echo "                <th scope='row'>本文</th>";
        echo "                <td><textarea name='body' cols='100' rows='4' maxlength='1000'>".$tmp_body."</textarea></td>";
        echo "            </tr>";
        echo "            <tr>";
        echo "                <th scope='row'>URL</th>";
        echo "                <td>".$tmp_url."</td>";
        echo "            </tr>";
        echo "            <tr>";
        echo "                <th scope='row'>ライター</th>";
        echo "                <td>".$tmp_writer."</td>";
        echo "            </tr>";
        echo "        </table>";
        echo "        <br>";
        echo "        <input type='hidden' name='date' value='".$_GET['date']."'>";
        echo "        <input type='hidden' name='time' value='".$_GET['time']."'>";
        echo "        <input type='hidden' name='url' value='".$tmp_url."'>";
        echo "        <input type='submit' value='' class='submit_btn_regist'>";
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
        echo "<p class='resultsuccess'>登録しました！</p>";
    } else {
        echo "<p class='caution'>その時間帯は既に登録があります！</p>";
    }
    echo "<br><a href='serviceA.php'>ママテナトップへ戻る</a>";
    echo "</div>";
    echo "<div id='footer'></div>";
}
?>
