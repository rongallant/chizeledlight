<?PHP

include ('/www/chizeledlight/myGlobals.php');
		
switch($theme):

	case 'blue':
		include ('/www/chizeledlight/assets/Themes/Blue/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ('/www/chizeledlight/assets/Themes/Blue/dsp_footer.php');
	break;

	case 'green':
		include ('/www/chizeledlight/assets/Themes/Green/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ('/www/chizeledlight/assets/Themes/Green/dsp_footer.php');
	break;

	case 'ribbon':
		include ('/www/chizeledlight/assets/Themes/Ribbon/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ('/www/chizeledlight/assets/Themes/Ribbon/dsp_footer.php');
	break;

	case 'breakfastjava':
		include ('/www/chizeledlight/assets/Themes/BreakfastJava/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ('/www/chizeledlight/assets/Themes/BreakfastJava/dsp_footer.php');
	break;

	default:
		echo "<P>I have no handler for the theme $theme !</P>";
	break;

endswitch;

?>
