<?PHP
switch($theme):

	case 'blue':
		include(__DIR__ . '/../Themes/Blue/dsp_header.php');
	break;

	case 'green':
		include(__DIR__ . '/../Themes/Green/dsp_header.php');
	break;

	case 'ribbon':
		include(__DIR__ . '/../Themes/Ribbon/dsp_header.php');
	break;

	case 'BreakfastJava':
		include(__DIR__ . '/../Themes/BreakfastJava/dsp_header.php');
	break;

	default:
		echo "<P>I have no handler for the theme ' . $theme . ' !</P>";
	break;

endswitch;
?>