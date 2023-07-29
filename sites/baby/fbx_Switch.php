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

	case "home":
	case "Fusebox.defaultFuseaction":
		$title = "Luis Thomas Gallant";
		$XFA['ViewEntry'] = "baby.getdate";
		$XFA['EditEntry'] = "admin.Edit";
		$XFA['DeleteEntry'] = "admin.DeleteEntry";
		$XFA['ViewPhoto'] = "pics.View";
		include("PaginateIt.php");
		include("qry_home.php");
		include("dsp_home.php");
	break;

	case "menu":
		$title = "Luis Thomas Gallant - History";
		$XFA['ViewEntry'] = "baby.getdate";
		$XFA['ViewPhoto'] = "pics.View";
		include("qry_DateMenu.php");
		include("dsp_DateMenu.php");
	break;

	case "getdate":
		$title = "Luis Thomas Gallant - History";
		include("qry_GetDate.php");
		include("dsp_GetDate.php");
	break;

	case "belly":
		$title = "Luis Thomas Gallant - The Belly";
		include("dsp_belly.php");
	break;

	case "mommy":
		$title = "Luis Thomas Gallant - Mommy";
		include("dsp_mommy.php");
	break;

	case "daddy":
		$title = "Luis Thomas Gallant - Daddy";
		include("dsp_daddy.php");
	break;

	case "bigsister":
		$title = "Luis Thomas Gallant - Big Sister";
		include("dsp_bigsister.php");
	break;

	case "babystuff":
		$title = "Luis Thomas Gallant - Baby Stuff";
		include("dsp_babystuff.php");
	break;

	default:
		print "I received a fuseaction called <b>'" . $Fusebox["fuseaction"] . "'</b> that circuit <b>'" . $Fusebox["circuit"] . "'</b> does not have a handler for.";
	break;
}

?>