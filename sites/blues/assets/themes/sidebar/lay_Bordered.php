<?$images="assets/themes/sidebar/assets/images";?>
<?$styles="assets/themes/sidebar/assets/styles";?>

<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?echo$title?></title>
	<meta name="description" content="Free guitar lessons from a professional teacher will help you learn the guitar fast, easy and free.">
	<meta name="keywords" content=" guitar, guitars, guitar lessons, free guitar lessons, lessons, free, blues, lessons for guitar, fender, jim, blues school, Jim's Blues School">
	<link rel="STYLESHEET" type="text/css" href="<?echo$styles?>/blues-style.css">
</head>

<body background="<?echo$images?>/lay_Left.gif" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" bottommargin="0" rightmargin="0">

<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr height="114">
		<td colspan="3" height="114" background="<?echo$images?>/lay_Top.gif"><img src="<?echo$images?>/lay_Logo.gif" width="497" height="114" border="0"><a name="top"></a></td>
	</tr>
	<tr valign="top">
		<td width="160" style="padding:20px;">
		
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Splash"><div id="topmenu">&middot; Home</div></a>
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Welcome"><div id="topmenu">&middot; Welcome</div></a>
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Lesson-1"><div id="topmenu">&middot; Lesson 1</div></a>
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Lesson-2"><div id="topmenu">&middot; Lesson 2</div></a>
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Lesson-3"><div id="topmenu">&middot; Lesson 3</div></a>
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Info"><div id="topmenu">&middot; Info</div></a>
		<a class="MenuLink" href="<?echo$self?>?fuseaction=blues.Links"><div id="topmenu">&middot; Links</div></a>
		
		<img src="<?echo$images?>/pixel.gif" width="120" height="1" border="0"></td>
		<td width="100%" style="padding:10px;">
		
		<!-- Text starts here -->

		<?print trim($Fusebox["layout"]);?>

		<!-- Text ends here  bgcolor="#EEF8FF" -->

		</td>
		<td><img src="<?echo$images?>/pixel.gif" width="160" height="1" border="0"></td>
	</tr>
	<tr>
		<td background="<?echo$images?>/lay_Left.gif"><div align="center"><a href="http://www.chizeledlight.com/" target="_top"><img src="http://www.chizeledlight.com/graphics/banners/chizeledani.gif" border="0"></a></div></td>
		<td style="padding:10px;">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr valign="top">
				<td>
				<p id="copyright">Legal/Copyright Notice:<br>
				"Blues School," "Jim's Blues School," "jimlogo" and the complete content of all lessons, source codes and other materials on these pages are under Copyright 1997 by James Robins.<br>
				All rights, both foreign and domestic, are reserved.</p>
				</td>
				<td width="100"><p><a href="#top" style="color:black;font:12px;">Back To Top</a></p></td>
			</tr>
		</table>		
		</td>
		<td height="214"><img src="<?echo$images?>/lay_Guitar.gif" width="90" height="214" border="0"></td>
	</tr>
	
</table>

</body>
</html>

