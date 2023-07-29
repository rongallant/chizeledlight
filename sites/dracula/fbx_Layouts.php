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

		$Fusebox["layoutDir"] = "assets/theme/";
		$Fusebox["layoutFile"] = "lay_Main.php";

/*
switch($layout) {

	case "main":
		$Fusebox["layoutDir"] = "assets/theme/";
		$Fusebox["layoutFile"] = "lay_Main.php";
	break;

	case "blank":
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "DefaultLayout.php";
	break;

	default:
		$Fusebox["layoutDir"] = "assets/theme/";
		$Fusebox["layoutFile"] = "lay_Main.php";
	break;

}
*/
?>