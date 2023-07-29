<?PHP
include($phpRoot. "myGlobals.php");

switch ($theme):

	case 'Blue':
		include ($phpRoot . 'assets/Themes/Blue/dsp_header.php');
	break;

	case 'Green':
		include ($phpRoot . 'assets/Themes/Green/dsp_header.php');
	break;

	case 'Ribbon':
		include ($phpRoot . 'assets/Themes/Ribbon/dsp_header.php');
	break;

	case 'BreakfastJava':
		include ($phpRoot . 'assets/Themes/BreakfastJava/dsp_header.php');
	break;

	default:
		echo "<P>I have no handler for the theme.</P>";
	break;

endswitch;
?>
