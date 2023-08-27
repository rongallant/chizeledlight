<?PHP
include($phpRoot . "myGlobals.php");
switch($theme):

	case 'blue':
		include ($phpRoot.'assets/Themes/Blue/dsp_footer.php');
	break;

	case 'green':
		include ($phpRoot.'assets/Themes/Green/dsp_footer.php');
	break;

	case 'ribbon':
		include ($phpRoot.'assets/Themes/Ribbon/dsp_footer.php');
	break;

	case 'breakfastjava':
		include ($phpRoot.'/assets/Themes/BreakfastJava/dsp_footer.php');
	break;

	default:
		echo "<P>I have no handler for the theme ' . $theme . ' !</P>";
	break;

endswitch;

?>

