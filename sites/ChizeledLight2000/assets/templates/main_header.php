<?PHP
include($phpRoot . "myGlobals.php");
switch ($theme):

	case 'blue':
		include ($phpRoot . 'assets/Themes/Blue/dsp_header.php');
	break;

	case 'green':
		include ($phpRoot . 'assets/Themes/Green/dsp_header.php');
	break;

	case 'ribbon':
		include ($phpRoot . 'assets/Themes/Ribbon/dsp_header.php');
	break;

	case 'breakfastjava':
		include ($phpRoot . 'assets/Themes/BreakfastJava/dsp_header.php');
	break;

	default:
		echo "<P>I have no handler for the theme ' . $theme . ' !</P>";
	break;

endswitch;
?>
