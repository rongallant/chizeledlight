<P><A HREF="javascript:history.back();">&lt;&lt; Back</A></P>

<?PHP
if ($attributes["Pic"] == ""){$attributes["Pic"] = "";}
if ($txt == ""){$txt = "";}
if ($text == ""){$text = "";}
if(!isset($size)) {
	$Pic = $phpRoot . "/" . $attributes["Pic"];
	$heightwidth = GetImageSize($Pic);
	$size = $heightwidth[3];
}
?>

<TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="100%">
	<TR VALIGN="top">
		<TD><DIV ALIGN="center"><A HREF="<?PHP echo $HTTP_REFERER; ?>"><IMG SRC="<?PHP print $attributes["Pic"]; ?>" <?php print $size;?> BORDER="0" alt="" /></A></DIV></TD>
	</TR>
	<TR>
		<TD ALIGN="center">
			<?php
				if ($txt == "yes"){
					print '<P>';
					include ("$text");
					print '</P>';
				}
			?>
		</TD>
	</TR>
</TABLE>