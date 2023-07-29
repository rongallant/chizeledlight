<?php
/*
<fusedoc fuse="fbx_Switch.php">
	<responsibilities>
		I am the switch statement that handles the fuseaction, delegating work to various fuses.
	</responsibilities>
	<io>
		<in>
			<string name="$Fusebox['fuseaction']" />
			<string name="$Fusebox['circuit']" />
		</in>
	</io>	
</fusedoc>
*/

switch($Fusebox["fuseaction"]) {

	case 'home':
		$title = "Luis Thomas Gallant - Pictures";
		echo "<H1>Pictures - Thumbnails</H1>";
		include ("dsp_menu.php");
		include ("dsp_Thumbs.php");
	break;

	case 'View':
		$title = "Luis Thomas Gallant - Pictures";
		include ("dsp_Table.php");
	break;

	default:
		print "I received a fuseaction called <b>'" . $Fusebox["fuseaction"] . "'</b> that circuit <b>'" . $Fusebox["circuit"] . "'</b> does not have a handler for.";
	break;
}
?>
