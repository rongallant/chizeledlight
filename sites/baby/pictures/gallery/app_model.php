<!-- 
Fuse: app_model
Author: ron@chizeledlight.com
Responsibilities: I am the FuseBox for the application.
 -->

<?PHP
// Global variables for app
$debug = "no";

switch($g):

	default:
		$title = "Chizeled Light - Disney World - July 4, 2000";
		$HeadingLarge = "Walt Disney World";
		$HeadingSmall = "July 4 2000";
		$imgpath = "/other/baby/assets/images/20010824";
		break;

	case 2:
		$title = "Chizeled Light - Disney World - December 4, 2001";
		$HeadingLarge = "Walt Disney World";
		$HeadingSmall = "December 4 2001";
		$imgpath = "disney_20010410";
		break;

	case 3:
		$title = "Chizeled Light - Honeymoon - July 14, 2001";
		$HeadingLarge = "The Honeymoon";
		$HeadingSmall = "July 14 2001";
		$imgpath = "honeymoon_20010415";
		break;

	case 4:
		$title = "Chizeled Light - The New House - June 9, 2001";
		$HeadingLarge = "The New House";
		$HeadingSmall = "June 9, 2001";
		$imgpath = "house_20010609";
		break;

	case 5:
		$title = "Chizeled Light - Jacksonville Zoo - June 4, 2001";
		$HeadingLarge = "Jacksonville Zoo";
		$HeadingSmall = "June 4, 2001";
		$imgpath = "zoo_20010608";
		break;

	case 6:
		$title = "Chizeled Light - Baby Luis";
		$HeadingLarge = "Luis Thomas Gallant";
		$HeadingSmall = "Babtist NICU, Jacksonville, FL";
		$imgpath = "../other/baby/assets/images/20010824/";
		break;

	case 7:
		$title = "Chizeled Light - Photographs";
		$HeadingLarge = "Photographs";
		$HeadingSmall = "Misc";
		$imgpath = "misc";
		break;

endswitch;
?>