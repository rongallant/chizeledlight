<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

function html($in, $html){
	$out = stripslashes($in);
//	if ($html) $out = htmlspecialchars($out);
	if ($html) $out = htmlentities($out);
	$out = ereg_replace("  ", "&nbsp;&nbsp", $out);
	$out = nl2br($out);
	return $out;
}

function text($val, $true){
	if ($true) $val = preg_replace("/<\/?(html|head|meta|title|body).*>/","",$val);
	$val = ($true)? addslashes($val):stripslashes($val);
	return $val;
}

function selected($a, $b){
	$set = ($a == $b)? "selected":"";
	return $set;
}

?>