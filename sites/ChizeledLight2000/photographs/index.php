<?php include ('/www/chizeledlight/photographs/app_model.php'); ?>

<?php include ('/www/chizeledlight/assets/templates/main_header.php');?>

<?php include ('/www/chizeledlight/photographs/dsp_Menu.php');?>

<?php
// Ron Gallant
if($imgpath == "") {$imgpath = "assets/images/pics";}
if($HeadingLarge == "") {$HeadingLarge = "Photographs";}
if($HeadingSmall == "") {$HeadingSmall = "";}

echo "<H1>$HeadingLarge";
echo "<DIV STYLE=\"font-size:16px;\">$HeadingSmall</DIV>";
echo "</H1>";

// require_once("includes/it.php");
require_once("autogallery.php");

 // handle query-manipulations etc.
 if(!strlen($HTTP_GET_VARS[g])
     OR ($HTTP_GET_VARS[g] > count($multiple))
     OR ($HTTP_GET_VARS[g] <= 0 )) { $g = 1; }

 // get instances
 $ag  = new autogallery($multiple[$g][0], $multiple[$g][1], $multiple[$g][2] );

echo "".$ag->show_jscript("Chizeledlight.com")."";
echo $ag->thumbnail_table(6, 6, $multiple )."";
?>

<?php include ('/www/chizeledlight/assets/templates/main_footer.php');?>