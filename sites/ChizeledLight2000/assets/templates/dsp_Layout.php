<?PHP
$currentDir = dirname(__FILE__);
$themeDir = $currentDir . '../Themes';
include ($currentDir . '../../../chizeledlight/myGlobals.php');

switch($theme):

	case 'blue':
		include ($themeDir . '/Blue/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/Blue/dsp_footer.php');
	break;

	case 'green':
		include ($themeDir . '/Green/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/Green/dsp_footer.php');
	break;

	case 'ribbon':
		include ($themeDir . '/Ribbon/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/Ribbon/dsp_footer.php');
	break;

	case 'breakfastjava':
		include ($themeDir . '/BreakfastJava/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/BreakfastJava/dsp_footer.php');
	break;

	default:
		echo "<P>I have no handler for the theme ' . $theme . ' !</P>";
	break;

endswitch;

?>
