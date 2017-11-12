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
                } catch(ErrorException $e) {
                    $c = "計算できません（" . $e->getMessage() . "）";
                }
                return $c;
                
            }

            /**
             * set_error_handler()によって呼び出される関数
             * 関数名         ：myErrorProc
             * 働き           ：エラーを例外に変換することによって、try...catchブロックで処理できるようにする。
			 * エラーコード   ：errcodeについては、「定義済み定数」phpマニュアルに一覧がある。
			 * error_reporting：現在のエラー設定を出力。あるいは、引数でエラーレベルを設定することも可能。
			 * 
			 * error_reportingとerrcodeの論理積をとることで、エラーコードが現在のエラー設定にひっかかるか
			 * どうかを調べることができる。
			 * 
			 * try...catch では、「Division by Zero」というエラーを補足することができない。そのため
			 * set_error_handlerによってmyErrorProc関数をよびだし、そのエラーを例外に変換してスローしている。
			 * このことで、try...catch で補足できるようになる。
             */
            function myErrorProc($errcode, $msg, $file, $line) {
				// エラー設定を変更していろいろためしてみることができる。
				error_reporting(E_WARNING);
				// 現在のエラーレベルを2進数であらわす。
                print "error_reporting= " . decbin(error_reporting());
				// エラーコードを2進数であらわす。
                print "<br>errcode= " . decbin($errcode) . "<br>";
				// エラーレベルとエラーコードの両方のビットが「1」ならば「1」となる。
                print "論理積= " . decbin(error_reporting() & $errcode) . "<br>";
				// 論理積の反対
                var_dump (!(error_reporting() & $errcode));
                print "<br>";
                print "msg= $msg <br>\n";
                print "file= $file <br>\n";
                print "line= $line <br>\n";
				print "E_USER_WARNING(512)= " . decbin(E_USER_WARNING) . "<br>\n";

                // もし、エラーでなかったら
                if (!(error_reporting() & $errcode)) {
                    return;
                }
                
                // エラーを例外に変換
                throw new ErrorException($msg, 0, $errcode, $file, $line);
            }
            set_error_handler("myErrorProc");
            $x = ($_POST['left']);
            $y = ($_POST['right']);
            $z = divnum($x, $y);
            print "$x ÷ $y =$z \n";
            ?>
            <p><a href="reigai1.html">もどる</a></p>
        </article>
        <hr>
        <footer>
            <small>&copy; 2017 Seiichi Nukayama</small>
        </footer>

    </body>
</html>
