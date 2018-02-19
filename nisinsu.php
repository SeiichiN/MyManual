<?php
$kazu = $_GET['kazu'];
$nishinsu = decbin($kazu);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>二進数に変換</title>
        <link rel="stylesheet" href="style.css">
        <script src="javascript.js"></script>
    </head>

    <body>
        <header>
            <h1>二進数に変換</h1>
        </header>
        <article>
            <form action="" method="get">
                数を入力<input type="text" name="kazu" placeholder="<?= $kazu; ?>">
                <input type="submit">
            </form>
            <p>入力された数：<?php echo $kazu; ?></p>
            <p>2進数にすると：<?php echo $nishinsu; ?>
        </article>
<hr>
<footer>
<address></address>
</footer>
<!-- hhmts start --> Last modified: Mon Feb 19 12:26:00 東京 (標準時) 2018 <!-- hhmts end -->
</body>
</html>
