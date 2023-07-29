<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

function checked($a, $b){
	$set = ($a == $b)? " checked":"";
	return $set;
}

$sourcetbl = $table[2][0];

if ($action == "add" || $action == "update"){
	$insertarray = array($table[2][1][1] => "", $table[2][1][2] => "", $table[2][1][3] => "", $table[2][1][4] => "", $table[2][1][5] => "", $table[2][1][6] => "", $table[2][1][7] => "", $table[2][1][8] => "", $table[2][1][9] => "", $table[2][1][10] =>"");

	// set date
	$insertarray [$table[2][1][1]] = $startyear . "-" . $startmonth . "-" . $startday;
	$insertarray [$table[2][1][2]] = $endyear . "-" . $endmonth . "-" . $endday;
	// set Title
	if (isset(${$table[2][1][3]}) && ${$table[2][1][3]} != ""){
		$insertarray [$table[2][1][3]] = text(${$table[2][1][3]}, 1);
	} else {
		$insertarray [$table[2][1][3]] = "None currently listed";
	}
	// set SiteURL
	if (isset(${$table[2][1][4]}) && ${$table[2][1][4]} != "" && ${$table[2][1][4]} != "None currently listed"){
		if (!eregi("@", ${$table[2][1][4]})){
			$insertarray [$table[2][1][4]] = (!eregi("http://", ${$table[2][1][4]}))? "http://". ${$table[2][1][4]}:${$table[2][1][4]};
		} else {
			$insertarray [$table[2][1][4]] = ${$table[2][1][4]};
		}
	} else {
		$insertarray [$table[2][1][4]] = "None currently listed";
	}
	// set HostGroup
	if (isset(${$table[2][1][5]}) && ${$table[2][1][5]} != ""){
		$insertarray [$table[2][1][5]] = text(${$table[2][1][5]}, 1);
	} else {
		$insertarray [$table[2][1][5]] = "None currently listed";
	}
	// set City
	if (isset(${$table[2][1][6]}) && ${$table[2][1][6]} != ""){
		$insertarray [$table[2][1][6]] = text(${$table[2][1][6]}, 1);
	} else {
		$insertarray [$table[2][1][6]] = "None currently listed";
	}
	// set State
	if (isset(${$table[2][1][7]}) && ${$table[2][1][7]} != ""){
		$insertarray [$table[2][1][7]] = ${$table[2][1][7]};
	}
	// set Notes
	if (isset(${$table[2][1][8]}) && ${$table[2][1][8]} != ""){
		$insertarray [$table[2][1][8]] = text(${$table[2][1][8]}, 1);
	} else {
		$insertarray [$table[2][1][8]] = "None";
	}
	// set image legend
	if (isset(${$table[2][1][9]}) && ${$table[2][1][9]} != ""){
		$insertarray [$table[2][1][9]] = ${$table[2][1][9]};
	} else {
		$insertarray [$table[2][1][9]] = "";
	}
	// set text legend
	if (isset(${$table[2][1][10]}) && is_array(${$table[2][1][10]}) && $legend[3] == 1){
		while(list(,$val) = each (${$table[2][1][10]})){
			$insertarray [$table[2][1][10]] .= "$val-";
		}
		$insertarray [$table[2][1][10]] = substr($insertarray [$table[2][1][10]], 0, strlen($insertarray [$table[2][1][10]])-1);
	} else {
		$insertarray [$table[2][1][10]] .= "";
	}
}

?>