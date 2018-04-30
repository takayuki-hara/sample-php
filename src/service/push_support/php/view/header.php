<?php
class HeaderView {
    static function createHeader($page) {
        if ($page === "top") {
            self::createRootPageHeader();
            return;
        }
        echo "<div id='header'>";
        echo "    <h1>Push配信支援システム</h1>";
        echo "    <!-- トップナビゲーション -->";
        echo "    <ul id='topnav'>";
        echo "        <li><a href='../index.php'>トップページ</a></li>";
        if ($page === "setting") {
            echo "    <li class='active'><a href='setting.php'>設定</a></li>";
        } else {
            echo "    <li><a href='setting.php'>設定</a></li>";
        }
        if ($page === "serviceA") {
            echo "    <li class='active'><a href='serviceA.php'>サービスA</a></li>";
        } else {
            echo "    <li><a href='serviceA.php'>サービスA</a></li>";
        }
        if ($page === "serviceB") {
            echo "    <li class='active'><a href='serviceB.php'>サービスB</a></li>";
        } else {
            echo "    <li><a href='serviceB.php'>サービスB</a></li>";
        }
        echo "    </ul>";
        echo "    <!-- トップナビゲーション -->";
        echo "</div>";
    }

    static private function createRootPageHeader() {
        echo "<div id='header'>";
        echo "    <h1>Push配信支援システム</h1>";
        echo "    <!-- トップナビゲーション -->";
        echo "    <ul id='topnav'>";
        echo "        <li class='active'><a href='index.php'>トップページ</a></li>";
        echo "        <li><a href='php/setting.php'>設定</a></li>";
        echo "        <li><a href='php/serviceA.php'>サービスA</a></li>";
        echo "        <li><a href='php/serviceB.php'>サービスB</a></li>";
        echo "    </ul>";
        echo "    <!-- トップナビゲーション -->";
        echo "</div>";
    }
}
