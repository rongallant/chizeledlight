<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

include("PHPIncludes/functions.php");

$src = explode("A", $id);
$query = "select * from ".$table[$src[1]][0]." where ".$table[$src[1]][1][$src[2]]."=".$src[0];
$result = mysql($database, $query);
if (!isset($action)) $action="view";

if ($action == "mail" && isset($email) && $email != "" && isset($message) && $message != "" && eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email)){
	$to=mysql_result($result,0,$table[$src[1]][1][$src[4]]);
	$header = "From: $email\nReply-To: $email\nX-Mailer: PHP/" . phpversion();
	if (mail($to, $subject, $message . $disclaimer, $header)){
		echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="350">
						<tr>
							<td width="15"' . $class[1] . '>&nbsp;</td>
							<td' . $class[3] . '>Message Sent</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td><i>Replies will be sent to:</i><br>
								' . $email . '</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td><i>Subject:</i><br>
								' . html($subject, 1) . '</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td><i>Message:</i><br>
								' . html($message, 1) . '</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td>Thank you. <a href="'.$table[$src[1]][4].'">Click here</a> to return to the '.$table[$src[1]][5].'</td>
						</tr>
					</table>
					<table width="350" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
	} else {
		echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="2" width="350">
						<tr>
							<td width="15"' . $class[1] . '>&nbsp;</td>
							<td' . $class[3] . '>Failed!</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td><i>Replies sent to:</i><br>
								' . $email . '</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td><i>Subject:</i><br>
								' . $subject . '</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td><i>Message:</i><br>
								' . html($message, 1) . '</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td>Please use the <b>Back</b> button of your browser to try to resent the message.</td>
						</tr>
					</table>
					<table width="350" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
	}
} else {
	$action = "view";
}

if ($action == "view"){
	$eclass = (isset($email) && (strlen($email) == 0 || $email == ""))? $class[4] . '>Required: ' : ((isset($email) && !eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email))?  $class[4] . '>Not a valid email address: ' : ">");
	$eval = (isset($email) && $email!="")? ' value="' . $email . '"':"";
	$mclass = (isset($message) && strlen($message) == 0)? $class[4] . '>Required: ':">";
	$mval = (isset($message) && $message!="")? stripslashes($message):"";

	echo '
		<table border="0" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td align="center">
					<table border="0" cellpadding="0" cellspacing="2" width="350">
						<tr>
							<td width="15"' . $class[1] . '>&nbsp;</td>
							<td' . $class[3] . '>Contact</td>
						</tr>
						<tr>
							<td width="15"></td>
							<td>' . $mailparaa . '<p>' . $mailparab . '<i>'.mysql_result($result,0,$table[$src[1]][1][$src[3]]).'</i></p><p>HTML is disabled</p></td>
						</tr>
						<tr>
							<td width="15"></td>
							<td align="center">
								<form name="FormName" action="' . $PHP_SELF . '" method="post">
									<table border="0" cellpadding="0" cellspacing="2" width="100%">
										<tr>
											<td' . $eclass . 'Enter the email address you wish replies sent to:<br>
												<input type="text" name="email" size="60"' . $eval . '></td>
										</tr>
										<tr>
											<td>Subject:<br>
												<input type="text" name="subject" size="60" value="'.mysql_result($result,0,$table[$src[1]][1][$src[3]]).'"></td>
										</tr>
										<tr>
											<td' . $mclass . 'Message:<br>
												<textarea name="message" cols="62" rows="14" wrap="virtual">' . $mval . '</textarea></td>
										</tr>
										<tr>
											<td>Any personal information you\'ve entered here is stored temporarily for the submission process only. Once completed, the information is discarded.</td>
										</tr>
										<tr>
											<td align="center"><input type="submit" name="send" value="   Send   " class="sub"></td>
										</tr>
									</table>
									<input type="hidden" value="mail" name="action"><input type="hidden" value="' . $id . '" name="id">
								</form>
							</td>
						</tr>
					</table>
					<table width="350" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
}

?>