<?PHP require("PHPIncludes/setup.php"); ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<!--
	Multifunction Calendar
	Copyright � 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.
	www.lightwavesgraphics.com
-->

<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<?PHP echo '<link href="Style/' . $cssstyle . '" rel="stylesheet" rev="text/css">' . "\n"; ?>
		<?PHP echo "<title>" . $table[3][5] . "</title>"; ?>
	</head>

	<body bgcolor="#ffffff">
		<table border="0" cellpadding="0" cellspacing="5" width="100%">
			<tr>
				<td bgcolor="white">
<?PHP require("PHPIncludes/minutes.php"); ?>
				</td>
			</tr>
		</table>
	</body>

</html>