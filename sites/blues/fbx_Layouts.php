<?php
/*
<fusedoc fuse="fbx_Layouts.php">
	<responsibilities>
		this file contains all the conditional logic for determining which layout file, if any, should be used for this circuit. It should result in the setting of the Fusebox public API variables $Fusebox['layoutDir'] and $Fusebox['layoutFile'] 
	</responsibilities>	
	<io>
		<out>
			<string name="$Fusebox['layoutDir']" />
			<string name="$Fusebox['layoutFile']" />
		</out>
	</io>
</fusedoc>
*/

switch($layout) {
	case "main":
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "lay_Main.php";
	break;

	case "sidebar":
		$Fusebox["layoutDir"] = "assets/themes/sidebar/";
		$Fusebox["layoutFile"] = "lay_Bordered.php";
	break;

	case "blank":
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "lay_Blank.php";
	break;

	default:
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "DefaultLayout.php";
	break;
}

?>

