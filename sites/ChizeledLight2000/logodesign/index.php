<?PHP /*
<fusedoc fuse="index" specification="2.0" language="PHP">
	<responsibilities>I display a menu and pages with text on each one.</responsibilities> 
	<properties>
		<history author="Ron Gallant" email="ron@chizeledlight.com" date="" role="architect" type="create" /> 
	</properties>
</fusedoc>
*/

// Global variables for app
	include ('myGlobals.php');
	$debug = "no";
	if ($FuseAction == ""){$FuseAction = "home";}

switch($FuseAction):

	case home:
		$title = "Chizeled Light - Logo Design";
		include ('/www/chizeledlight/assets/templates/main_header.php');
		include ("dsp_menu.php");
		echo "<H1>Logo Design</H1>";
		include ("dsp_Thumbs.php");
		include ('/www/chizeledlight/assets/templates/main_footer.php');
		break;

	case View:
		$title = "Chizeled Light - Logo Design";
		include ('/www/chizeledlight/assets/templates/main_header.php');
		echo "<H1>Logo Design</H1>";
		include ("dsp_Table.php");
		include ('/www/chizeledlight/assets/templates/main_footer.php');
		break;

	default:
		$title = "Fuse Action Error";
		include ("/www/chizeledlight/other/baby/assets/templates/baby_header.html");
		echo "I do not have a handeler for the FuseAction &quot; <B>$FuseAction</B> &quot";
		include ('/www/chizeledlight/assets/templates/main_footer.php');
		break;

endswitch;

?>
