<form name="form1" action="<?print $self?>" method="post">
	<input type="hidden" name="fuseaction" id="fuseaction" value="<?print $XFA['validatelogin']?>" />
	<table cellpadding="3" cellspacing="0" border="0" align="center">
		<tr>
			<td>Username:</td>
			<td><input type="text" name="Username" id="Username" maxlength="10" /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="Password" id="Password" maxlength="10" /></td>
		</tr>
		<tr>
			<td></td>
			<td><p align="center"><input type="submit" name="loginButton" id="loginButton" value="login!" /></p></td>
		</tr>
	</table>
</form>

<?PHP
	if(!empty($msg)) {
		print("<font color=#FF0000>$Msg</font>");
	}
?>