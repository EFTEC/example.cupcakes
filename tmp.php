<?php
$filename="../abcàáé\  ñ.123.456.789..333";
echo $filename."<br>";
echo "filter:";
var_dump(filter_var('../abcáññ.123',FILTER_SANITIZE_STRIPPED));
echo "<hr>iconv:";

echo iconv('UTF-8', 'ASCII//IGNORE', $filename);
echo "<hr>";

$sanitized = preg_replace('/[^a-zA-Z0-9\-\._uá]/','', $filename);
var_dump($sanitized);

echo "preg:";

if (function_exists("mb_ereg_replace")) {
	$file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
	$file = mb_ereg_replace("([\.]{2,})", '', $file);
} else {
	$file = preg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
	$file = preg_replace("([\.]{2,})", '', $file);
}


var_dump($file);