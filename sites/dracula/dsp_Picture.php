


<?PHP if ($picture == ""){$picture = "";} ?>
<?PHP if ($txt == ""){$txt = "";} ?>
<?PHP if ($text == ""){$text = "";} ?>
<?

if(!isset($size)) {
	$softroot = "/www/chizeledlight/dracula/";
	$heightwidth = GetImageSize ($softroot . $picture);
	$size = $heightwidth[3];
}

?>

<TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="100%">
	<TR VALIGN="top">
		<TD>
		<DIV ALIGN="center"><IMG SRC="<?PHP echo $picture; ?>" <?echo $size;?> BORDER="0"></DIV>
		<P><A HREF="<?PHP echo $HTTP_REFERER; ?>">&lt;&lt; Back</A></P>
		</TD>
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
