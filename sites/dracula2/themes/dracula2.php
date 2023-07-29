<?php 
include('language/'.$lang.'/lang_theme.php');
include ("newsflashCookie.php");
include ("SessionCookie.php");
include ("configuration.php");
if ($option=="logout"){
	setcookie("usercookie");
	$option="";
	print "<SCRIPT> document.location.href='index.php'; </SCRIPT>\n";
}

if ($detection <> "detected"){
	include ("browserdetect.php");
	include ("OSdetect.php");
	setcookie("detection", "detected");
}

$pagewidth = "750";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title><?php echo $sitename; ?></title>
	<link rel="stylesheet" href="css/theme_dracula2.css" type="text/css">
	<link rel="shortcut icon" href="images/favicon.ico" />
	<style type="text/css">
	.disclaimer {
		font-family: Arial;
		font-size: 11px;
		color: gray;
		width: 350px;
	}
	</style>
	<?php echo _ISO; ?>
</head>

<body bgcolor="#3B5959" background="images/themes/theme_dracula2/bg.gif">

<table bgcolor="#ffffff" cellpadding="5" cellspacing="0" border="0" width="<? echo $pagewidth ?>" align="center">
	<td>
		<td>

<div align="center"><a href="index.php" target="_top"><img src="images/themes/theme_dracula2/logo.gif" border="0" alt="Dracula's Homepage"></a></div>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding-bottom:2px;border-bottom:solid 2px black;">
	<tr>
		<td style="color:black; font-size:10px;">
			<?php echo date(_DATE_FORMAT); ?>
		</td>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" align="right">
			<form action="index.php" method="post">
			<input type="hidden" name="option" value="search">
				<tr>
					<td align="right" style="color:black; font-size:10px;">Search Drac's Site&nbsp;&nbsp;</td>
					<td align="left"><input class="inputbox" type="text" name="searchword" size="12"></td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr valign="top">
		<td width="180" bgcolor="#f5f5f5">
			<?php 
			$side = "left"; 
			include("component.php");
			?>
		</td>
		<td>
			<?php if($col_main == 2) { ?>
				<table width="150" align="right">
					<tr>
						<td>
						<?php
							$side = "right";
							include("component.php");
						?>
						</td>
					</tr>
				</table>
			<?php } ?>

			<?php include ("mainbody.php"); ?>
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:solid black 2px; border-bottom:solid black 2px;">
	<tr>
		<td align="center">
			<div class="disclaimer">
			While you may feel free to download any of the material and/or photos
			on this site for your personal use, their use in any published form,
			without my permission, is a violation of copyright. For permission,
			contact me at <a href="mailto:emiller@mun.ca">emiller@mun.ca</a>.
			</div>
		</td>
	</tr>
</table>

<?php include ("banners.php"); ?>

		</td>
	</td>
</table>

</body>
</html>