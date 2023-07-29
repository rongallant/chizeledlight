<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

include("PHPIncludes/functions.php");

// begin output
if (!isset($page)) $page = 1;
$query = 'select * from ' . $table[2][0] . ' order by ' . $table[2][1][1] . ', ' . $table[2][1][2] . ' DESC';
$calendar = mysql($database, $query);
$num = mysql_numrows($calendar);
$low = (($page*$table[2][3])-$table[2][3]);
$high = (($page*$table[2][3]) > $num)? $num:($page*$table[2][3]);
$bot = 1;
$top = ceil($num/$table[2][3]);
if ($num != 0){
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td' . $class[3] . '>
								<h1>' . $table[2][5] . '</h1>
							</td>
						</tr>
						<tr>
							<td width="10">&nbsp;</td>
							<td>There are ' . $num . ' events in the calendar database:';
	if ($num != 0) echo ($num != 1)? ' Displaying events ' . ($low+1) . ' through ' . $high . ' on page ' . $page . '. ':'  Displaying one event. ';
	echo '</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>Page: ';
	echo ($page == 1)? '&lt;&lt; ':'<a href="' . $PHP_SELF . '?page=' . ($page-1) . '&function=calb"><b>&lt;&lt;</b></a> ';
	while ($bot <= $top){
		echo '[ ';
		echo ($bot == $page)? "$bot":'<a href="' . $PHP_SELF . '?page=' . $bot . '&function=calb"><b>' . $bot . '</b></a>';
		echo ' ]';
	++$bot;}
	echo ($page == $top)? ' &gt;&gt;':' <a href="' . $PHP_SELF . '?page=' . ($page+1) . '&function=calb"><b>&gt;&gt;</b></a>';
	echo '</td>
			</tr>
			<tr>
				<td>';
	$a = $low;
	$b = $low;
	$c = $low;
	while ($a < $high){
		$day = explode ("-", mysql_result($calendar,$a,$table[2][1][1]));
		echo '
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="2" width="100%">
									<tr>
										<td' . $class[1] . ' width="10">&nbsp;</td>
										<td' . $class[3] . '>' . $day[0] . ' - ' . $longmth[abs($day[1])] . '</td>
									</tr>';
		$sday = substr(mysql_result($calendar,$a,$table[2][1][1]), 0, 7);
		while ($sday == substr(mysql_result($calendar,$c,$table[2][1][1]), 0, 7)){
			++$c;
			if ($c == $high) break;
		}
		while ($b < $c){
			$sday = explode ("-", mysql_result($calendar,$b,$table[2][1][1]));
			$eday = explode ("-", mysql_result($calendar,$b,$table[2][1][2]));
			$day = $sday[0] . ' ' . $months[abs($sday[1])] . ' ' . $sday[2];
			if ($sday[0] != $eday[0]){
				$day .= ' to ' . $eday[0] . ' ' . $months[abs($eday[1])] . ' ' . $eday[2];
			} else {
				if ($months[abs($sday[1])] != $months[abs($eday[1])]){
					$day .= ' to ' . $months[abs($eday[1])] . ' ' . $eday[2];
				} else {
					if ($sday[2] != $eday[2]){
						$day .= ' to ' . $eday[2];
					}
				}
			}
			echo '
									<tr>
										<td width="10">&nbsp;</td>
										<td>
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td width="25%"><img src="Images/' . mysql_result($calendar,$b,$table[2][1][9]) . '" width="15" height="10" border="0"> ' . $day . '</td>
													<td width="35%">';
			if (!eregi("@", mysql_result($calendar,$b,$table[2][1][4]))){
				echo (mysql_result($calendar,$b,$table[2][1][4]) == "None currently listed")? html(mysql_result($calendar,$b,$table[2][1][3]), $html):'<a href="' . mysql_result($calendar,$b,$table[2][1][4]) . '" target="_blank">' . html(mysql_result($calendar,$b,$table[2][1][3]), $html) . '</a>';
			} else {
				echo '<a href="' . $mailurl . '?id=' . mysql_result($calendar,$b,$table[2][1][0]) . 'A2A0A3A4">' . html(mysql_result($calendar,$b,$table[2][1][3]), $html) . '</a>';
			}
			if (mysql_result($calendar,$b,$table[2][1][10]) != ""){
				$prog = explode ("-", mysql_result($calendar,$b,$table[2][1][10]));
				echo " <b>(";
				while (list(,$val) = each ($prog)){
					echo " $val";
				}
				echo " )</b>";
			}
			echo '</td>
													<td width="20%">' . stripslashes(mysql_result($calendar,$b,$table[2][1][5])) . '</td>
													<td width="20%">' . stripslashes(mysql_result($calendar,$b,$table[2][1][6])) . ', ' . mysql_result($calendar,$b,$table[2][1][7]) . '</td>
												</tr>';
			if ($b != $c-1){
				echo '
												<tr>
													<td colspan="4"' . $class[5] . '><img src="Images/spacer.gif" width="1" height="1" border="0"></td>
												</tr>';
			}
			echo '
											</table>
										</td>
									</tr>';
		$b++;}
		echo '
								</table>
							</td>
						</tr>
					</table>';
	$a = $b;}
	echo '
				</td>
			</tr>
		</table>';
	if ($legend[0] || $legend[3]){
		include("PHPIncludes/legend.php");
	}
	echo '
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
			</tr>
		</table>' . "\n";
} else {
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td' . $class[3] . '>
								<h1>' . $table[2][5] . '</h1>
							</td>
						</tr>
						<tr>
							<td colspan="2">There are ' . $num . ' events in the calendar database:</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
	if ($legend[0] || $legend[3]){
		include("PHPIncludes/legend.php");
	}
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
			</tr>
		</table>' . "\n";
}
?>