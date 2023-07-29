<?PHP

switch($theme):

	case 'Blue':
		include ($phpRoot.'assets/Themes/Blue/dsp_footer.php');
	break;

	case 'Green':
		include ($phpRoot.'assets/Themes/Green/dsp_footer.php');
	break;

	case 'Ribbon':
		include ($phpRoot.'assets/Themes/Ribbon/dsp_footer.php');
	break;

	case 'BreakfastJava':
		include ($phpRoot.'/assets/Themes/BreakfastJava/dsp_footer.php');
	break;

	default:
		echo "<P>I have no handler for the theme ".$myTheme.".</P>" ;
	break;

endswitch;

?>

