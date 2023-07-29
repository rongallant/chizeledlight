<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

$sourcetbl = $table[3][0];

$logfile = "../minutes/log.txt";

if ($action == "add" || $action == "update"){
	$insertarray = array($table[3][1][1] => "", $table[3][1][2] => "");

	// set date
	$insertarray [$table[3][1][1]] = $year . "-" . $month . "-" . $day;
	// set Content
	if (isset(${$table[3][1][2]}) && ${$table[3][1][2]} != ""){
		$insertarray [$table[3][1][2]] = text(${$table[3][1][2]}, 1);
	} else {
		$insertarray [$table[3][1][2]] = "None";
	}
}

?>