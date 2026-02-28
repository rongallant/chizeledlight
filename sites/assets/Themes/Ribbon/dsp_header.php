<?PHP include(__DIR__ . '/fbx_Settings.php'); ?>
<?PHP
	if ($title == "") {
		$title = 'Chizeled Light (Blue)';
	}
?>
<HTML>
<HEAD>
	<TITLE><?PHP echo $title; ?></TITLE>
	<LINK REL="STYLESHEET" TYPE="text/css" HREF="<?=$styles;?>/master.css">
	<LINK REL="STYLESHEET" TYPE="text/css" HREF="<?=$styles;?>/FrontPage.css">
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=$scripts?>/app_JavaScripts.js"></SCRIPT>
</HEAD>
<BODY>

<? // Turns of the body content
if ($BlankPage != "yes") {?>

<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="749" ALIGN="center">
<TR>
	<TD><IMG SRC="<?=$images;?>/spacer.gif" WIDTH="148" HEIGHT="1" BORDER="0"></TD>
	<TD><IMG SRC="<?=$images;?>/spacer.gif" WIDTH="452" HEIGHT="1" BORDER="0"></TD>
	<TD><IMG SRC="<?=$images;?>/spacer.gif" WIDTH="149" HEIGHT="1" BORDER="0"></TD>
</TR>
<TR>
    <TD COLSPAN="3"><IMG SRC="<?=$images;?>/banner_top.jpg" WIDTH=749 HEIGHT=122 BORDER="0"></TD>
</TR>
<TR>
    <TD VALIGN="top" BACKGROUND="<?=$images;?>/bg_mustard.gif">
	<?php include(__DIR__ . '/dsp_MenuLeft.php');?>
	
	<P ALIGN="center"><A HREF="<?=$htmlRoot?>/september11.php"><IMG SRC="<?=$images;?>/UnityRibbon_Small.gif" WIDTH="63" HEIGHT="100" BORDER="0"></A></P>

	</TD>
    <TD HEIGHT="300" CLASS="BODY" VALIGN="top">

<? // Turns of the body content
}?>
