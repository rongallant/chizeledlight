<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

$sourcetbl = $table[4][0];

$logfile = "../news/log.txt";

if ($action == "add" || $action == "update"){
	$insertarray = array($table[4][1][1] => "", $table[4][1][2] => "", $table[4][1][3] => "", $table[4][1][4] => "");

	// set date
	$insertarray [$table[4][1][1]] = $startyear . "-" . $startmonth . "-" . $startday;
	$insertarray [$table[4][1][2]] = $endyear . "-" . $endmonth . "-" . $endday;
	// set News
	if (isset(${$table[4][1][3]}) && ${$table[4][1][3]} != ""){
		$insertarray [$table[4][1][3]] = text(${$table[4][1][3]}, 1);
	} else {
		$insertarray [$table[4][1][3]] = "News";
	}
	if (isset(${$table[4][1][4]}) && ${$table[4][1][4]} != ""){
		$insertarray [$table[4][1][4]] = text(${$table[4][1][4]}, 1);
	} else {
		$insertarray [$table[4][1][4]] = "None";
	}
}

?>