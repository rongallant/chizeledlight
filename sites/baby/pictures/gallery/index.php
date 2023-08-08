<?php
  include ('/www/chizeledlight/photographs/app_model.php');
  include ('/www/chizeledlight/assets/templates/main_header.php');

  // Ron Gallant
  if($imgpath == "") {$imgpath = "assets/images/pics";}
  if($HeadingLarge == "") {$HeadingLarge = "Photographs";}
  if($HeadingSmall == "") {$HeadingSmall = "";}

  echo "<H1>$HeadingLarge";
  echo "<DIV STYLE=\"font-size:16px;\">$HeadingSmall</DIV>";
  echo "</H1>";

  require_once("/www/chizeledlight/photographs/includes/it.inc");
  require_once("/www/chizeledlight/photographs/includes/autogallery.inc");

  // define galleries; always start with an index of 1!
  $multiple = array(1 => array(
    "cache",
    "/other/baby/assets/images/20010824/",
    "/www/chizeledlight/photographs/images/frame.png",
    "Luis"
  ));

 // handle query-manipulations etc.
 if(!strlen($_GET[g]) OR ($_GET[g] > count($multiple)) OR ($_GET[g] <= 0 )) {
    $g = 1;
  }

  // get instances
  $ag  = new autogallery($multiple[$g][0], $multiple[$g][1], $multiple[$g][2] );

  $tpl = new IntegratedTemplate("templates/");

  echo "".$ag->show_jscript("circle.ch / autogallery")."";
  echo $ag->thumbnail_table(6, 6, $multiple )."";

  include ('/www/chizeledlight/assets/templates/main_footer.php');
?>
