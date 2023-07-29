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

	case "Blue":
		echo dirname(__FILE__);
		include("act_SetBlue.php");
		include("url_HttpReferer.php");
	break;

	case "Green":
		include("act_SetGreen.php");
		include("url_HttpReferer.php");
	break;

	case "Ribbon":
		include("act_SetRibbon.php");
		include("url_HttpReferer.php");
	break;

	case "BreakfastJava":
		include("act_SetBreakfastJava.php");
		include("url_HttpReferer.php");
	break;

	case "DeleteTheme":
		include("act_DeleteTheme.php");
		include("url_HttpReferer.php");
	break;

	case "Redirect":
		include("act_RedirectDefaults.php");
		include("dsp_RedirectFrames.php");
	break;

	case "RedirectTop":
		$layout="chizeledlight";
		$BlankPage="yes";
		include("dsp_RedirectTop.php");
	break;

	default:
		print "I received a fuseaction called <b>" . $Fusebox["fuseaction"] . "</b> that circuit <b>" . $Fusebox["circuit"] . "</b> does not have a handler for.";
	break;

}

?>