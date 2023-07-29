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
	<link rel="stylesheet" href="css/theme_dracula.css" type="text/css">
	<link rel="shortcut icon" href="images/favicon.ico" />
	<?php echo _ISO; ?>
</head>

<body bgcolor="#ffffff">

<div align="center">

<table cellpadding="0" cellspacing="0" border="0" width="<? echo $pagewidth ?>">
	<tr valign="top">
		<td width="180" bgcolor="#D0E0E0">
			<table cellpadding="5" cellspacing="0" border="0" width="100%">
				<tr>
					<td><a href="index.php"><img src="images/themes/theme_dracula/logo.gif" border="0"></a></td>
				</tr>
				<tr>
					<td>
						<?php 
						$side = "left"; 
						include("component.php");
						?>
					</td>
				</tr>
			</table>
		</td>
		<td bgcolor="#ffffff">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr valign="top" align="right">
						<form action="index.php" method="post">
					<td>
						<div style="background-color:#D0E0E0; height:20px; color:black; font-size:10px;">
							Search Drac's Site
							<input class="inputbox" type="text" name="searchword" size="12">
							<input type="hidden" name="option" value="search">
						</div>
						<?php include ("mainbody.php"); ?>
					</td>
						</form>
					<?php
					if($col_main == 2) {
						print("<td width=180 valign=top>");
						print($col_main);
						$side = "right";
						include("component.php");
						print("</td>");
					}
					?>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="<? echo $pagewidth ?>" border="0" cellspacing="0" cellpadding="0" style="border-top: solid black 1px;">
	<tr> 
		<td align="center"> 
			<?php include ("banners.php"); ?>
		</td>
	</tr>
	<tr>
		<td>
			While you may feel free to download any of the material and/or photos
			on this site for your personal use, their use in any published form,
			without my permission, is a violation of copyright. For permission,
			contact me at <a href="mailto:emiller@mun.ca">emiller@mun.ca</a>.
		</td>
	</tr>
</table>

</div>

</body>
</html>