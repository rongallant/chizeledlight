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

	case "splash":
		$layout="splash";
		$title="YogaRoad";
		include("dsp_splash.php");
	break;

	case "what":
		$title="Yoga Road - What is Yoga?";
		include("dsp_what.php");
	break;

	case "about":
		$title="Yoga Road - About Yoga Road";
		include("dsp_about.php");
	break;

	case "classes":
		$xfaCalendar = "yoga.calendar";
		$title="Yoga Road - About the Classes";
		include("dsp_classes.php");
	break;

	case "beginners":
		$title="Yoga Road - Beginners Corner";
		include("dsp_beginner.php");
	break;

	case "calendar":
		$title="Yoga Road - Class Calendar";
		include("dsp_calendar.php");
	break;

	case "merchandise":
		$title="Yoga Road - The Merchandise";
		include("dsp_merchandise.php");
	break;

	case "cancel":
		$title="Yoga Road - Order Cancelled";
		include("dsp_cancel.php");
	break;

	case "success":
		$title="Yoga Road - Order Successfull";
		include("dsp_success.php");
	break;

	case "test":
		$title="Yoga Road - Test";
		include("calendar/PHPIncludes/calendara.php");
	break;

	default:
		print "I received a fuseaction called <b>" . $Fusebox["fuseaction"] . "</b> that circuit <b>" . $Fusebox["circuit"] . "</b> does not have a handler for.";
	break;

}

?>