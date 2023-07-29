<?PHP
$syslog = explode("\n", $syslog);
$a = 0;

echo '
					<table border="0" cellpadding="0" cellspacing="5" width="98%">
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="2" width="100%">
									<tr>
										<td>
											<table border="0" cellpadding="0" cellspacing="2" width="100%">
												<tr>
													<td' . $class[1] . ' width="10">&nbsp;</td>
													<td' . $class[3] . '>' . $table[0][5] . ' Rebuild Log</td>
												</tr>';
while ($a < count($syslog)){
	echo '
												<tr>
													<td' . $class[1] . ' width="10">&nbsp;</td>
													<td>' . $syslog[$a] . '</td>
												</tr>';
$a++;}
echo '
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>';


?>