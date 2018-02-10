<?php
define("TEL_PATTERN", '/([0-9]{2,4})-([0-9]{2,4})-([0-9]{4})/');
define("URL_PATTERN", '|https?://([\w-]+\.)+[\w-]+(/[\w-.\?%&=]")?|');
define("EMAIL_PATTERN", '/^([a-zA-Z]\w+\+\w*)*((\.|\w|\+)+)*@\w+([\.\w]+)*\.[a-zA-Z]{2,4}$/');

$name = !empty($_POST['name']) ? $_POST['name'] : '空です';
$tel = !empty($_POST['tel']) ? $_POST['tel'] : '空です';
$url = !empty($_POST['url']) ? $_POST['url'] : '空です';
$email = !empty($_POST['email']) ? $_POST['email'] : '空です';
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>正規表現</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .bad { color: red; }
        </style>
        <script src="javascript.js"></script>
    </head>

    <body>
        <header>
            <h1>フォーム</h1>

        </header>
        <article>
            <?php
            if (! mb_check_encoding($name, 'UTF-8')) {
                print "お名前：<span class='bad'> $name </span><br>";                
                print "文字コードが不正です。<br>";
                unset($name);
            }
            else {
                print "入力ＯＫ -- ";
                print "$name <br>";
            }

            if (preg_match(TEL_PATTERN, $tel, $teldata)) {
                print "入力ＯＫ -- ";
                foreach( $teldata as $telstr ) {
                    print " | $telstr ";
                }
                print "<br>";
            }
            else {
                print "電話番号：<span class='bad'>$tel </span><br>";
                print "入力が間違っています。<br>";
            }

            if (preg_match(URL_PATTERN, $url, $urldata)) {
                print "入力ＯＫ -- ";
                foreach( $urldata as $urlstr ) {
                    print " | $urlstr ";
                }
                print "<br>";
            }
            else {
                print "ホームページ： <span class='bad'>$url </span><br>";
                print "入力が間違っています。<br>";
            }
            
            if (preg_match(EMAIL_PATTERN, $email, $emaildata)) {
                print "入力ＯＫ -- ";
                foreach( $emaildata as $emailstr ) {
                    print " | $emailstr ";
                }
                print "<br>";
            }
            else {
                print "メールアドレス： <span class='bad'>$email </span><br>";
                print "入力が間違っています。<br>";
            }
            
            ?>
            <p><a href="sample.html">もどる</a></p>
        </article>
        <hr>
        <footer>
            <small>&copy; 2018 Seiichi Nukayama</small>
        </footer>
        <!-- hhmts start --> Last modified: Sat Feb 10 07:47:25 JST 2018 <!-- hhmts end -->
    </body>
</html>
