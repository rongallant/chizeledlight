<?
switch($theme):

	case 'blue':
		$size = "width=450";
	break;

	case 'green':
		$size = "width=450";
	break;

	case 'ribbon':
		$size = "width=400";
	break;

	case 'breakfastjava':
		$size = "width=400";
	break;

	default:
		$size = "width=400";
	break;

endswitch;

$self = "baby.php";
$layout = "chizeledlight";
include(__DIR__ . '/../baby/pictures/index.php');
?>
