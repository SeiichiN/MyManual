<?php
/**
 * enqlite_edit.php
 * このファイルは『PHPの絵本・第２版』p188の入力を残すためのものである。
 * もとのコードは、ちょっと好きになれない。
 */
?>
<?php
define ('DEBUG',1);

$db_name = './db/enq.db';  // データベース名

// 配列を作成する
$enq1 = array('有名だから', '家から近いから', '興味があったから',
			  '尊敬する人がいるから', 'そのほか');

$enq2 = array('雰囲気', '給料', '会社の人たち', 'オフィス環境', 'そのほか');

$enq3 = array('秘密', '男性', '女性');

// ファイルが存在するか確認する
$ext = file_exists($db_name);

if(DEBUG) { echo '$ext= '; var_dump($ext); echo '<br>';}

// 送信ボタンが押された時
if (isset($_POST['submit']) && isset($_POST['ques1']) && isset($_POST['ques2'])) {

    if(DEBUG) echo '送信ボタンをキャッチ！<br>';

    if(DEBUG) echo "問１= {$_POST['ques1']} <br>";
    if(DEBUG) { echo "問２= "; print_r($_POST['ques2']); echo "<br>"; }
    if(DEBUG) echo "問３= {$_POST['sex']} <br>";

	$db = new SQLite3($db_name);  // データベースを開く

	// ファイルがなければ、データベース・テーブルを作成する
	if (!$ext) {
		$query = "create table enq (ans11 int, ans21 int, ans22 int, "
			. "ans23 int, ans24 int, ans25 int, ans31 int)";
		$result = $db->exec($query);
	}

	// 問１の入力内容を変数に格納する
    $ans11 = $_POST['ques1'];
    /*
	for ($i = 0; $i < count($enq1); $i++ ) {
		if ($_POST['ques1'] == $i) {
			$ans11 = $i;
			break;
		}
	}
    */
        
	// 問２の入力内容を変数に格納する
    $ans2 = array(0, 0, 0, 0, 0);
    /*
	for ($i = 0; $i < count($enq2); $i++) 
		$ans2[$i] = 0;
     */
    $q2 = $_POST['ques2'];
    for ($i = 0; $i < count($_POST['ques2']); $i++) {
        $no = $q2[$i];
		$ans2[$no] = 1;
    }

	// 問３の入力内容を変数に格納する
    $ans31 = $_POST['sex'];
    /*
	for ($i = 0; $i < count($enq3); $i++) {
		if ($_POST['sex'] == $i) {
			$ans31 = $i;
			break;
		}
	}
    */

	// 入力内容をデータベースに書き込む
	$query = "insert into enq values ($ans11, {$ans2[0]}, {$ans2[1]}, "
		. "{$ans2[2]}, {$ans2[3]}, {$ans2[4]}, $ans31)";
	$result = $db->exec($query);

	// データベースを閉じる
	$db->close();
}

// ヘッダ出力
header("Content-Type: text/html; charset=UTF-8");

function show_result() {
	global $enq1, $enq2, $enq3, $ext, $db_name; // グローバル配列
	
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

    if(DEBUG) {
        while ($cols = $result->fetchArray(SQLITE3_ASSOC)) {
            print_r($cols);
            echo '<br>';
        }
    }
    
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

    if(DEBUG) print_r($res1);

	// 集計表を作成する
	?>
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

    <?php
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アンケードサンプル</title>
        <link rel="stylesheet" href="enqlite.css">
    </head>
    <body>
        <form action="enqlite.php" method="post">
            <?php
            // 条件により表示する画面を変更する
            if (isset($_POST['submit']) && isset($_POST['ques1']) && isset($_POST['ques2'])) { ?>
            
                <p>ご協力ありがとうございました</p>
                <p><input type="submit" name="back" value=" 前に戻る "></p>
                </form></body></html>
            <?php
                exit;
            } elseif (isset($_GET['show_result'])) {
                show_result();
                ?>
                </form></body></html>
                <?php
                exit;
            }
            ?>

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
    </body>
</html>


                    
                
