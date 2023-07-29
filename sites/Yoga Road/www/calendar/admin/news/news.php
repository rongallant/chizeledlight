<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

// begin output
if (!isset($page)) $page = 1;
if (!isset($action)) $action = "view";
if ($action == "view"){
	$query = "select * from " . $table[4][0] . " order by " . $table[4][1][1] . ", " . $table[4][1][2] . " DESC";
	$info = mysql($database, $query);
	$num = mysql_numrows($info);
	$low = (($page*$table[4][3])-$table[4][3]);
	$high = (($page*$table[4][3]) > $num)? $num:($page*$table[4][3]);
	$bot = 1;
	$top = ceil($num/$table[4][3]);
} else {
	$query = "select * from " . $table[4][0] . " where " . $table[4][1][0] . "='$id'";
	$info = mysql($database, $query);
}

if ($action=="view"){
	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="98%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="98%">
						<tr>
							<td>There are ' . $num . ' events in the ' . $table[4][5] . ' database:';
	if ($num != 0) echo ($num != 1)? ' Displaying events ' . ($low+1) . ' through ' . $high . '. ':'  Displaying one event. ';
	echo '</td>
							<td width="110" align="center"><a href="' . $PHP_SELF . '?action=new&function=news"><img src="images/' . $cssstyle . '.add.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>';
	if ($num != 0){
		$adv = 'Page: ';
		$adv .= ($page == 1)? '<b>&lt;&lt; ':'<b><a href="' . $PHP_SELF . '?page=' . ($page-1) . '&function=news">&lt;&lt;</a> ';
		while ($bot <= $top){
			$adv .= '</b>[ <b>';
			$adv .= ($bot == $page)? "$bot":'<a href="' . $PHP_SELF . '?page=' . $bot . '&function=news">' . $bot . '</a>';
			$adv .= '</b> ]<b>';
		++$bot;}
		$adv .= ($page == $top)? ' &gt;&gt;</b>':' <a href="' . $PHP_SELF . '?page=' . ($page+1) . '&function=news">&gt;&gt;</a></b>';
	}
	echo $adv . '</td>
			</tr>
			<tr>
				<td>';
	$a = $low;
	while ($a < $high){
		$sday = explode ("-", mysql_result($info,$a,$table[4][1][1]));
		$eday = explode ("-", mysql_result($info,$a,$table[4][1][2]));
		echo '
					<table border="0" cellpadding="0" cellspacing="2" width="100%">
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="2" width="100%">
									<tr>
										<td' . $class[1] . ' width="10">&nbsp;</td>
										<td' . $class[3] . '>&nbsp;' . html(mysql_result($info,$a,$table[4][1][3]), $html) . '</td>
									</tr>
									<tr>
										<td width="10">&nbsp;</td>
										<td>
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td valign="top" width="220">
														<table border="0" cellpadding="0" cellspacing="2" width="220">
															<tr>
																<td width="25%"><b>Start:</b></td>
																<td>Date: <i>' . $sday[0] . ' - ' . $months[abs($sday[1])] . ' - ' . $sday[2] . '</i></td>
															</tr>
															<tr>
																<td width="25%"><b>End:</b></td>
																<td>Date: <i>' . $eday[0] . ' - ' . $months[abs($eday[1])] . ' - ' . $eday[2] . '</i></td>
															</tr>
															<tr>
																<td colspan="2">
																	<table border="0" cellpadding="0" cellspacing="2" width="220">
																		<tr>
																			<td width="110" align="center"><a href="' . $PHP_SELF . '?action=delete&sourceid=' . $table[4][1][0] . '&id=' . mysql_result($info,$a,$table[4][1][0]) . '&function=news"><img src="images/' . $cssstyle . '.delete.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
																			<td width="110" align="center"><a href="' . $PHP_SELF . '?action=edit&id=' . mysql_result($info,$a,$table[4][1][0]) . '&function=news" ><img src="images/' . $cssstyle . '.edit.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
													<td valign="top"><i>' . $table[4][8] . ':</i><br>' . html(mysql_result($info,$a,$table[4][1][4]), $html) . '</td>
												</tr>
											</table>
										</td>
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

if ($action == "new"){
	echo '
		<form name="Add" action="' . $PHP_SELF. '" method="post" target="_self">
			<table border="0" cellpadding="0" cellspacing="2" width="98%">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>Add a new record to the ' . $table[4][5] . ' database:</td>
								<td width="110" align="center"><input type="image" src="images/' . $cssstyle . '.add.gif" width="' . $buttonw . '" height="' . $buttonh . '" name="submit"></td>
								<td width="110" align="center"><a href="' . $PHP_SELF . '?action=view&function=news"><img src="images/' . $cssstyle . '.cancel.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="2" width="100%">
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="2" width="100%">
										<tr>
											<td' . $class[1] . ' width="10">&nbsp;</td>
											<td' . $class[3] . '>&nbsp;</td>
										</tr>
										<tr>
											<td width="10"></td>
											<td>
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td width="220" rowspan="2" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td rowspan="4" width="220">
																		<table border="0" cellpadding="0" cellspacing="2" width="220">
																			<tr>
																				<td width="25%"><b>Start:</b></td>
																				<td><select name="startyear" size="1">';
	$a = $thisyear;
	while ($a <= $thisyear+$yearinc){
		echo '
																								<option value="' . $a .'">' . $a . '</option>';
	++$a;}
	echo '
																					</select><select name="startmonth" size="1">';
	$a = 1;
	while (list($key, $val) = each($months)){
		echo '
																								<option value="' . $key . '">' . $val . '</option>';
	}
	reset($months);
	echo '
																					</select><select name="startday" size="1">';
	$a = 1;
	while ($a <= 31){
		settype($a, "string");
		$a = (strlen($a) == 1)? "0" . $a: $a;
		echo '
																								<option value="' . $a . '">' . $a . '</option>';
		settype($a, "integer");
	++$a;}
	echo '
																					</select></td>
																			</tr>
																			<tr>
																				<td width="25%"><b>End:</b></td>
																				<td><select name="endyear" size="1">';
	$a = $thisyear;
	while ($a <= $thisyear+$yearinc){
		echo '
																								<option value="' . $a .'">' . $a . '</option>';
	++$a;}
	echo '
																					</select><select name="endmonth" size="1">';
	$a = 1;
	while (list($key, $val) = each($months)){
		echo '
																								<option value="' . $key . '">' . $val . '</option>';
	}
	reset($months);
	echo '
																					</select><select name="endday" size="1">';
	$a = 1;
	while ($a <= 31){
		settype($a, "string");
		$a = (strlen($a) == 1)? "0" . $a: $a;
		echo '
																								<option value="' . $a . '">' . $a . '</option>';
		settype($a, "integer");
	++$a;}
	echo '
																					</select></td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
														<td>' . $table[4][7] . ':<br>
															<input type="text" name="' . $table[4][1][3] . '" size="48"></td>
													</tr>
													<tr>
														<td>' . $table[4][8] . ':<br>
															<textarea name="' . $table[4][1][4] . '" cols="50" rows="10" wrap="virtual"></textarea></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="hidden" value="add" name="action"><input type="hidden" value="news" name="function">
		</form>' . "\n";
}

if ($action == "edit"){
	$insertarray = mysql_fetch_array($info);
	$sday = explode ("-", $insertarray [$table[4][1][1]]);
	$eday = explode ("-", $insertarray [$table[4][1][2]]);

	echo '
		<form name="Add" action="' . $PHP_SELF. '" method="post" target="_self">
			<table border="0" cellpadding="0" cellspacing="2" width="98%">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>Update a record in the ' . $table[4][5] . ' database:</td>
								<td width="110" align="center"><input type="image" src="images/' . $cssstyle . '.update.gif" width="' . $buttonw . '" height="' . $buttonh . '" name="submit"></td>
								<td width="110" align="center"><a href="' . $PHP_SELF . '?action=view&function=news"><img src="images/' . $cssstyle . '.cancel.gif" width="' . $buttonw . '" height="' . $buttonh . '" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="2" width="100%">
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="2" width="100%">
										<tr>
											<td' . $class[1] . ' width="10">&nbsp;</td>
											<td' . $class[3] . '>&nbsp;</td>
										</tr>
										<tr>
											<td width="10"></td>
											<td>
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td width="220" rowspan="2" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td rowspan="4" width="220">
																		<table border="0" cellpadding="0" cellspacing="2" width="220">
																			<tr>
																				<td width="25%"><b>Start:</b></td>
																				<td><select name="startyear" size="1">';
	$a = $thisyear;
	while ($a <= $thisyear+$yearinc){
		echo '
																								<option value="' . $a .'" ' . selected($a, $sday[0]) . '>' . $a . '</option>';
	++$a;}
	echo '
																					</select><select name="startmonth" size="1">';
	$a = 1;
	while (list($key, $val) = each($months)){
		echo '
																								<option value="' . $key . '" ' . selected($key, $sday[1]) . '>' . $val . '</option>';
	}
	reset($months);
	echo '
																					</select><select name="startday" size="1">';
	$a = 1;
	while ($a <= 31){
		settype($a, "string");
		$a = (strlen($a) == 1)? "0" . $a: $a;
		echo '
																								<option value="' . $a . '" ' . selected($a, $sday[2]) . '>' . $a . '</option>';
		settype($a, "integer");
	++$a;}
	echo '
																					</select></td>
																			</tr>
																			<tr>
																				<td width="25%"><b>End:</b></td>
																				<td><select name="endyear" size="1">';
	$a = $thisyear;
	while ($a <= $thisyear+$yearinc){
		echo '
																								<option value="' . $a .'" ' . selected($a, $eday[0]) . '>' . $a . '</option>';
	++$a;}
	echo '
																					</select><select name="endmonth" size="1">';
	$a = 1;
	while (list($key, $val) = each($months)){
		echo '
																								<option value="' . $key . '" ' . selected($key, $eday[1]) . '>' . $val . '</option>';
	}
	reset($months);
	echo '
																					</select><select name="endday" size="1">';
	$a = 1;
	while ($a <= 31){
		settype($a, "string");
		$a = (strlen($a) == 1)? "0" . $a: $a;
		echo '
																								<option value="' . $a . '" ' . selected($a, $eday[2]) . '>' . $a . '</option>';
		settype($a, "integer");
	++$a;}
	echo '
																					</select></td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
														<td>' . $table[4][7] . ':<br>
															<input type="text" name="' . $table[4][1][3] . '" size="48" value="' . text($insertarray [$table[4][1][3]], 0) . '"></td>
													</tr>
													<tr>
														<td>' . $table[4][8] . ':<br>
															<textarea name="' . $table[4][1][4] . '" cols="50" rows="10" wrap="virtual">' . text($insertarray [$table[4][1][4]], 0) . '</textarea></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="hidden" value="update" name="action"><input type="hidden" value="news" name="function"><input type="hidden" value="' . $table[4][1][0] . '" name="sourceid"><input type="hidden" value="' . $insertarray [$table[4][1][0]] . '" name="id">
		</form>' . "\n";
}
?>