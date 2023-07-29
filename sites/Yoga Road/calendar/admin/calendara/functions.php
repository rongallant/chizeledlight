<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

function checked($a, $b){
	$set = ($a == $b)? "checked":"";
	return $set;
}

function setvalue($a, $b, $c){
	$set = ($a == $b)? 'value="' . $c . '"':"";
	return $set;
}

function occselected($a, $b, $c, $d){
	$set = ($a == $b && eregi($c, $d))? "selected":"";
	return $set;
}

function subparseocc($subocc, $arr){
	$on = explode("#", substr($subocc, 0, strlen($subocc)-1));
	$subocc = "";
	if ($arr == "dom"){
		while (list($key,$val) = each($on)){
			if ($key == 0){
				$subocc .= date("jS", mktime(0,0,0,1,$val,2000));
			}
			if ($key < count($on)-1 && $key != 0){
				$subocc .= ", " . date("jS", mktime(0,0,0,1,$val,2000));
			}
			if ($key == count($on)-1 && count($on) != 1){
				$subocc .= " and " . date("jS", mktime(0,0,0,1,$val,2000));
			}
		}
	} else {
		if ($arr == "weekdays") $arr = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
		if ($arr == "months") $arr = array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		if ($arr == "order") $arr = array(1=>"First", "Second", "Third", "Fourth", "Last");
		while (list($key,$val) = each($on)){
			while (list($k, $v) = each($arr)){
				if ($key == 0 && $val == $k){
					$subocc .= $v;
				}
				if ($key < count($on)-1 && $key != 0 && $val == $k){
					$subocc .= ", " . $v;
				}
				if ($key == count($on)-1 && $val == $k && count($on) != 1){
					$subocc .= " and " . $v;
				}
			}
			reset($arr);
		}
	}
	return $subocc;
}

function parseoccur($occure){
	$occure = explode ("%", $occure);
	$occure[0] = explode("-", $occure[0]);
	if ($occure[0][2] == "no"){
		$occ = "Once";
	} else {
		$occ = ($occure[0][3] == "yes")? "Ends on: " . date("l, F jS Y", $occure[0][4]) . ". ":"Continuous: ";
		if ($occure[1] == "daya"){
			$occ .= ($occure[2] == "1")? "Every day":"Every " . $occure[2] . " days";
		}
		if ($occure[1] == "dayb"){
			$occ .= "Mon - Fri";
		}
		if ($occure[1] == "week"){
			$occ .= ($occure[2] == "1")? "Every week on ":"Every " . $occure[3] . " weeks on ";
			$occ .= subparseocc($occure[3], "weekdays");
		}
		if ($occure[1] == "montha"){
			$occ .= ($occure[3] == "1")? "Every month on the ":"Every " . $occure[3] . " months on the ";
			$occ .= subparseocc($occure[2], "dom");
		}
		if ($occure[1] == "monthb"){
			$occ .= ($occure[4] == "1")? "Every month on the ":"Every " . $occure[4] . " months on the ";
			$occ .= subparseocc($occure[2], "order");
			$occ .= " ";
			$occ .= subparseocc($occure[3], "weekdays");
		}
		if ($occure[1] == "yeara"){
			$occ .= "Every ";
			$occ .= subparseocc($occure[2], "months");
			$occ .= " on the ";
			$occ .= subparseocc($occure[3], "dom");
		}
		if ($occure[1] == "yearb"){
			$occ .= "Every ";
			$occ .= subparseocc($occure[2], "order");
			$occ .= " ";
			$occ .= subparseocc($occure[3], "weekdays");
			$occ .= " in ";
			$occ .= subparseocc($occure[4], "months");
		}
	}
	return $occ;
}

$sourcetbl = $table[0][0];

if ($action == "add" || $action == "update"){
	$insertarray = array($table[0][1][1] => "", $table[0][1][2] => "", $table[0][1][3] => "", $table[0][1][4] => "", $table[0][1][5] => "", $table[0][1][6] => "", $table[0][1][7] => "", $table[0][1][8] => "", $table[0][1][9] => "");

	// set date
	$insertarray [$table[0][1][1]] = $startyear . "-" . $startmonth . "-" . $startdate;
	$insertarray [$table[0][1][2]] = ($allday == "yes")? "12:00:am":$starthour . ":" . $startmin . ":" . $startmeridian;
	$insertarray [$table[0][1][3]] = ($singleday == "yes" && $endterm != "yes")? $insertarray [$table[0][1][1]]:$endyear . "-" . $endmonth . "-" . $enddate;
	$insertarray [$table[0][1][4]] = ($allday == "yes")? "12:00:pm":$endhour . ":" . $endmin . ":" . $endmeridian;
	// check date
	if (!checkdate ($startmonth, $startdate, $startyear)) {
		$sysmsg .= '<font' . $class[4] . '>Error: Start date is not a calendar day</font>';
		$fail = 1;
	}
	if (!checkdate ($endmonth, $enddate, $endyear)) {
		$sysmsg .= '<font' . $class[4] . '>Error: End date is not a calendar day</font>';
		$fail = 1;
	}
	if (strtotime ("$endmonth/$enddate/$endyear") < strtotime ("$startmonth/$startdate/$startyear")){
		$insertarray [$table[0][1][3]] = $insertarray [$table[0][1][1]];
		$sysmsg .= '<font' . $class[4] . '>Warning: End date is set before start date. End date has been set to the start date.</font>';
//		$fail = 1;
	}
	// set Title
	if (isset(${$table[0][1][5]}) && ${$table[0][1][5]} != ""){
		$insertarray [$table[0][1][5]] = text(${$table[0][1][5]}, 1);
	} else {
		$insertarray [$table[0][1][5]] = "Not listed";
	}
	// set Description
	if (isset(${$table[0][1][6]}) && ${$table[0][1][6]} != ""){
		$insertarray [$table[0][1][6]] = text(${$table[0][1][6]}, 1);
	} else {
		$insertarray [$table[0][1][6]] = "Not listed";
	}
	// set Directions
	if (isset(${$table[0][1][7]}) && ${$table[0][1][7]} != ""){
		$insertarray [$table[0][1][7]] = text(${$table[0][1][7]}, 1);
	} else {
		$insertarray [$table[0][1][7]] = "Not listed";
	}
	// set SiteURL
	if (isset(${$table[0][1][8]}) && ${$table[0][1][8]} != "" && ${$table[0][1][8]} != "None listed"){
		if (!eregi("@", ${$table[0][1][8]})){
			$insertarray [$table[0][1][8]] = (!eregi("http://", ${$table[0][1][8]}))? "http://". ${$table[0][1][8]}:${$table[0][1][8]};
		} else {
			$insertarray [$table[0][1][8]] = ${$table[0][1][8]};
		}
	} else {
		$insertarray [$table[0][1][8]] = "None listed";
	}
	// set Repeat
	$insertarray [$table[0][1][9]] = $singleday . "-" . $allday . "-" . $enablerep . "-" . $endterm . "-" . mktime (0,0,0,$endbymonth,$endbydate,$endbyyear) . "%" . $repeat . "%";
	if ($repeat == "daya"){
		$insertarray [$table[0][1][9]] .= $dayaa;
	}
	if ($repeat == "week"){
		$insertarray [$table[0][1][9]] .= $weekaa . "%";
		if (is_array($weekab)){
			while(list(,$val) = each ($weekab)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
	}
	if ($repeat == "montha"){
		if (is_array($monthaa)){
			while(list(,$val) = each($monthaa)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
		$insertarray [$table[0][1][9]] .= "%" . $monthab;
	} 
	if ($repeat == "monthb"){
		if (is_array($monthba)){
			while(list(,$val) = each($monthba)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
		$insertarray [$table[0][1][9]] .= "%";
		if (is_array($monthbb)){
			while(list(,$val) = each($monthbb)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
		$insertarray [$table[0][1][9]] .= "%" . $monthbc;
	}
	if ($repeat == "yeara"){
		if (is_array($yearaa)){
			while(list(,$val) = each($yearaa)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
		$insertarray [$table[0][1][9]] .= "%";
		if (is_array($yearab)){
			while(list(,$val) = each($yearab)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
	} 
	if ($repeat == "yearb"){
		if (is_array($yearba)){
			while (list(,$val) = each($yearba)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
		$insertarray [$table[0][1][9]] .= "%";
		if (is_array($yearbb)){
			while (list(,$val) = each($yearbb)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
		$insertarray [$table[0][1][9]] .= "%";
		if (is_array($yearbc)){
			while (list(,$val) = each($yearbc)){
				$insertarray [$table[0][1][9]] .= $val . "#";
			}
		}
	}
}

?>