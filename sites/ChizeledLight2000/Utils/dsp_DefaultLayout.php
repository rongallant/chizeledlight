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


if($Fusebox["isHomeCircuit"]) {
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
	<html>
	<head>
		<title></title>
	<?=$Fusebox["baseHref"];?>
	</head>
	<body bgcolor="#ffffff">
	<?=trim($Fusebox["layout"]);?>
	</body>
	</html>
	<?php
	} else {
		print trim($Fusebox["layout"]);
	}	
?>

