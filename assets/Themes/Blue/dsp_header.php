<?PHP include('/www/chizeledlight/assets/Themes/Blue/fbx_Settings.php'); ?>

<?PHP if ($title == "") {$title = 'Chizeled Light';} ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>
<HEAD>
	<TITLE><?echo$title;?></TITLE>
	<SCRIPT LANGUAGE="JavaScript" SRC="/assets/scripts/app_JavaScripts.js"></SCRIPT>
	<LINK REL="STYLESHEET" TYPE="text/css" HREF="<?echo$styles;?>/MainStyle.css">
	<LINK REL="STYLESHEET" TYPE="text/css" HREF="<?echo$styles;?>/FrontPage.css">
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

<body BACKGROUND="<?echo$images;?>/bdy_Background.gif" bgcolor="#485096" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="<?echo$onload;?>">


<? // Turns of the body content
if ($BlankPage != "yes") {?>

<SCRIPT LANGUAGE="JavaScript1.2" SRC="/assets/Themes/Blue/assets/scripts/menu/HM_Loader.js" TYPE='text/javascript'></SCRIPT>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr height="112">
		<td width="300" height="112"><img src="<?echo$images;?>/top_LeftCorner.gif" width="300" height="112" border="0"></td>
		<td background="<?echo$images;?>/top_Background.gif" align="center"><img src="<?echo$images;?>/top_Logo.gif" width="499" height="112" border="0"></td>
	</tr>
</table>

<table cellpadding="10" cellspacing="0" border="0" width="100%" height="100%">
	<tr valign="top">
		<td width="140" background="<?echo$images;?>/top_SideBar.gif">
		
		<img src="<?echo$images;?>/pixel.gif" width="30" height="250" border="0">
		<?include("/www/chizeledlight/assets/Themes/Blue/dsp_ButtonAds.php");?>
		
		</td>
		<td>

<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr>
		<td width="12" height="12"><img src="<?echo$images;?>/tbl_TopLeft.gif" width="12" height="12" alt="" border="0"></td>
		<td background="<?echo$images;?>/tbl_Sides.gif"><img src="<?echo$images;?>/tbl_Sides.gif" width="12" height="12" border="0"></td>
		<td width="12" height="12"><img src="<?echo$images;?>/tbl_TopRight.gif" width="12" height="12" alt="" border="0"></td>
	</tr>
	<tr valign="top">
		<td background="<?echo$images;?>/tbl_Sides.gif"><img src="<?echo$images;?>/tbl_Sides.gif" width="12" height="12" border="0"></td>
		<td background="<?echo$images;?>/tbl_Background.gif">
		
<? // Turns of the body content
}?>