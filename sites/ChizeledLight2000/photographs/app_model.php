<?PHP
/*
Fuse: app_model
Author: ron@chizeledlight.com
Responsibilities: I am the FuseBox for the application.
*/

// Global variables for app

$debug = "no";

 // define galleries; always start with an index of 1!
 $multiple = array(
12 => array("cache", "pics/20020318_Luis/", "assets/images/frame_1.png", "Luis" ),
11 => array("cache", "pics/20020319_NewHouse/", "assets/images/frame_1.png", "New House" ),
10 => array("cache", "pics/StAugustine2001-12-15/", "assets/images/frame_1.png", "St Augustine 2001" ),
9 => array("cache", "pics/tree_20011208/", "assets/images/frame_1.png", "Christmas Tree 2001" ),
8 => array("cache", "pics/disney_20001204/", "assets/images/frame_1.png", "Disney World 2000" ),
7 => array("cache", "pics/disney_20010410/", "assets/images/frame_1.png", "Disney World 2001" ),
6 => array("cache", "pics/zoo_20010608/", "assets/images/frame_1.png", "Alligator Farm" ),
5 => array("cache", "pics/wedding_20010414/", "assets/images/frame_1.png", "The Wedding 2001" ),
4 => array("cache", "pics/honeymoon_20010416/", "assets/images/frame_1.png", "The Honeymoon" ),
3 => array("cache", "pics/house_20010609/", "assets/images/frame_1.png", "The New House" ),
2 => array("cache", "pics/miata_20011008/", "assets/images/frame_1.png", "1991 Mazda Miata" ),
1 => array("cache", "pics/misc/", "assets/images/frame_1.png", "Misc" )
);

switch($g):

	default:
		$title = "Chizeled Light - Luis  - March 18, 2002";
		$HeadingLarge = "Luis";
		$HeadingSmall = "March 18, 2002";
		$imgpath = "pics/20020318_Luis";
		break;

	case 11:
		$title = "Chizeled Light - New House  - March 19, 2002";
		$HeadingLarge = "New House";
		$HeadingSmall = "March 19, 2002";
		$imgpath = "pics/20020319_NewHouse";
		break;

	case 10:
		$title = "Chizeled Light - St Augustine  - December 15, 2001";
		$HeadingLarge = "St Augustine";
		$HeadingSmall = "December 15, 2001";
		$imgpath = "pics/StAugustine2001-12-15";
		break;

	case 9:
		$title = "Chizeled Light - Christmas Tree - December 8, 2001";
		$HeadingLarge = "Christmas Tree";
		$HeadingSmall = "December 8, 2001";
		$imgpath = "pics/tree_20011208";
		break;

	case 8:
		$title = "Chizeled Light - Disney World - April 6, 2000";
		$HeadingLarge = "Walt Disney World";
		$HeadingSmall = "April 6, 2000";
		$imgpath = "pics/disney_20001204";
		break;

	case 7:
		$title = "Chizeled Light - Disney World - April 4, 2001";
		$HeadingLarge = "Walt Disney World";
		$HeadingSmall = "December 4 2001";
		$imgpath = "pics/disney_20010410";
		break;

	case 6:
		$title = "Chizeled Light - Alligator Farm - April 4, 2001";
		$HeadingLarge = "Alligator Farm";
		$HeadingSmall = "April 4, 2001";
		$imgpath = "pics/zoo_20010608";
		break;

	case 5:
		$title = "Chizeled Light - Wedding - April 14, 2001";
		$HeadingLarge = "The Wedding";
		$HeadingSmall = "April 14, 2001";
		$imgpath = "pics/wedding_20010414";
		break;

	case 4:
		$title = "Chizeled Light - Honeymoon - April 14-16, 2001";
		$HeadingLarge = "The Honeymoon";
		$HeadingSmall = "April 14-16, 2001";
		$imgpath = "pics/honeymoon_20010416";
		break;

	case 3:
		$title = "Chizeled Light - The New House - June 9, 2001";
		$HeadingLarge = "The New House";
		$HeadingSmall = "June 9, 2001";
		$imgpath = "pics/house_20010609";
		break;

	case 2:
		$title = "Chizeled Light - 1991 Mazda Miata";
		$HeadingLarge = "1991 Mazda Miata";
		$HeadingSmall = "My Baby";
		$imgpath = "pics/miata_20011008";
		break;

	case 1:
		$title = "Chizeled Light - Photographs";
		$HeadingLarge = "Photographs";
		$HeadingSmall = "Misc";
		$imgpath = "pics/misc";
		break;

endswitch;
?>