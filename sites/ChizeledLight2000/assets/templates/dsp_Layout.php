<?PHP

$currentDir = dirname(__FILE__);
$themeDir = $currentDir . '../Themes';
include ($currentDir . '../../../chizeledlight/myGlobals.php');
		
switch($theme):

	case 'Blue':
		include ($themeDir . '/Blue/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/Blue/dsp_footer.php');
	break;

	case 'Green':
		include ($themeDir . '/Green/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/Green/dsp_footer.php');
	break;

	case 'Ribbon':
		include ($themeDir . '/Ribbon/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/Ribbon/dsp_footer.php');
	break;

	case 'BreakfastJava':
		include ($themeDir . '/BreakfastJava/dsp_header.php');
		print trim($Fusebox["layout"]);
		include ($themeDir . '/BreakfastJava/dsp_footer.php');
	break;

	default:
		echo "<P>I have no handler for the theme $theme !</P>";
	break;

endswitch;

?>
