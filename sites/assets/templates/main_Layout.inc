<?PHP

include ('/www/chizeledlight/myGlobals.php');
		
switch($theme):

	case Blue:
		include ('/www/chizeledlight/assets/Themes/Blue/dsp_header.php');
	break;

	case Green:
		include ('/www/chizeledlight/assets/Themes/Green/dsp_header.php');
	break;

	case Ribbon:
		include ('/www/chizeledlight/assets/Themes/Ribbon/dsp_header.php');
	break;

	case BreakfastJava:
		include ('/www/chizeledlight/assets/Themes/BreakfastJava/dsp_header.php');
	break;

	default:
		echo "<P>I have no handler for the theme $theme</P>";
	break;

endswitch;

?>