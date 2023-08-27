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

	case "View":
		include('dsp_Menu.php');
		include("dsp_View.php");
	break;

	case "Sign":
		$title = 'Chizeled Light - Sign Guestbook';
		include('dsp_Menu.php');
		include("dsp_Sign.php");
	break;

	case "Add":
		include("act_Guestbook.php");
		include("url_View.php");
	break;

	default:
		print "I received a fuseaction called <b>" . $Fusebox["fuseaction"] . "</b> that circuit <b>" . $Fusebox["circuit"] . "</b> does not have a handler for.";
	break;

}
?>