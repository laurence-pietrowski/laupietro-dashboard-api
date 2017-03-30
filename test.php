<?php
function testingFunc($callback, $value) {
	$callback($value);
}

function testCallback($value) {
	echo "<br />Oh shit, it works with ".$value."!!!";
}

echo $_REQUEST['realm'];
echo '<br />';
echo $_REQUEST['version'];
echo '<br />';
echo $_REQUEST['request'];

echo "<br />It works!";

testingFunc(testCallback, "some really nice value");
?>