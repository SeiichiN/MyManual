<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>PHP</title>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <header>
            <h1></h1>
        </header>
        <article>
            <?php
            function divnum($a, $b){
                try {
				    $c = $a / $b;
                } catch (Exception $e) {
                    $c = "計算できません。{$e->getMessage()} <br>\n";
                }
				return $c;
            }
            function mySyori() {
                throw new ErrorException('無理っス!');
            }
            function myErrorSyori($errcode, $msg, $file, $line) {
                throw new ErrorException($msg, 0, $errcode, $file, $line);
            }
            
//			set_error_handler("myErrorSyori");
			set_error_handler("mySyori");
            $x = ($_POST['left']);
            $y = ($_POST['right']);
            $z = divnum($x, $y);
            print "$x ÷  $y = $z <br> \n";
            ?>
            <p><a href="reigai1.html">もどる</a></p>
        </article>
        <hr>
        <footer>
            <small>&copy; 2017 Seiichi Nukayama</small>
        </footer>

    </body>
</html>
