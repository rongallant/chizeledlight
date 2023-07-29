<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

include("PHPIncludes/functions.php");

// begin output
if (!isset($page)) $page = 1;
$query = "select * from ".$table[3][0]." order by ".$table[3][1][1]." DESC";
$result = mysql($database, $query);
$num = mysql_numrows($result);
$low = (($page*$table[3][3])-$table[3][3]);
$high = (($page*$table[3][3]) > $num)? $num:($page*$table[3][3]);
$bot = 1;
$top = ceil($num/$table[3][3]);
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td' . $class[3] . '><h1>' . $table[3][5] . '</h1></td>
						</tr>
						<tr>
							<td colspan="2">There are ' . $num . ' records in the ' . $table[3][5] . ' database:';
	if ($num != 0) echo ($num != 1) ?' Displaying records ' . ($low+1) . ' through ' . $high . ' on page ' . $page . '. ':'  Displaying one record. ';
	echo '</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>';
	if ($num != 0){
		echo 'Page: ';
		echo ($page == 1)? '&lt;&lt; ':'<a href="' . $PHP_SELF . '?page=' . ($page-1) . '"><b>&lt;&lt;</b></a> ';
		while ($bot <= $top){
			echo '[ ';
			echo ($bot == $page)? "$bot":'<a href="' . $PHP_SELF . '?page=' . $bot . '"><b>' . $bot . '</b></a>';
			echo ' ]';
		++$bot;}
		echo ($page == $top)? ' &gt;&gt;':' <a href="' . $PHP_SELF . '?page=' . ($page+1) . '"><b>&gt;&gt;</b></a>';
	}
	echo '</td>
			</tr>
			<tr>
				<td>';
	$a = $low;
	while ($a < $high){
		$day = explode ("-", mysql_result($result,$a,$table[3][1][1]));
		echo '
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td' . $class[3] . '>' . $day[0] . ' - ' . $longmth[abs($day[1])] . ' - ' . $day[2] . '</td>
						</tr>
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td>
								<p>' . html(mysql_result($result,$a,$table[3][1][2]), $html) . '</p>
							</td>
						</tr>
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td>	</td>
						</tr>
					</table>';
	$a++;}
	echo '
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>' . "\n";

?>