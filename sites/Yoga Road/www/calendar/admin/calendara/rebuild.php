<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.
// include ("/home/greghenl/lightwavesgraphics-www/Calendar/PHPIncludes/setup.php");

function updatetable($a, $b, $c, $d, $e, $f){
	$query = 'update ' . $d . ' set ' . $e . '="' . $a . $b . '-" where ' . $f . '=' . $c;
	if (!ereg("^($b-)|(-$b-)", $a)) return (mysql_query($query))? "Update sucessful at $c<br>MySQL Query = <i>$query</i>\n":"<b>Update failed at $c</b><br>MySQL Query = <i>$query</i>\n";
}

// purge current data
$query = "delete from " . $table[1][0];
if (!mysql_query($query)){
	$sysmsg = '<font' . $class[4] . '>Error: Database purge failed</font><br>';
}

// rebuild base
$L = mktime (0,0,0,date(n),1, date("Y"));
$H = mktime (0,0,0, date(n)+$table[1][3],1,date("Y"));

$l = $L;
while ($l <= $H){
	$fields = $table[1][1][0] . ", " . $table[1][1][1] . ", " . $table[1][1][2] . ", " . $table[1][1][3] . ", " . $table[1][1][4];
	$d = date(j, $l);
	$w = date(w, $l);
	if ($d==1){$o=1;$t=$w;}
	if ($w==$t && $d!=1) ++$o;
	$insertval = '"", "' . date("Y-m-d", $l) . '", "' . $w . '", "' . $o . '", ""';
	$query = "INSERT INTO " . $table[1][0] . " ($fields) VALUES ($insertval)";
	if (mysql_query($query)){
		$sysmsg = " Database rebuild succeeded.";
	} else {
		$sysmsg .= ' <font' . $class[4] . '>Error: Database rebuild failed.</font><br>';
	}
$l += 86400;}

// update events
$fields = $table[0][1][0]. ", " . $table[0][1][1]. ", " . $table[0][1][3] . ", " . $table[0][1][9];
$query = "select $fields from " . $table[0][0];
$calendar = mysql($database, $query);

$query = "select * from " . $table[1][0];
$update = mysql($database, $query);

$a = explode("-", mysql_result($update,0,$table[1][1][1]));
$La = mktime (0,0,0,$a[1],$a[2],$a[0]);
$a = explode("-", mysql_result($update,mysql_numrows($update)-1,$table[1][1][1]));
$Ha = mktime (0,0,0,$a[1],$a[2],$a[0]);

while ($event = mysql_fetch_row ($calendar)){
	$id = $event[0];
	$a = explode("-", $event[1]);
	$Lb = mktime (0,0,0,$a[1],$a[2],$a[0]);
	$a = explode("-", $event[2]);
	$Hb = mktime (0,0,0,$a[1],$a[2],$a[0]);
	$event[3] = explode("%", $event[3]);
	$event[3][0] = explode("-", $event[3][0]);
	if ($event[3][0][2] == "no"){
		$l = $Lb;
		$h = $Hb;
		while ($l <= $h){
			$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . date("Y-m-d", $l) . "'";
			$insert = mysql($database, $query);
			if (mysql_numrows($update) && $l >=$La && $l <= $Ha){
				$syslog .= updatetable(mysql_result($insert,0,$table[1][1][4]), $id, mysql_result($insert,0,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
			}
			mysql_free_result ($insert);
			$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));
		}
	} else {
		if ($event[3][1] == "daya"){
			unset($a);
			$l = $Lb;
			$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
			while ($l <= $h){
				$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . date("Y-m-d", $l) . "'";
				$insert = mysql($database, $query);
				if (mysql_numrows($insert)){
					$syslog .= updatetable(mysql_result($insert,0,$table[1][1][4]), $id, mysql_result($insert,0,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
				}
				mysql_free_result ($insert);
				if ($event[3][0][0] == "yes"){
					$l = mktime(0,0,0,date(n, $l),date(j, $l)+$event[3][2],date(Y, $l));
				} else {
					if (!isset($a)) $a = $l;
					if (($l >= $a + $Hb - $Lb) || ($l >= mktime(0,0,0,date(n, $a),date(j, $a)+$event[3][2],date(Y, $a)))){
						$l = mktime(0,0,0,date(n, $a),date(j, $a)+$event[3][2],date(Y, $a));
						unset($a);
					} else {
						$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));
					}
				}
			}
		}
		if ($event[3][1] == "dayb"){
			unset($a);
			$l = $Lb;
			$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
			while ($l <= $h){
				$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . date("Y-m-d", $l) . "'";
				$insert = mysql($database, $query);
				if (mysql_numrows($insert) && !ereg("[06]", mysql_result($insert,0,$table[1][1][2]))){
					$syslog .= updatetable(mysql_result($insert,0,$table[1][1][4]), $id, mysql_result($insert,0,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
				}
				mysql_free_result ($insert);
				$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));
			}
		}
		if ($event[3][1] == "week"){
			unset($a);
			unset($b);
			$event[3][3] = explode ("#", substr($event[3][3], 0, strlen($event[3][3])-1));
			$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
			while (list(,$val) = each ($event[3][3])){
				$l = (isset($b))? $b:$Lb;
				while ($l <= $h){
					if (date(w,$l) == $val){
						$b = $l;
					break;}
				$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));}
				while ($l <= $h){
					$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . date("Y-m-d", $l) . "'";
					$insert = mysql($database, $query);
					if (mysql_numrows($insert)){
						$syslog .= updatetable(mysql_result($insert,0,$table[1][1][4]), $id, mysql_result($insert,0,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
					}
					mysql_free_result ($insert);
					if ($event[3][0][0] == "yes"){
						$l = mktime(0,0,0,date(n, $l),date(j, $l)+(7 * $event[3][2]),date(Y, $l));
					} else {
						if (!isset($a)) $a = $l;
						if (($l >= $a + $Hb - $Lb) || ($l >= mktime(0,0,0,date(n, $a),date(j, $a)+(7 * $event[3][2]),date(Y, $a)))){
							$l = mktime(0,0,0,date(n, $a),date(j, $a)+(7 * $event[3][2]),date(Y, $a));
							unset($a);
						} else {
							$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));
						}
					}
				}
			}
		}
		if ($event[3][1] == "montha"){
			$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
			$event[3][2] = explode ("#", substr($event[3][2], 0, strlen($event[3][2])-1));
			while (list(,$val) = each ($event[3][2])){
				unset($a);
				$l = mktime(0,0,0,date(n, $Lb),abs($val),date(Y, $Lb));
				while ($l <= $h){
					$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . date("Y-m-d", $l) . "'";
					$insert = mysql($database, $query);
					if (mysql_numrows($insert)){
						$syslog .= updatetable(mysql_result($insert,0,$table[1][1][4]), $id, mysql_result($insert,0,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
					}
					mysql_free_result ($insert);
					if ($event[3][0][0] == "yes"){
						$l = mktime(0,0,0,date(n, $l)+$event[3][3],date(j, $l),date(Y, $l));
					} else {
						if (!isset($a)) $a = $l;
						if (($l >= $a + $Hb - $Lb) || ($l >= mktime(0,0,0,date(n, $a)+$event[3][3],date(j, $a),date(Y, $a)))){
							$l = mktime(0,0,0,date(n, $a)+$event[3][3],date(j, $a),date(Y, $a));
							unset($a);
						} else {
							$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));
						}
					}
				}
			}
		}
		if ($event[3][1] == "monthb"){
			$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
			$event[3][2] = explode ("#", substr($event[3][2], 0, strlen($event[3][2])-1));
			$event[3][3] = explode ("#", substr($event[3][3], 0, strlen($event[3][3])-1));
			while (list(,$oval) = each($event[3][2])){
				while (list(,$wval) = each($event[3][3])){
					$query = "select * from " . $table[1][0] . " where " . $table[1][1][2] . "=" . $wval . " && " . $table[1][1][3] . "=";
					$insert = ($oval == 5 && mysql_numrows(mysql_query($query . "6")) != 0)? mysql($database, $query . "6"):mysql($database, $query . $oval);
					$a = 0;
					while ($a < mysql_numrows($insert)){
						$l = explode("-", mysql_result($insert,$a,$table[1][1][1]));
						$l = mktime(0,0,0,$l[1],$l[2],$l[0]);
						if ($l >= $Lb && $l <= $h){
							$syslog .= updatetable(mysql_result($insert,$a,$table[1][1][4]), $id, mysql_result($insert,$a,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
						}
						$a += $event[3][4];
					}
					mysql_free_result ($insert);
				}
				reset($event[3][3]);
			}
		}
		if ($event[3][1] == "yeara"){
			$event[3][2] = explode ("#", substr($event[3][2], 0, strlen($event[3][2])-1));
			$event[3][3] = explode ("#", substr($event[3][3], 0, strlen($event[3][3])-1));
			while (list(,$m) = each($event[3][2])){
				while (list(,$d) = each($event[3][3])){
					unset($a);
					$l = mktime(0,0,0,$m,$d,date("Y", $Lb));
					$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
					while ($l <= $h){
						$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . date("Y-m-d", $l) . "'";
						$insert = mysql($database, $query);
						if (mysql_numrows($insert)){
							$syslog .= updatetable(mysql_result($insert,0,$table[1][1][4]), $id, mysql_result($insert,0,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
						}
						mysql_free_result ($insert);
						if ($event[3][0][0] == "yes"){
							$l = mktime(0,0,0,$m,$d,date(Y, $l)+1);
						} else {
							if (!isset($a)) $a = $l;
							if (($l >= $a + $Hb - $Lb) || ($l >= mktime(0,0,0,$m,$d,date(Y, $a)+1))){
								$l = mktime(0,0,0,date(n, $a),date(j, $a),date(Y, $a)+1);
								unset($a);
							} else {
								$l = mktime(0,0,0,date(n, $l),date(j, $l)+1,date(Y, $l));
							}
						}
					}
				}
				reset($event[3][3]);
			}
		}
		if ($event[3][1] == "yearb"){
			$h = ($event[3][0][3] == "yes")? $event[3][0][4]:$Ha;
			$event[3][2] = explode ("#", substr($event[3][2], 0, strlen($event[3][2])-1));
			$event[3][3] = explode ("#", substr($event[3][3], 0, strlen($event[3][3])-1));
			$event[3][4] = explode ("#", substr($event[3][4], 0, strlen($event[3][4])-1));
			while (list(,$o) = each($event[3][2])){
				while (list(,$w) = each($event[3][3])){
					while (list(,$m) = each($event[3][4])){
						$query = "select * from " . $table[1][0] . " where " . $table[1][1][2] . "='" . $w . "' && " . $table[1][1][3] . "=";
						$insert = ($o == 5 && mysql_numrows(mysql_query($query . "6")) != 0)? mysql($database, $query . "6"):mysql($database, $query . $o);
						$a = 0;
						while ($a < mysql_numrows($insert)){
							$l = explode("-", mysql_result($insert,$a,$table[1][1][1]));
							$l = mktime(0,0,0,$l[1],$l[2],$l[0]);
							if (date(n, $l) == $m && $l >= $Lb && $l <= $h){ // 
								$syslog .= updatetable(mysql_result($insert,$a,$table[1][1][4]), $id, mysql_result($insert,$a,$table[1][1][0]), $table[1][0], $table[1][1][4], $table[1][1][0]);
							}
							++$a;
						}
						mysql_free_result ($insert);
					}
					reset($event[3][4]);
				}
				reset($event[3][3]);
			}
		}
	}
}

?>