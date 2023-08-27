<?php include($domainRoot . 'assets/templates/main_header.php');?>

<?php include ('/www/chizeledlight/assets/templates/artwork.php');?>

<H1>Logo Design</H1>


<?PHP if ($Pic == ""){$Pic = "";} ?>
<?PHP if ($txt == ""){$txt = "";} ?>
<?PHP if ($text == ""){$text = "";} ?>

<TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="100%">
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



<?php include($domainRoot . 'assets/templates/main_footer.php');?>