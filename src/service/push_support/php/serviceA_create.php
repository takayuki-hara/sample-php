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

    <h1 class="title01">サービスA Push配信記事選択</h1>
    <!-- コンテンツ -->
    <div class="content">
        <?php
            require_once("util/date_util.php");

            if (!isSet($_GET['date']) || !isSet($_GET['time']) || !isSet($_GET['page'])) throw new Exception('パラメータ不正');

            $date_str = DateUtil::getReserveDateString($_GET['date'], $_GET['time']);
            $param = 'date='.$_GET['date'].'&time='.$_GET['time'];
            $defore = $param.'&page='.($_GET['page'] - 1);
            $next = $param.'&page='.($_GET['page'] + 1);

            echo "<h2 class='title02'>".$date_str." の記事選択</h1>";
            if ($_GET['page'] == 1) {
                echo "<a href='serviceA_create.php?".$next."'>＞＞次ページ</a><br>";
            } else {
                echo "<a href='serviceA_create.php?".$defore."'>＜＜前ページ</a>&emsp;<a href='serviceA_create.php?".$next."'>＞＞次ページ</a><br>";
            }
            echo "<form method='post' action='serviceA_regist.php?".$param."'>";
        ?>
            <center>
            <table class="type02">
                <thead>
                <tr>
                    <th scope="cols">選択</th>
                    <th scope="cols">記事URL</th>
                    <th scope="cols">タイトル</th>
                    <th scope="cols">投稿日</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row" class="even"><input type="radio" name="article" value="1" checked></th>
                    <td class="even"><a href='https://www.google.co.jp/' target='_blank'>https://www.google.co.jp/</a></td>
                    <td class="even">Google</td>
                    <td class="even">2017/07/09</td>
                    <input type="hidden" name="article" value="https://www.google.co.jp/">
                </tr>
                <tr>
                    <th scope="row"><input type="radio" name="article" value="2"></th>
                    <td><a href='https://www.google.co.jp/' target='_blank'>https://www.google.co.jp/</a></td>
                    <td>Google</td>
                    <td>2017/07/09</td>
                    <input type="hidden" name="article" value="https://www.google.co.jp/">
                </tr>
                <tr>
                    <th scope="row" class="even"><input type="radio" name="article" value="3"></th>
                    <td class="even"><a href='https://www.google.co.jp/' target='_blank'>https://www.google.co.jp/</a></td>
                    <td class="even">Google</td>
                    <td class="even">2017/07/09</td>
                    <input type="hidden" name="article" value="https://www.google.co.jp/">
                </tr>
                </tbody>
            </table>
            <br>
            <input type="submit" value="" class="submit_btn_next">
            </center>
        </form>
    </div>
    <!-- コンテンツ -->

    <!-- フッター -->
    <div id="footer"></div>
    <!-- / フッター -->
</body>
</html>
