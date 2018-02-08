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
            function plus($a, $b) {
                return $a + $b;
            }
            function kakeru($a, $b) {
                return $a * $b;
            }
	        function dousuru($x, $y, callable $f){
                print $f($x, $y);
            }

	        dousuru(3, 5, "plus");
            ?>

            
        </article>
        <hr>
        <footer>
            <small>&copy; 2017 Seiichi Nukayama</small>
        </footer>

    </body>
</html>
