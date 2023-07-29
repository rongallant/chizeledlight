<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

echo '
<table border="0" cellpadding="0" cellspacing="2" width="100%">
<tr><td>
<table border="0" cellpadding="0" cellspacing="2" width="100%">
<tr>
<td' . $class[1] . ' width="10">&nbsp;</td>
<td' . $class[3] . '>Optimize Calendar</td>
</tr><tr>
<td width="10"></td>
<td>';

$a = 0;
while ($a < count($table)){
	$tbl = $table[$a][0];
	if (mysql($database, "OPTIMIZE TABLE $tbl")){
		echo "$tbl optmized<br>";
	} else {
		echo "$tbl doesn't exist and could not be optimized<br>";
	}
$a++;}

echo '
</td></tr>
</table>
</td></tr>
</table>';
?>