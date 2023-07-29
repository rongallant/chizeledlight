<!doctype html public "-//w3c//dtd html 3.2 final//en">
<html>
<head>
	<base target="main" />
	<script language="javascript">
	<!--
		browsername = navigator.appname;browserver = parseint ( navigator.appversion );
		version = "n2";
		if ( browsername == "netscape" && browserver >= 3 ) version = "n3";
		if ( browsername == "microsoft internet explorer" && browserver >=4 ) version = "e4";
		
		home_on = new image ( 92, 34 );
		home_off = new image ( 92, 34 );;
		home_on.src = "assets/images/menu/home_on.gif";
		home_off.src = "assets/images/menu/home_off.gif";
		
		aboutme_on = new image ( 132, 34 );
		aboutme_off = new image ( 132, 34 );
		aboutme_on.src = "assets/images/menu/aboutme_on.gif";
		aboutme_off.src = "assets/images/menu/aboutme_off.gif";
		
		graphics_on = new image ( 131, 34 );
		graphics_off = new image ( 131, 34 );
		graphics_on.src = "assets/images/menu/graphics_on.gif";
		graphics_off.src = "assets/images/menu/graphics_off.gif";
		
		links_on = new image ( 83, 34 );
		links_off = new image ( 83, 34 );
		links_on.src = "assets/images/menu/links_on.gif";
		links_off.src = "assets/images/menu/links_off.gif";
		
		feedback_on = new image ( 140, 34 );
		feedback_off = new image ( 140, 34 );
		feedback_on.src = "assets/images/menu/feedback_on.gif";
		feedback_off.src = "assets/images/menu/feedback_off.gif";
		
		function button_on ( imgname ) {
			if ( version == "n3" || version == "e4" ) {
				buton = eval ( imgname + "_on.src" );
				document [imgname].src = buton;
			}
		}
		
		function button_off ( imgname ) {
			if ( version == "n3" || version == "e4" ) {
				butoff = eval ( imgname + "_off.src" );
				document [imgname].src = butoff;
			}
		}
	// -->
	</script>
</head>

<body topmargin="3" background="assets/images/bg.jpg" bgcolor="#442d0d">

<div align="center">
	<a href="index.php" target="_top" onMouseOut="button_off('home'); return true" onMouseOver="button_on('home'); return true"><img src="assets/images/menu/home_off.gif" width="92" height="34" alt="home" border="0" name="home" /></a>
	<a href="info.php" onMouseOut="button_off('aboutme'); return true" onMouseOver="button_on('aboutme'); return true"><img src="assets/images/menu/aboutme_off.gif" width="132" height="34" alt="about me" border="0" name="aboutme" /></a>
	<a href="artwork.php" onMouseOut="button_off('graphics'); return true" onMouseOver="button_on('graphics'); return true"><img src="/assets/images/menu/graphics_off.gif" width="131" height="34" alt="graphics" border="0" name="graphics" /></a>
	<a href="morepages.php" onMouseOut="button_off('links'); return true" onMouseOver="button_on('links'); return true"><img src="/assets/images/menu/links_off.gif" width="83" height="34" alt="links" border="0" name="links" /></a>
	<a href="contact.php" onMouseOut="button_off('feedback'); return true" onMouseOver="button_on('feedback'); return true"><img src="/assets/images/menu/feedback_off.gif" width="140" height="34" alt="feedback" border="0" name="feedback" /></a>
</div>

</body>
</html>