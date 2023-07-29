<?PHP require("PHPIncludes/setup.php"); ?>

<? /*
<fusedoc fuse="lay_Main.php">
	<responsibilities>
		I am the Success page.
	</responsibilities>
	<properties>
		<history name="Ron Gallant" email="ron@chizeledlight.com" date="2003-01-06" type="update">
			Commented out Merchandise.  Enabled mouse-over when link on correct fuseaction. Changed email address to use settings.
		</history>
		<history name="Ron Gallant" email="ron@chizeledlight.com" date="2002-01-19" type="Create" />
	</properties>
</fusedoc>
*/

	if(!isset($GLOBALS["self"])){ $GLOBALS["self"] = "../index.php"; }
	
	if(!isset($title)){ $title = "Yoga Road"; }
	if(!isset($layout)){ $layout = "main"; }
	if(!isset($images)){ $images = "../assets/themes/images"; }
	if(!isset($prods)){ $prods = "../assets/images/products"; }
	if(!isset($prodthumbs)){ $prodthumbs = "../assets/images/products"; }
	if(!isset($styles)){ $styles = "../assets/themes/styles"; }
	if(!isset($email)){ $email = "info@yogaroad.net"; }
?>

<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?echo$title;?></title>
	<?PHP echo '<link href="Style/' . $cssstyle . '" rel="stylesheet" rev="text/css">' . "\n"; ?>
	<link rel="STYLESHEET" type="text/css" href="Style/Yogaroad.css">
	<link rel="STYLESHEET" type="text/css" href="<?echo$styles?>/default.css">
	<script language="JavaScript">
	<!--
	
		function newImage(arg) {
			if (document.images) {
				rslt = new Image();
				rslt.src = arg;
				return rslt;
			}
		}
		
		function changeImages() {
			if (document.images && (preloadFlag == true)) {
				for (var i=0; i<changeImages.arguments.length; i+=2) {
					document[changeImages.arguments[i]].src = changeImages.arguments[i+1];
				}
			}
		}
		
		var preloadFlag = false;
		function preloadImages() {
			if (document.images) {
				lay_Menu_07_over = newImage("<?echo$images;?>/lay_Menu_07-over.gif");
				lay_Menu_09_over = newImage("<?echo$images;?>/lay_Menu_09-over.gif");
				lay_Menu_12_over = newImage("<?echo$images;?>/lay_Menu_12-over.gif");
				lay_Menu_14_over = newImage("<?echo$images;?>/lay_Menu_14-over.gif");
				lay_Menu_17_over = newImage("<?echo$images;?>/lay_Menu_17-over.gif");
				lay_Menu_19_over = newImage("<?echo$images;?>/lay_Menu_19-over.gif");
				preloadFlag = true;
			}
		}
	
	// -->
	</script>
</head>

<body background="<?echo$images;?>/lay_bg.gif" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" ONLOAD="preloadImages();">

<table cellpadding="10" cellspacing="0" border="0" width="750" height="100%" background="<?echo$images;?>/lay_bgLight.gif" align="center">
	<tr valign="top"> 
		<td>

<?
	// I set the default images in main menu
	if ($Fusebox["fuseaction"] == "what") { $link1 = "-over"; } else { $link1 = ""; }
	if ($Fusebox["fuseaction"] == "about") { $link2 = "-over"; } else { $link2 = ""; }
	if ($Fusebox["fuseaction"] == "classes") { $link3 = "-over"; } else { $link3 = ""; }
	if ($Fusebox["fuseaction"] == "beginners") { $link4 = "-over"; } else { $link4 = ""; }
	if ($Fusebox["fuseaction"] == "calendar") { $link5 = "-over"; } else { $link5 = ""; }
	if ($Fusebox["fuseaction"] == "merchandise") { $link6 = "-over"; } else { $link6 = ""; }
?>


<table cellpadding="0" cellspacing="0" border="0" align="center">
	<tr valign="top">
		<td width="190">
			<a name="top" href="<?echo$self;?>?fuseaction=yoga.splash"><img src="<?echo$images;?>/lay_Logo.jpg" width="130" height="147" border="0"></a>
		</td>
		<td width="260" style="padding-top:20px;">
		
			<a href="<?echo$self;?>?fuseaction=yoga.what"
				ONMOUSEOVER="changeImages('lay_Menu_07', '<?echo$images;?>/lay_Menu_07-over.gif'); return true;"
				ONMOUSEOUT="changeImages('lay_Menu_07', '<?echo$images;?>/lay_Menu_07<?echo$link1;?>.gif'); return true;">
				<img name="lay_Menu_07" src="<?echo$images;?>/lay_Menu_07<?echo$link1;?>.gif" WIDTH=182 HEIGHT=31 BORDER=0></a>

			<a href="<?echo$self;?>?fuseaction=yoga.about"
				ONMOUSEOVER="changeImages('lay_Menu_12', '<?echo$images;?>/lay_Menu_12-over.gif'); return true;"
				ONMOUSEOUT="changeImages('lay_Menu_12', '<?echo$images;?>/lay_Menu_12<?echo$link2;?>.gif'); return true;">
				<img name="lay_Menu_12" src="<?echo$images;?>/lay_Menu_12<?echo$link2;?>.gif" WIDTH=182 HEIGHT=31 BORDER=0></a>

			<a href="<?echo$self;?>?fuseaction=yoga.classes"
				ONMOUSEOVER="changeImages('lay_Menu_17', '<?echo$images;?>/lay_Menu_17-over.gif'); return true;"
				ONMOUSEOUT="changeImages('lay_Menu_17', '<?echo$images;?>/lay_Menu_17<?echo$link3;?>.gif'); return true;">
				<img name="lay_Menu_17" src="<?echo$images;?>/lay_Menu_17<?echo$link3;?>.gif" WIDTH=182 HEIGHT=31 BORDER=0></a>

		</td>
		<td width="183" style="padding-top:20px;">
		
			<a href="<?echo$self;?>?fuseaction=yoga.beginners"
				ONMOUSEOVER="changeImages('lay_Menu_09', '<?echo$images;?>/lay_Menu_09-over.gif'); return true;"
				ONMOUSEOUT="changeImages('lay_Menu_09', '<?echo$images;?>/lay_Menu_09<?echo$link4;?>.gif'); return true;">
				<img name="lay_Menu_09" src="<?echo$images;?>/lay_Menu_09<?echo$link4;?>.gif" WIDTH=183 HEIGHT=31 BORDER=0></a>

			<a href="<?echo$self;?>?fuseaction=yoga.calendar"
				ONMOUSEOVER="changeImages('lay_Menu_14', '<?echo$images;?>/lay_Menu_14-over.gif'); return true;"
				ONMOUSEOUT="changeImages('lay_Menu_14', '<?echo$images;?>/lay_Menu_14<?echo$link5;?>.gif'); return true;">
				<img name="lay_Menu_14" src="<?echo$images;?>/lay_Menu_14<?echo$link5;?>.gif" WIDTH=183 HEIGHT=31 BORDER=0></a>
<!-- Commented out 2003-01-06 by Ron Gallant
			<a href="<?echo$self;?>?fuseaction=yoga.merchandise"
				ONMOUSEOVER="changeImages('lay_Menu_19', '<?echo$images;?>/lay_Menu_19-over.gif'); return true;"
				ONMOUSEOUT="changeImages('lay_Menu_19', '<?echo$images;?>/lay_Menu_19<?echo$link6;?>.gif'); return true;">
				<img name="lay_Menu_19" src="<?echo$images;?>/lay_Menu_19<?echo$link6;?>.gif" WIDTH=183 HEIGHT=31 BORDER=0></a>
-->
		</td>
	</tr>
</table>

		<? require("PHPIncludes/calendara.php"); ?>

		<p>&nbsp;</p>
		
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr valign="bottom">
				<td>
				<div class="copyright">
				Copyright &copy; <a href="mailto:<?echo$email?>">Yoga Road</a> 2002<br>
				Design by <a href="http://www.chizeledlight.com/" target="_blank">Chizeled Light</a>
				</div>
				</td>
				<td width="180">
				<a href="#top"><img src="<?echo$images;?>/lay_Lotus.gif" width="98" height="75" border="0"></a>
				</td>
			</tr>
		</table>


		</td>
	</tr>
</table>

</body>
</html>