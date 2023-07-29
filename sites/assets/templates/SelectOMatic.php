<SCRIPT LANGUAGE="JavaScript">
<!--
function search(form) {
	if (form.engine[0].checked) {
		url = "http://www.google.com/search?q=" + form.input.value; }
	if (form.engine[1].checked) {
		url = "http://search.yahoo.com/bin/search?p=" + form.input.value; }
	if (form.engine[2].checked) {
		url = "http://www.altavista.com/cgi-bin/query?pg=q&q=" + form.input.value; }
	if (form.engine[3].checked) {
		url = "http://www.hotbot.lycos.com/?SM=MC&DV=0&LG=any&DC=10&DE=2&AM1=MC&MT=" + form.input.value; }
	if (form.engine[4].checked) {
		url = "http://search.excite.com/search.gw?search=" + form.input.value; }
	if (form.engine[5].checked) {
		url = "http://www.alltheweb.com/search?cat=web&lang=english&query=" + form.input.value; }
	if (form.engine[6].checked) {
		url = "http://www.goto.com/d/search/?Keywords=" + form.input.value; }
	if (form.engine[7].checked) {
		url = "http://search.aol.com/dirsearch.adp?start=&from=topsearchbox.%2Findex.adp&query=" + form.input.value; }
	if (form.engine[8].checked) {
		url = "http://www.askjeeves.com/main/askjeeves.asp?ask=test" + form.input.value; }
	if (form.engine[9].checked) {
		url = "http://www.teoma.com/search.asp?qcat=1&qsrc=0&search.x=24&search.y=18&t=" + form.input.value; }

	location.href = url;
	}
// -->
</SCRIPT>

<FORM NAME="sform" ACTION="javascript:search(document.sform);//" METHOD="get">
<DIV CLASS="MainH4">Select-O-Matic</DIV>
<P>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">
	<TR>
		<TD COLSPAN="2">
		<INPUT ID="mainInput" TYPE="text" NAME="input"><INPUT ID="mainInput" TYPE="submit" VALUE="Go">
		</TD>
	</TR>
	<TR VALIGN="top">
		<TD WIDTH="50%">
		<INPUT TYPE="radio" NAME="engine" CHECKED> <A HREF="http://www.google.com/"><B>Google</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.yahoo.com/"><B>Yahoo</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.altavista.com/"><B>AltaVista</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.hotbot.com/"><B>HotBot</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.excite.com/"><B>Excite</B></A><BR>
		</TD>
		<TD WIDTH="50%">
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.alltheweb.com/"><B>All The Web</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.goto.com/"><B>Go To</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://search.aol.com/"><B>AOL</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.askjeeves.com/"><B>Ask Jeeves</B></A><BR>
		<INPUT TYPE="radio" NAME="engine"> <A HREF="http://www.teoma.com/"><B>Teoma</B></A><BR>
		</TD>
	</TR>
</TABLE>
</P>
</FORM>
	
