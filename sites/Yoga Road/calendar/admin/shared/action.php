<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

$success = 0;
if ($action == "add" && $fail != 1){
	$fields = $table[0][1][0];
	$insertval = "\"\"";
	while (list($key, $val) = each($insertarray)){
		$insertval .= ", \"" . $val . "\"";
		$fields .= ", " . $key;
	}
	$query = "INSERT INTO $sourcetbl ($fields) VALUES ($insertval)";
	if (mysql_query($query)){
		$sysmsga = 'Addition to the database succeeded';
		$success = 1;
	} else {
		$sysmsga = '<font' . $class[4] . '>Error: Addition to the database failed<br>' . $query . '</font>';
	}
	$action = "view";
} else {
	if (isset($fail)) $action = "add";
}

if ($action == "update" && $fail != 1){
	while (list($key, $val) = each($insertarray)){
		$update .= $key . '="' . $val . '", ';
	}
	$update = substr($update, 0, strlen($update)-2);
	$query = "update $sourcetbl set $update where $sourceid='$id'";
	if(mysql_query($query)){
		$sysmsga = 'Record updated';
		$success = 1;
	} else {
		$sysmsga = '<font' . $class[4] . '>Error: Record update failed<br>' . $query . '</font>';
	}
	$action = "view";
} else {
	if (isset($fail)) $action = "edit";
}

if ($action == "delete"){
	$query = "delete from $sourcetbl where $sourceid='$id'";
	if (mysql_query($query)){
		$sysmsga = 'Record deleted';
		$success = 1;
	} else {
		$sysmsga = '<font' . $class[4] . '>Error: Record deletion failed<br>' . $query . '</font>';
	}
	$action = "view";
}

//if ($success == 1){
//	$log = date("D, d M Y H:i:s");
//	$file = fopen ($logfile, "a+");
//	fputs ($file, $log);
//	fclose($logfile);
//}

setcookie ("sysmsgc", $sysmsgb);
setcookie ("sysmsgb", $sysmsga);

?>