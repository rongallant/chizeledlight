<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

// begin output
if (!isset($page)) $page = 1;
if (!isset($action)) $action = "view";
if ($action == "view"){
	$query = "select * from $sourcetbl order by " . $table[3][1][1] . " DESC";
	$minutes = mysql($database, $query);
	$num = mysql_numrows($minutes);
	$low = (($page*$table[3][3])-$table[3][3]);
	$high = (($page*$table[3][3]) > $num)? $num:($page*$table[3][3]);
	$bot = 1;
	$top = ceil($num/$table[3][3]);
} else {
	$query = "select * from $sourcetbl where " . $table[3][1][0] . "='$id'";
	$minutes = mysql($database, $query);
}

if ($action=="view"){
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="98%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="98%">
						<tr>
							<td>There are ' . $num . ' records in the ' . $table[3][5] . ' database:';
	if ($num != 0) echo ($num != 1) ?' Displaying events ' . ($low+1) . ' through ' . $high . '. ':'  Displaying one event. ';
	echo '</td>
							<td width="110" align="center"><a href="' . $PHP_SELF . '?action=new&function=evnt&page=' . $page . '"><img src="images/' . $cssstyle . '.add.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>';
	if ($num != 0){
		$adv = 'Page: ';
		$adv .= ($page == 1)? '<b>&lt;&lt; ':'<b><a href="' . $PHP_SELF . '?page=' . ($page-1) . '&function=evnt">&lt;&lt;</a> ';
		while ($bot <= $top){
			$adv .= '</b>[ <b>';
			$adv .= ($bot == $page)? "$bot":'<a href="' . $PHP_SELF . '?page=' . $bot . '&function=evnt">' . $bot . '</a>';
			$adv .= '</b> ]<b>';
		++$bot;}
		$adv .= ($page == $top)? ' &gt;&gt;</b>':' <a href="' . $PHP_SELF . '?page=' . ($page+1) . '&function=evnt">&gt;&gt;</a></b>';
	}
	echo $adv . '</td>
			</tr>
			<tr>
				<td>';
	$a = $low;
	while ($a < $high){
		$day = explode ("-", mysql_result($minutes,$a,$table[3][1][1]));
		echo '
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td' . $class[3] . '>' . $day[0] . ' - ' . $months[abs($day[1])] . ' - ' . $day[2] . '</td>
						</tr>
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td>
								<p>' . html(mysql_result($minutes,$a,$table[3][1][2]), $html) . '</p>
							</td>
						</tr>
						<tr>
							<td' . $class[1] . ' width="10">&nbsp;</td>
							<td>
								<table border="0" cellpadding="0" cellspacing="2" width="220">
									<tr>
										<td width="110" align="center"><a href="' . $PHP_SELF . '?action=delete&sourceid=' . $table[3][1][0] . '&id=' . mysql_result($minutes,$a,$table[3][1][0]) . '&function=evnt&page=' . $page . '"><img src="images/' . $cssstyle . '.delete.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
										<td width="110" align="center"><a href="' . $PHP_SELF . '?action=edit&id=' . mysql_result($minutes,$a,$table[3][1][0]) . '&function=evnt&page=' . $page . '" ><img src="images/' . $cssstyle . '.edit.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>';
	$a++;}
	echo '
				</td>
			</tr>
			<tr>
				<td>' . $adv . '</td>
			</tr>
		</table>';
}

if ($action=="new"){
	echo '
		<form name="Add" action="' . $PHP_SELF. '" method="post" target="_self">
			<table border="0" cellpadding="0" cellspacing="2" width="98%">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="2" width="98%">
							<tr>
								<td>Add a new record to ' . $table[3][5] . '.</td>
								<td width="110" align="center"><input type="image" src="images/' . $cssstyle . '.add.gif" width="' . $buttonw . '" height="' . $buttonh . '" name="submit"></td>
								<td width="110" align="center"><a href="' . $PHP_SELF . '?action=view&function=evnt&page=' . $page . '"><img src="images/' . $cssstyle . '.cancel.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="2" width="100%">
							<tr>
								<td' . $class[1] . ' width="10">&nbsp;</td>
								<td' . $class[3] . '>&nbsp;</td>
							</tr>
							<tr>
								<td' . $class[1] . ' width="10">&nbsp;</td>
								<td><select name="year" size="1">';
	$a = $thisyear;
	while ($a <= $thisyear+$yearinc){
		echo '
																								<option value="' . $a .'">' . $a . '</option>';
	++$a;}
	echo '
																					</select><select name="month" size="1">';
	$a = 1;
	while (list($key, $val) = each($months)){
		echo '
																								<option value="' . $key . '">' . $val . '</option>';
	}
	reset($months);
	echo '
																					</select><select name="day" size="1">';
	$a = 1;
	while ($a <= 31){
		settype($a, "string");
		$a = (strlen($a) == 1)? "0" . $a: $a;
		echo '
																								<option value="' . $a . '">' . $a . '</option>';
		settype($a, "integer");
	++$a;}
	echo '

								</td>
							</tr>
							<tr>
								<td' . $class[1] . ' width="10">&nbsp;</td>
								<td>' . $table[3][5] . ':<br><textarea name="' . $table[3][1][2] . '" cols="80" rows="10" wrap="virtual"></textarea></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="hidden" value="add" name="action"><input type="hidden" value="evnt" name="function"><input type="hidden" value="' . $page . '" name="page">
		</form>' . "\n";
}

if ($action == "edit"){
	$insertarray = mysql_fetch_array($minutes);
	$day = explode ("-", $insertarray[$table[3][1][1]]);

	echo '
		<form name="Edit" action="' . $PHP_SELF. '" method="post" target="_self">
			<table border="0" cellpadding="0" cellspacing="2" width="98%">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="2" width="98%">
							<tr>
								<td>Edit a record in ' . $table[3][5] . '</td>
								<td width="110" align="center"><input type="image" src="images/' . $cssstyle . '.update.gif" width="' . $buttonw . '" height="' . $buttonh . '" name="submit"></td>
								<td width="110" align="center"><a href="' . $PHP_SELF . '?action=view&function=evnt&page=' . $page . '"><img src="images/' . $cssstyle . '.cancel.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="2" width="100%">
							<tr>
								<td' . $class[1] . ' width="10">&nbsp;</td>
								<td' . $class[3] . '>&nbsp;</td>
							</tr>
							<tr>
								<td' . $class[1] . ' width="10">&nbsp;</td>
								<td><select name="year" size="1">';
	$a = $thisyear;
	while ($a <= $thisyear+$yearinc){
		echo '
																								<option value="' . $a .'" ' . selected($a, $day[0]) . '>' . $a . '</option>';
	++$a;}
	echo '
																					</select><select name="month" size="1">';
	$a = 1;
	while (list($key, $val) = each($months)){
		echo '
																								<option value="' . $key . '" ' . selected($key, $day[1]) . '>' . $val . '</option>';
	}
	reset($months);
	echo '
																					</select><select name="day" size="1">';
	$a = 1;
	while ($a <= 31){
		settype($a, "string");
		$a = (strlen($a) == 1)? "0" . $a: $a;
		echo '
																								<option value="' . $a . '" ' . selected($a, $day[2]) . '>' . $a . '</option>';
		settype($a, "integer");
	++$a;}
	echo '

								</td>
							</tr>
							<tr>
								<td' . $class[1] . ' width="10">&nbsp;</td>
								<td>' . $table[3][5] . ':<br><textarea name="' . $table[3][1][2] . '" cols="80" rows="10" wrap="virtual">' . text($insertarray [$table[3][1][2]], 0) . '</textarea></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="hidden" value="update" name="action"><input type="hidden" value="evnt" name="function"><input type="hidden" value="' . $table[3][1][0] . '" name="sourceid"><input type="hidden" value="' . $insertarray [$table[3][1][0]] . '" name="id"><input type="hidden" value="' . $page . '" name="page">
		</form>' . "\n";
}

?>