<html>
<body>
<?php

function plus1() {
	static $x = 0;
    print ++$x;
	print ++$x;
    print ++$x;
}

plus1();
print "<br>";
plus1();
?>
</body>
</html>
