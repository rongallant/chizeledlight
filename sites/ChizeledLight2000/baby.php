<?

switch($theme):

	case 'Blue':
		$size = "width=450";
	break;

	case 'Green':
		$size = "width=450";
	break;

	case 'Ribbon':
		$size = "width=400";
	break;

	case 'BreakfastJava':
		$size = "width=400";
	break;

	default:
		$size = "width=400";
	break;

endswitch;

$self = "baby.php";
$layout = "chizeledlight";

include('../baby/pictures/index.php');

?>
