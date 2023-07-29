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

	case "Fusebox.defaultFuseaction":
	case "Splash":
		$layout="blank";
		$title="Blues Guitar Lessons | Jim's Blues School";
		include("dsp_Splash.php");
	break;

	case "Welcome":
		$title="Blues Guitar Lessons | Jim's Blues School | Welcome";
		include("dsp_Welcome.php");
	break;

	case "Lesson-1":
		$title="Blues Guitar Lessons | Jim's Blues School | Lesson 1";
		include("dsp_Lesson-1.php");
	break;

	case "Lesson-2":
		$title="Blues Guitar Lessons | Jim's Blues School | Lesson 2";
		include("dsp_Lesson-2.php");
	break;

	case "Lesson-3":
		$title="Blues Guitar Lessons | Jim's Blues School | Lesson 3";
		include("dsp_Lesson-3.php");
	break;

	case "Info":
		$title="Blues Guitar Lessons | Jim's Blues School | Information";
		include("dsp_Info.php");
	break;

	case "Links":
		$title="Blues Guitar Lessons | Jim's Blues Schoo | Links";
		include("dsp_Links.php");
	break;

	default:
		print "I received a fuseaction called <b>'" . $Fusebox["fuseaction"] . "'</b> that circuit <b>'" . $Fusebox["circuit"] . "'</b> does not have a handler for.";
	break;

}
?>

