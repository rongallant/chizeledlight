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

	case "splash":
		$Fusebox["layoutDir"] = "assets/themes/";
		$Fusebox["layoutFile"] = "lay_splash.php";
	break;

	case "main":
		$Fusebox["layoutDir"] = "assets/themes/";
		$Fusebox["layoutFile"] = "lay_main.php";
	break;

	case "blank":
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "fbx_DefaultLayout.php";
	break;

}

?>