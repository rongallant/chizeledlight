<?PHP
switch($theme):

	case 'blue':
		include(__DIR__ . '/../Themes/Blue/dsp_header.php');
		print trim($Fusebox["layout"]);
		include(__DIR__ . '/../Themes/Blue/dsp_footer.php');
	break;

	case 'green':
		include(__DIR__ . '/../Themes/Green/dsp_header.php');
		print trim($Fusebox["layout"]);
		include(__DIR__ . '/../Themes/Green/dsp_footer.php');
	break;

	case 'ribbon':
		include(__DIR__ . '/../Themes/Ribbon/dsp_header.php');
		print trim($Fusebox["layout"]);
		include(__DIR__ . '/../Themes/Ribbon/dsp_footer.php');
	break;

	case 'breakfastjava':
		include(__DIR__ . '/../Themes/BreakfastJava/dsp_header.php');
		print trim($Fusebox["layout"]);
		include(__DIR__ . '/../Themes/BreakfastJava/dsp_footer.php');
	break;

	default:
		echo "<P>I have no handler for the theme $theme !</P>";
	break;

endswitch;
?>
