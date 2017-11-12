<?php
/**
 * 複数ファイルのアップロード
 * 送信用：upform.html
 * 受け取り用：load.php
 *             このファイルの場所の<files>フォルダに画像を格納する。
 * 参考サイト：多次元連想配列に値を代入
 *               https://qiita.com/shuntaro_tamura/items/97d5652626b3eedc1085
 *             HTML5でファイル複数同時アップロード
 *               https://suin.io/486
 */
?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>PHPのお勉強</title>
	<style>
		body { line-height: 2; }
	</style>
</head>
<body>
    <?php
    // load.php p129
    $i = 0;
    foreach ($_FILES as $key => $f) {
        foreach ($f as $key2 => $fff) {
            if(move_uploaded_file(
                $_FILES['upfile']['tmp_name'][$i],
                "files/" . $_FILES['upfile']['name'][$i]) == FALSE) {
            } else {
                print $_FILES['upfile']['name'][$i];
                print " をアップロードしました。<br>\n";
            }
            $i++;
        }
        
    }
    
    ?>
    <p><a href="upform.html">もどる</a></p>
</body>
</html>
