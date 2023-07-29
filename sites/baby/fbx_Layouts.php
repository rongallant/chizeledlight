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

	default:
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "lay_DefaultLayout.php";
	break;

	case "baby":
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "lay_baby.php";
	break;

	case "no":
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "lay_DefaultLayout.php";
	break;

	}
?>