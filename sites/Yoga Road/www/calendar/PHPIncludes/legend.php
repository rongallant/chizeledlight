<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

$a = $legend[0] + $legend[3];

echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td colspan="' . $a . '"' . $class[5] . '><img src="Images/spacer.gif" width="1" height="1" border="0"></td>
			</tr>
			<tr>';
if ($legend[0]){
	echo '
				<td width="' . abs(100/$a) . '%" valign="top">
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td><b>' . $legend[1] . '</b></td>
						</tr>';
	while (list($key, $val) = each($legend[2])){
		echo '
						<tr>
							<td><img src="Images/' . $key . '" width="15" height="10" border="0"> - ' . $val . '.</td>
						</tr>';
	}
	reset($legend[2]);
	echo '
					</table>
				</td>';
}
if ($legend[3]){
	echo '
				<td width="' . abs(100/$a) . '%" valign="top">
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td><b>' . $legend[4] . '</b></td>
						</tr>';
	while (list($key, $val) = each($legend[5])){
		echo '
						<tr>
							<td><b>(' . $key . ')</b> ' . $val . '</td>
						</tr>';
	}
	reset($legend[5]);
	echo '
					</table>
				</td>';
}
echo "
			</tr>
		</table>\n";
?>