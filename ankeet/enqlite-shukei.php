<?php
$db_name = './db/enq.db';  // データベース名

// 配列を作成する
$enq1 = array('有名だから', '家から近いから', '興味があったから',
			  '尊敬する人がいるから', 'そのほか');

$enq2 = array('雰囲気', '給料', '会社の人たち', 'オフィス環境', 'そのほか');

$enq3 = array('秘密', '男性', '女性');

// ファイルが存在するか確認する
$ext = file_exists($db_name);

// データベースが存在しないとき
if (!$ext) {
	print "<p class='errMsg'>回答がありません</p>";
	exit;
}

// 変数の初期化
for ($i = 0; $i < count($enq1); $i++)
	$res1[$i] = 0;
    
for ($i = 0; $i < count($enq2); $i++)
	$res2[$i] = 0;
    
for ($i = 0; $i < count($enq3); $i++)
	$res3[$i] = 0;
		
// データベールを開いて表を読み込み、集計する
$db = new SQLite3($db_name);
$result = $db->query("select * from enq");;

while ($cols = $result->fetchArray(SQLITE3_ASSOC)) {
	$toi1 = $cols['ans11'];
	$res1[$toi1]++;
	$res2[0] += $cols['ans21'];
	$res2[1] += $cols['ans22'];
	$res2[2] += $cols['ans23'];
	$res2[3] += $cols['ans24'];
	$res2[4] += $cols['ans25'];
	$toi3 = $cols['ans31'];
	$res3[$toi3]++;
}

$db->close();

// 集計表を作成する
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アンケードサンプル</title>
        <link rel="stylesheet" href="enqlite.css">
    </head>
    <body>
        <table>
            <tr>
                <th>問1</th>
                <th class="ans">結果</th>
	        </tr>
	
	        <?php for ($i = 0; $i < count($enq1); $i ++) { ?>
	            <tr>
                    <td><?php print $enq1[$i]; ?></td>
                    <td><?php print $res1[$i]; ?></td>
                </tr>
            <?php } ?>
	    </table>
        
	    <table>
            <tr>
                <th>問2</th>
                <th class="ans">結果</th>
            </tr>
	        <?php for ($i = 0; $i < count($enq2); $i++) { ?>
		        <tr>
                    <td><?php print $enq2[$i]; ?></td>
                    <td><?php print $res2[$i]; ?></td>
                </tr>
            <?php } ?>
	    </table>
        
        <table>
	        <tr>
                <th>問3</th>
                <th class="ans">結果</th>
            </tr>
	        <?php for ($i = 0; $i < count($enq3); $i++) { ?>
	            <tr>
                    <td><?php print $enq3[$i]; ?></td>
                    <td><?php print $res3[$i]; ?></td>
                </tr>
            <?php } ?>
	    </table>
        <p><a href="enqlite.php">アンケートにもどる</a></p>
    </body>
</html>
