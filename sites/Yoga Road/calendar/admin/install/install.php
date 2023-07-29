<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

require("../../PHPIncludes/setup.php");

$a = 0;
while ($a < count($table)){
	$tbl = $table[$a][0];
	if (mysql($database, "select * from $tbl")){
		echo "$tbl already exists<br>";
	} else {
		$query = $table[$a][2];
		if (mysql_query($query)){
			echo "$tbl created<br>by: $query<br>";
		} else {
			echo "$tbl doesn't exist and could not be installed<br>";
		}
	}
$a++;}
?>