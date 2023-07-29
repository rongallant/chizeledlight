<?php
/*
<fusedoc fuse="fbx_DefaultLayout.cfm">
	<responsibilities>
		I'm just a typical layout file to show how I can wrap my layout around the content in the variable, fusebox.layout.  The $Fusebox["baseHref"] variable print out a <base> tage when you use Search Engine Safe URLs.  It is required, so please leave it there.
	</responsibilities>	
	<io>
		<in>
			<string name="$Fusebox['layout']" />
		</in>
	</io>
</fusedoc>
*/
?>


<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?echo$title;?></title>
	<link rel="STYLESHEET" type="text/css" href="<?echo$styles?>/default.css">
</head>

<body background="<?echo$images;?>/lay_bg.gif" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">

<table cellpadding="10" cellspacing="0" border="0" width="750" height="100%" background="<?echo$images;?>/lay_bgLight.gif" align="center">
	<tr>
		<td>

<?=trim($Fusebox["layout"]);?>

		</td>
	</tr>
</table>

</body>
</html>