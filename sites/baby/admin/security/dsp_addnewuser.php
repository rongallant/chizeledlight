<form name="form1" action="<?print $self?>" method="post">
	<input type="hidden" name="fuseaction" id="fuseaction" value="<?print $XFA['insertuser']?>" />
	<table cellpadding="3" cellspacing="0" border="0" align="center">
		<tr>
			<td>Username :</td>
			<td><input type="text" name="Username" maxlength="10"></td>
		</tr>
		<tr>
			<td>Password :</td>
			<td><input type="password" name="Password" maxlength="10"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Add user"></td>
		</tr>
	</table>
</form>