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
				$header = "From:" . mb_encode_mimeheader("糠山誠一") . "<kuon5505@gmail.com>";
				$mailto = "billie175@gmail.com";
				$subject = "絵本シリーズ";
				$message = "PHPの絵本\r\n第２版";

	            if(mb_send_mail($mailto, $subject, $message, $header)) {
					print " 送信しました。";
				} else {
					print " 送信エラー";
				}
                         
            ?>
        </article>
        <hr>
        <footer>
            <small>&copy; 2017 Seiichi Nukayama</small>
        </footer>

    </body>
</html>
