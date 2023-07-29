<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

include("PHPIncludes/functions.php");

// begin output
if (!isset($function)) $function = "list";
if ($function == "list"){
	$query = "select * from " . $table[1][0];
	$calendar = mysql($database, $query);
	$num = mysql_numrows($calendar);
	$date = explode("-", mysql_result($calendar,0,$table[1][1][1]));
	if (!isset($month)){$month = $date[1];}
	if (!isset($year)){$year = $date[0];}
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="98%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td' . $class[3] . '><h1>' . $table[0][5] . '</h1></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td' . $class[6] . '>&nbsp;';
	$a = 0;
	while ($a < $table[1][3]){
		$Y = date(Y, mktime(0,0,0,$date[1]+$a,1,$date[0]));
		$m = date(m, mktime(0,0,0,$date[1]+$a,1,$date[0]));
		echo ($Y == $year && $m == $month)? "[ " . $longmth[abs($m)] . " ]":'[ <a href="' . $PHP_SELF . '?year=' . $Y . '&month=' . $m . '&function=list"><b>' . $longmth[abs($m)] . '</b></a> ]';
	$a++;}
	echo '</td>
			</tr>
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="2" width="100%">
									<tr>
										<td' . $class[1] . ' width="10">&nbsp;</td>
										<td' . $class[3] . '>' . $year . ' - ' . $longmth[abs($month)] . '</td>
									</tr>
									<tr>
										<td' . $class[1] . ' width="10">&nbsp;</td>
										<td>
											<table border="0" cellpadding="4" cellspacing="0" width="100%">
												<tr' . $class[6] . '>
													<td width="14%" align="center"><b>Sunday</b></td>
													<td width="14%" align="center"><b>Monday</b></td>
													<td width="14%" align="center"><b>Tuesday</b></td>
													<td width="14%" align="center"><b>Wednesday</b></td>
													<td width="14%" align="center"><b>Thursday</b></td>
													<td width="14%" align="center"><b>Friday</b></td>
													<td width="14%" align="center"><b>Saturday</b></td>
												</tr>';
			$fd = date(w, mktime(0,0,0,$month,1,$year));
			$ld = date(t, mktime(0,0,0,$month,1,$year));
			$i = 0;
			$w = 1;
			while ($w <= 6){
				$d = 0;
				echo '
												<tr>';
				while ($d <=6){
					if ($i >= $fd && $i <= $ld+$fd-1){
						$day = $i - $fd + 1;
						settype ($day, "string");
						$day = (strlen($day) == 1)? "0$day":$day;
						echo '
													<td width="14%" valign="top"' . $class[6] . '><img src="Images/spacer.gif" width="1" height="70" border="0" align="left"><i>' . $day . '</i>';
						$query = "select * from " . $table[1][0] . " where " . $table[1][1][1] . "='" . $year . "-" . $month . "-" . $day . "'";
						$calendar = mysql($database, $query);
						$event = mysql_result($calendar,0,$table[1][1][4]);
						if ($event != ""){
							$event = explode ("-", substr($event, 0, strlen($event)-1));
							while (list(,$val) = each ($event)){
								$query = "select * from " . $table[0][0] . " where " . $table[0][1][0] . "='$val'";
								$select = mysql($database, $query);
								echo '<br><a href="' . $PHP_SELF . '?function=view&id=' . $val . '&year=' . $year . '&month=' . $month . '&day=' . $day .'">' . stripslashes(mysql_result($select,0,$table[0][1][5])) . '</a><br>';
								mysql_freeresult($select);
							}
						}
						echo '</td>';
					} else {
						echo '
													<td width="14%"' . $class[0] . '><img src="Images/spacer.gif" width="1" height="1" border="0"></td>';
					}
				$i++;
				$d++;}
				echo '
												</tr>';
			$w++;}
			echo '
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>' . "\n";
}

if ($function=="view"){
	$query = 'select * from ' . $table[0][0] . ' where ' . $table[1][1][0] . "='$id'";
	$calendar = mysql($database, $query);
	$sday = explode("-", mysql_result($calendar,0,$table[0][1][1]));
	$stime = explode(":", mysql_result($calendar,0,$table[0][1][2]));
	$eday = explode("-", mysql_result($calendar,0,$table[0][1][3]));
	$etime = explode(":", mysql_result($calendar,0,$table[0][1][4]));
	$repeat = explode("%", mysql_result($calendar,0,$table[0][1][9]));
	$repeat[0] = explode("-", $repeat[0]);

	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td' . $class[1] . ' width="10">&nbsp;</td>
				<td' . $class[3] . '>&nbsp;' . html(mysql_result($calendar,0,$table[0][1][5]), $html) . '</td>
			</tr>
			<tr>
				<td' . $class[1] . ' width="10"></td>
				<td' . $class[2] . '>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td valign="top">
								<table border="0" cellpadding="0" cellspacing="10">
									<tr>';
	if ($repeat[0][2] == "no"){
	echo '
										<td><b>Start:</b></td>
										<td nowrap><i>' . $longmth[abs($sday[1])] . '-' . $sday[2] . '<br>' . $stime[0] . ':' . $stime[1] . ' ' . $stime[2] . ' </td>
									</tr>
									<tr>
										<td><b>End:</b></td>
										<td nowrap><i>' . $longmth[abs($eday[1])] . '-' . $eday[2] . '<br>' . $etime[0] . ':' . $etime[1] . ' ' . $etime[2] . ' </td>';
	} else {
	echo '
										<td><b>Start:</b></td>
										<td nowrap><i>' . $longmth[abs($month)] . '-' . $day . '<br>' . $stime[0] . ':' . $stime[1] . ' ' . $stime[2] . ' </td>
									</tr>
									<tr>
										<td><b>End:</b></td>
										<td nowrap><i>' . $longmth[abs($month)] . '-' . $day . '<br>' . $etime[0] . ':' . $etime[1] . ' ' . $etime[2] . ' </td>';
	}
	echo '
									</tr>
								</table>
							</td>
							<td valign="top"><i>' . $table[0][6] . ':</i><br>' . html(mysql_result($calendar,0,$table[0][1][6]), $html) . '
								<p><i>' . $table[0][7] . ':</i><br>' . html(mysql_result($calendar,0,$table[0][1][7]), $html) . '</p>';
	if (!eregi("@", mysql_result($calendar,0,$table[0][1][8]))){
		echo '
								<p><i>Web Site:</i><br>';
		echo (mysql_result($calendar,0,$table[0][1][8]) == "None listed")? mysql_result($calendar,0,$table[0][1][8]):'<a href="' . mysql_result($calendar,0,$table[0][1][8]) . '">' . mysql_result($calendar,0,$table[0][1][8]) . '</a>';
	} else {
		echo '
								<p><i>Contact email:</i><br>';
		echo '<a href="' . $mailurl . '?id=' . mysql_result($calendar,0,$table[0][1][0]) . 'A0A0A5A8">Contact form for ' . mysql_result($calendar,0,$table[0][1][5]) . '</a>';
	}
	echo '</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td' . $class[1] . ' width="10">&nbsp;</td>
				<td' . $class[2] . '>&nbsp;<a href="' . $PHP_SELF . '?function=list&year=' . $year . '&month=' . $month . '">&lt;&lt; Back to ' . $longmth[abs($month)] . '</a></td>
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
			</tr>
		</table>' . "\n";
}

?>