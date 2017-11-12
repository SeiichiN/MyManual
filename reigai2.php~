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
				set_error_handler("myErrorSyori");
				
				$c = $a / $b;
				return $c;
            }

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
