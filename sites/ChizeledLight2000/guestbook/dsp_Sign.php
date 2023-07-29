<H1>Sign Guestbook</H1>

<FORM ACTION="index.php?fuseaction=gb.Add" METHOD="post">
<TABLE CELLPADDING="3" CELLSPACING="0" BORDER="0" WIDTH="400" ALIGN="center">
	<TR>
		<TD VALIGN="top" WIDTH="100"><B>Name:</B></TD>
		<TD><INPUT TYPE="text" NAME="name" SIZE="30" MAXLENGTH="80"></TD>
	</TR>
	<TR>
		<TD VALIGN="top"><B>Email:</B></TD>
		<TD><INPUT TYPE="text" NAME="email" SIZE="30" MAXLENGTH="80"></TD>
	</TR>
	<TR>
		<TD VALIGN="top"><B>Comments:</B></TD>
		<TD><TEXTAREA NAME="comments" ROWS="10" COLS="30" WRAP="virtual"></TEXTAREA></TD>
	</TR>
	<TR>
		<TD COLSPAN="2" ALIGN="right"><INPUT TYPE="submit" NAME="gb" VALUE="Add Message"></TD>
	</TR>
</TABLE>
</FORM>

