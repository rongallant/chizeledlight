<?PHP $title = 'Chizeled Light - Contact';?> 

<?php include($domainRoot . 'assets/templates/main_header.php');?>

<H1>Contact</H1>

<FORM ACTION="<?PHP echo $mySSLCGI ;?>formmail.cgi" METHOD="POST">
	<input type="hidden" name="recipient" value="<?PHP echo $myEmail; ?>">
	<input type="hidden" name="subject" value="From your webpage">

<TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="300" ALIGN="center">
	<TR>
		<TD ALIGN="right" width="50%"><B>Your Name:</B></TD>
		<TD width="50%"><INPUT TYPE="text" NAME="Name" WIDTH="20"></TD>
	</TR>
	<TR>
		<TD ALIGN="right" width="50%"><B>Your Email:</B></TD>
		<TD width="50%"><INPUT TYPE="text" NAME="sender" WIDTH="20"></TD>
	</TR>
	<TR>
		<TD VALIGN="top" COLSPAN="2">
			<B>Message:</B><BR>
			<TEXTAREA COLS=30 ROWS=7 NAME="message" WRAP="virtual" style="width:100%;"></TEXTAREA>
			<P>
			<INPUT TYPE="submit" NAME="Send" VALUE="Send Message"></TD>
	</TR>
</TABLE>
</FORM>

<BR><BR>

<?PHP /*
<H2>ICQ Pager</H2>

<P>If you want to reach me fast and the flower <img src="http://online.mirabilis.com/scripts/online.dll?icq=608167&img=5"> is green, Use this form to contact me threw ICQ. (ICQ#: 608167)</P>

<FORM ACTION="http://wwp.mirabilis.com/scripts/WWPMsg.dll" METHOD="post">
<TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="300" ALIGN="center">
	<TR>
		<TD ALIGN="right" WIDTH="300">
		<B>Your Name:</B></TD>
		<TD>
		<INPUT TYPE="text" NAME="from" VALUE="" SIZE=20 MAXLENGTH=40 ONFOCUS="this.select()"></TD>
	</TR><TR>
		<TD ALIGN="right">
		<B>Your Email:</B></TD>
		<TD>
		<INPUT TYPE="text" NAME="fromemail" VALUE="" SIZE=20 MAXLENGTH=40 ONFOCUS="this.select()">
		<INPUT TYPE="hidden" NAME="subject" VALUE="From Ron's Place!"></TD>
	</TR><TR>
		<TD COLSPAN="2">
		<B>Message:</B><BR>
		<TEXTAREA NAME="body" ROWS="7" COLS="30" WRAP="virtual"></TEXTAREA>
		<INPUT TYPE="hidden" NAME="to" VALUE="608167">
		<BR><BR>
		<INPUT TYPE="submit" NAME="Send" VALUE="Send Message"></TD>
	</TR>
</TABLE>
</FORM>
*/ ?>

<?php include($domainRoot . 'assets/templates/main_footer.php');?>
