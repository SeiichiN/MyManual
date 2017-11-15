<?php
$db_name = './db/enq.db';  // データベース名

// 配列を作成する
$enq1 = array('有名だから', '家から近いから', '興味があったから',
			  '尊敬する人がいるから', 'そのほか');

$enq2 = array('雰囲気', '給料', '会社の人たち', 'オフィス環境', 'そのほか');

$enq3 = array('秘密', '男性', '女性');

// ファイルが存在するか確認する
$ext = file_exists($db_name);

// 送信ボタンが押された時
if (isset($_POST['submit']) && isset($_POST['ques1']) && isset($_POST['ques2'])) {
	$db = new SQLite3($db_name);  // データベースを開く

	// ファイルがなければ、データベース・テーブルを作成する
	if (!$ext) {
		$query = "create table enq (ans11 int, ans21 int, ans22 int, "
			. "ans23 int, ans24 int, ans25 int, ans31 int)";
		$result = $db->exec($query);
	}

	// 問１の入力内容を変数に格納する
    $ans11 = $_POST['ques1'];
        
	// 問２の入力内容を変数に格納する
    $ans2 = array(0, 0, 0, 0, 0);
    $q2 = $_POST['ques2'];
    for ($i = 0; $i < count($_POST['ques2']); $i++) {
        $no = $q2[$i];
		$ans2[$no] = 1;
    }

	// 問３の入力内容を変数に格納する
    $ans31 = $_POST['sex'];

	// 入力内容をデータベースに書き込む
	$query = "insert into enq values ($ans11, {$ans2[0]}, {$ans2[1]}, "
		. "{$ans2[2]}, {$ans2[3]}, {$ans2[4]}, $ans31)";
	$result = $db->exec($query);

	// データベースを閉じる
	$db->close();
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アンケートサンプル</title>
        <link rel="stylesheet" href="enqlite.css">
    </head>
    <body>
        <?php if (isset($_POST['submit']) && isset($_POST['ques1']) && isset($_POST['ques2'])) { ?>
            
            <p>ご協力ありがとうございました</p>
            <form action="enqlite.php" method="post">
                <p><input type="submit" name="back" value=" 前に戻る "></p>
            </form>
            <form action="enqlite-shukei.php" method="post">
                <p><input type="submit" name="shukei" value=" 集計表を見る "></p>
            </form>
    </body></html>
            <?php
            exit;  // プログラム終了
        }
        ?>

        <form action="enqlite.php" method="post">

            <p>簡単なアンケートです。ぜひご協力ください。<br>
                <span class="errMsg">注：問１、問２は必須項目です</span></p>
            <p>問１、当社を見学したいと思ったのはなぜですか？</p>
            <?php for ($i = 0; $i < count($enq1); $i++) { ?>
                <div><input type="radio" name="ques1" value="<?php print $i; ?>">
                    <?php print $enq1[$i]; ?>
                </div>
            <?php } ?>
            <p>問２、当社で気に入った点は何ですか？（複数選択可）</p>
            <?php for ($i = 0; $i < count($enq2); $i++) { ?>
            <div>
                <input type="checkbox" name="ques2[]" value="<?php print $i; ?>">
                <?php print $enq2[$i]; ?>
            </div>
            <?php } ?>
            <p>問３、あなたの性別を教えてください</p>
            <div>
                <select name="sex">
                    <option value="0" selected><?php print $enq3['0']; ?></option>
                    <option value="1"><?php print $enq3['1']; ?></option>
                    <option value="2"><?php print $enq3['2']; ?></option>
                </select>
            </div>
            <p><input type="submit" name="submit" value="送信">
                <input type="reset"></p>
        </form>
        <hr>
        <footer>
            <small>&copy; 2017 Seiichi Nukayama</small>
        </footer>
    </body>
</html>
