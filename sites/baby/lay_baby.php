<html>
<head>
	<title><? echo $title; ?></title>
	<link rel="STYLESHEET" type="text/css" href="<? echo $webRoot; ?>assets/styles/main.css">
</head>

<body background="<? echo $myGraphics; ?>bg_spots.gif">

<table cellpadding="0" cellspacing="0" border="0" align="center" class="main">
	<tr>
		<td width="30" height="30"><img src="<? echo $myGraphics; ?>br_top_left.gif" width="30" height="30" BORDER="0"></td>
		<td background="<? echo $myGraphics; ?>br_top_edge.gif">&nbsp;</td>
		<td width="30" height="30"><img src="<? echo $myGraphics; ?>br_top_right.gif" WIDTH="30" HEIGHT="30" BORDER="0"></td>
	</tr>
	<tr>
		<td background="<? echo $myGraphics; ?>br_left_edge.gif">&nbsp;</td>
		<td background="<? echo $myGraphics; ?>br_bg.gif" VALIGN="top">

			<?include("dsp_Menu.php");?>

			<? print trim($Fusebox["layout"]); ?>

		</td>
		<td background="<? echo $myGraphics; ?>br_right_edge.gif">&nbsp;</td>
	</tr>
	<tr>
		<td width="30" height="30"><img src="<? echo $myGraphics; ?>br_bottom_left.gif" WIDTH="30" HEIGHT="30" BORDER="0"></td>
		<td background="<? echo $myGraphics; ?>br_bottom_edge.gif">&nbsp;</td>
		<td width="30" height="30"><img src="<? echo $myGraphics; ?>br_bottom_right.gif" WIDTH="30" HEIGHT="30" BORDER="0"></td>
	</tr>
</table>

<p style="text-align:center;"><a href="<?=$myDomain ?>" style="font-weight:bold; text-decoration:none; background-color:#FFFEAA;">Ron Gallant</a></p>

</body>
</html>