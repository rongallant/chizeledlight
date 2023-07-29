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

if($Fusebox["isHomeCircuit"]) {

switch($layout) {

	case chizeledlight:
		include ('/www/chizeledlight/myGlobals.php');
		$Fusebox["layoutDir"] = "./../assets/templates/";
		$Fusebox["layoutFile"] = "dsp_Layout.php";
	break;

	case no:
		include ('/www/chizeledlight/myGlobals.php');
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "fbx_DefaultLayout.php";
	break;

	default:
		include ('/www/chizeledlight/myGlobals.php');
		$Fusebox["layoutDir"] = "";
		$Fusebox["layoutFile"] = "fbx_DefaultLayout.php";
	break;

	}

}
?>