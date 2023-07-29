
<?PHP if ($title == "") {$title = 'Chizeled Light';} ?>
<?include ('fbx_Settings.php');?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
	<TITLE><?PHP echo $title; ?></TITLE>
	<LINK REL="SHORTCUT ICON" href="<?echo $images;?>/ico.ico">
	<LINK REL="STYLESHEET" TYPE="text/css" HREF="<?echo $styles;?>/master.css">
	<LINK REL="STYLESHEET" TYPE="text/css" HREF="<?echo $styles;?>/FrontPage.css">
	<SCRIPT LANGUAGE="JavaScript" SRC="<?echo $scripts;?>/JavaScripts.js">Please enable JavaScript</SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	<!--
		if(window.event + "" == "undefined") event = null;
		function HM_f_PopUp(){return false};
		function HM_f_PopDown(){return false};
		popUp = HM_f_PopUp;
		popDown = HM_f_PopDown;
	//-->
	</SCRIPT>
</HEAD>

<BODY BGCOLOR="WHITE" BACKGROUND="<?echo $images;?>/javabeans.jpg" onLoad="window.defaultStatus='Breakfast Java - The way Canadians start their day.';" onUnload="window.defaultStatus=''">


<? // Turns of the body content
if ($BlankPage != "yes") {?>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="750" HEIGHT="50" ALIGN="center">
	<TR>
		<TD BGCOLOR="#006699">
		<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">
			<TR>
				<TD WIDTH="276"><IMG SRC="<?echo $images;?>/topleft3.gif" WIDTH="276" HEIGHT="50" BORDER="0"></TD>
				<TD>&nbsp;</TD>
			</TR>
		</TABLE></TD>
	</TR>
	<TR>
		<TD BGCOLOR="PapayaWhip" ALIGN="center"><IMG SRC="<?echo $images;?>/spacer.gif" HEIGHT="18" BORDER="0"></TD>
	</TR>
	<TR>
		<TD>
	
		<TABLE CELLPADDING="10" CELLSPACING="0" BORDER="0" BGCOLOR="white" WIDTH="100%">
			<TR VALIGN="top">
				<TD WIDTH=110 BGCOLOR="PapayaWhip">
		
				<IMG SRC="<?echo $images;?>/spacer.gif" WIDTH=110 HEIGHT=1 BORDER="0">
	
				<?include ('dsp_MenuLeft.php')?>

				</TD>
				<TD VALIGN="top">

<? // Turns of the body content
}?>