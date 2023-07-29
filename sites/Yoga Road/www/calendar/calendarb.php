<?PHP
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

require("PHPIncludes/setup.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<!--
	Multifunction Calendar
	Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.
	www.lightwavesgraphics.com
-->

<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<?PHP echo '<link href="Style/' . $cssstyle . '" rel="stylesheet" rev="text/css">' . "\n"; ?>
		<?PHP echo "<title>" . $table[2][5] . "</title>"; ?>
	</head>

	<body bgcolor="#ffffff">
		<table border="0" cellpadding="0" cellspacing="5" width="100%">
			<tr>
				<td bgcolor="white">
<?PHP require("PHPIncludes/calendarb.php"); ?>
				</td>
			</tr>
		</table>
	</body>

</html>