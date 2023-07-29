<P><A HREF="<?PHP echo $HTTP_REFERER; ?>">&lt;&lt; Back</A></P>

<?PHP if ($Pic == ""){$Pic = "";} ?>
<?PHP if ($txt == ""){$txt = "";} ?>
<?PHP if ($text == ""){$text = "";} ?>

<TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="100%" ALIGN="center">
	<TR VALIGN="top">
		<TD><DIV ALIGN="center"><A HREF="index.php"><IMG SRC="<?PHP echo $Pic; ?>" BORDER="0"></A></DIV></TD>
	</TR>
	<TR>
		<TD ALIGN="center">
<?php
if ($txt == "yes"){
	echo '<P>';
	include ("$text");
	echo '</P>';
	}
?>
		</TD>
	</TR>
</TABLE>
