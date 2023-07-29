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

if ($layout == "chizeledlight") {
	$Fusebox["layoutDir"] = dirname(__FILE__) . "../assets/templates/";
	$Fusebox["layoutFile"] = "dsp_Layout.php";
}
else {
	$Fusebox["layoutDir"] = dirname(__FILE__) . "/";
	$Fusebox["layoutFile"] = "dsp_DefaultLayout.php";
}

?>