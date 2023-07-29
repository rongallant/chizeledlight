<?php
  /*
  * Topic:     Generating a thumbnail gallery
  * Author:    Urs Gehrig urs@circle.ch
  * Date:      07-04-2001
  * Version:   0.2.0
  *
  * Copyright: Copyright (c) 2001 by Urs Gehrig
  *
  * History:   [07-04-2001] Version 0.2.0
  *            [02-04-2001] Version 0.1.0
  *
  * API:       Here a minimal set of code, to generate a gallery:
  *
  *            require_once("includes/autogallery.inc");
  *
  *            // define galleries; always start with an index of 1!
  *            $multiple = array(
  *                1 => array("cache", "images/2001", "images/frame.png", "Gallery 1" ),
  *                2 => array("cache", "images/2002", "images/frame.png", "Gallery 2" ),
  *            );
  *
  *            // handle query-manipulations etc.
  *            if(!strlen($HTTP_GET_VARS[g])
  *                OR ($HTTP_GET_VARS[g] > count($multiple))
  *                OR ($HTTP_GET_VARS[g] <= 0 )) { $g = 1; }
  *
  *            // get instances
  *            $ag  = new autogallery($multiple[$g][0], $multiple[$g][1], $multiple[$g][2] );
  *
  *            echo "<html><head>".$ag->show_jscript("autogallery")."</head><body>";
  *            echo $ag->thumbnail_table(3, 2, $multiple )."</body></html>";
  */

  class autogallery {

// Class constructor
// @param    $path, $src, $tpl

      function autogallery($path="cache", $src="images/2001", $tpl="images/frame.png" ) {

          $this->path    = $path;
          $this->src     = $src;
          $this->tpl     = $tpl;

          $this->page    = "p";
          $this->gallery = "g";
          $this->prefix  = sprintf("%s_", substr(md5($this->src ), 0, 6 ) );
          $this->idxfile = sprintf("_%s.txt", md5($this->src ) );

          $this->resize();
          $this->checkup();
      }

      function show_jscript($pagetitle="autogallery" ) {
          global $SERVER_NAME, $SERVER_PORT, $PHP_SELF;

          $host = "http://" . $SERVER_NAME . ($SERVER_PORT == 80 ? "" : ":$SERVER_PORT")
                                    . (strlen($PHP_SELF) ? "" . str_replace(basename($PHP_SELF), "", $PHP_SELF ) : "");

          $str .= "\n<script language=\"JavaScript\">\n";
          $str .= "<!--\n";
          $str .= "function popup (img,sx,sy,num) {\n";
          $str .= "    image = \"<a href='javascript:self.close()'><img src=\" + img + \" border=0 alt='Click to Close'></a>\";\n";
          $str .= "    popupwin=window.open(\"\",\"image_\"+num,\"toolbar=no,location=no,directories=no,status=no,menubar=no,top=10,left=10,width=\"+sx+\",height=\"+sy+\"\");\n";
          $str .= sprintf("    popupwin.document.write(\"<HTML><HEAD><TITLE>%s</TITLE><BASE HREF=\\\"%s\\\"></HEAD><BODY BGCOLOR=#FFFFFF><CENTER>\" + image + \"</CENTER></BODY></HTML>\");\n", $pagetitle, $host );
          $str .= "    popupwin.document.close();\n";
          $str .= "}\n";
          $str .= "\n";
          $str .= "function go_menu(menu) {\n";
          $str .= "    choice = menu.selectedIndex;\n";
          $str .= "    if (menu.options[choice].value != \"\") {\n";
          $str .= "        window.location.href = menu.options[choice].value;\n";
          $str .= "    }\n";
          $str .= "}\n";
          $str .= "// -->\n";
          $str .= "</script>\n";

          return $str;
      }

// Construct a selection menu based on an array passed to the method
// @param array $multiple
		/*
      function select_gallery($multiple=array() ) {
          global $HTTP_GET_VARS;

          // reset page-index to page 1
          $HTTP_GET_VARS[$this->page] = 0;

		// construct selection-form
		$str .= "\n<form name=\"navigator\" method=\"get\">\n";
		$str .= "<select name=navMenu style=\"width:150; font:9pt\" onChange=\"return go_menu(navigator.navMenu);\" size=\"1\">\n";
		$str .= "<option selected>select ...</option>\n";
		for($i=1; $i<=count($multiple); $i++) {
		    $str .= sprintf("<option value=\"?%s\">%s</option>\n",
		            $this->url($this->gallery, "$this->gallery=$i" ),
		            $multiple[$i][3]
		            );
		}
		$str .= "</select>\n";
		$str .= "</form>\n\n";

          return $str;
      }
		*/

// Resizes jp(e)g files within the $src-directory and stores
// the thumbnails in the $path-directory by adding a "_" to the filename.


      function resize() {

          $count = 0;

          $d = dir($this->src );
          $fp = fopen("$this->path/$this->idxfile", "a+" );

          while($entry=$d->read() ) {
              if(eregi(".+\.jp[e]{0,1}g$", $entry )) {

                  if(!file_exists("$this->path/_$this->prefix$entry" )) {
                      $src = ImageCreateFromJPEG("$d->path/$entry" );

                      $org_h = imagesy($src );
                      $org_w = imagesx($src );

                      if($org_h > $org_w ) {
                          $cfg[height] = 50;
                          $cfg[width]  = floor($cfg[height] * $org_w / $org_h );
                          $cfg[dstX]   = 25 - ($cfg[width] * 0.5);
                          $cfg[dstY]   = 0;
                      } else {
                          $cfg[width]  = 50;
                          $cfg[height] = floor($cfg[width] * $org_h / $org_w );
                          $cfg[dstX]   = 0;
                          $cfg[dstY]   = 25 - ($cfg[height] * 0.5);
                      }

                      $img = ImageCreateFromPNG($this->tpl );
                      ImageCopyResized($img, $src, $cfg[dstX], $cfg[dstY], 0, 0, $cfg[width], $cfg[height], $org_w, $org_h );
                      ImageJPEG($img, "$this->path/_$this->prefix$entry", 90 );
                      ImageDestroy($img );

                      // create an index file with "thumbnailfile, filename, width, height"
                      if(!strstr(join("", file("$this->path/$this->idxfile") ), $entry )) {
                          fwrite($fp, "_$this->prefix$entry,$entry,$org_w,$org_h"."\n", strlen("_$this->prefix$entry,$entry,$org_w,$org_h"."\n" ));
                      }
                  }
              }
          }

          fclose($fp);
          $d->close();
      }


// clean-up cache images where there is no original image and update indexlist

      function checkup() {

          // get the current indexfile
          $idx = file("$this->path/$this->idxfile" );
          $i=0;

          // make a reference string
          $d = dir($this->src );
          while($entry=$d->read() ) {
              $ref_idx .= "$entry,";
          }
          $d->close();

          // crosscheck for obsolete thumbnails
          for($f=0; $f<count($idx); $f++) {
              $items = explode(",", $idx[$f] );

              if(strstr($ref_idx, trim($items[1]) )) {
                  $new_idx[$i++] = trim($idx[$f])."\n";
              } else {
                  if(file_exists("$this->path/".$items[0])) unlink("$this->path/".$items[0] );
              }
          }

          // update indexfile
          $fp = fopen("$this->path/$this->idxfile", "w+" );
          for($k=0; $k<count($new_idx); $k++) {
              fwrite($fp, trim($new_idx[$k])."\n", strlen(trim($new_idx[$k])."\n" ));
          }
          fclose($fp);
      }


// Make an html table with thumbnail-links
// @param     $cols, $rows, $multiple

      function thumbnail_table($cols=3, $rows=3, $multiple=array() ) {
          global $HTTP_GET_VARS, $PHP_SELF, $QUERY_STRING;
          // get indexfile
          $idx = file("$this->path/$this->idxfile");
          // calculate start and end of page index
          $cfg[start] = $HTTP_GET_VARS[$this->page] * $cols * $rows;
          $cfg[stop]  = ($HTTP_GET_VARS[$this->page] + 1 ) * $cols * $rows;
			$table .= "\n<!-- image gallery -->\n";
			$table .= "<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" align=\"center\" width=\"100%\">\n<tr>\n";
			// $table .= "<tr><td colspan=$cols align=\"right\">" . $this->select_gallery($multiple ) . "</td>\n<tr>\n";
          // construct table
          for($j=$cfg[start]; $j<$cfg[stop]; $j++ ) {
              $itemlist = explode(",", $idx[$j] );
              if(eregi(".+\.jp[e]{0,1}g$", $itemlist[1] )) {
                  $table .= sprintf("<td align=\"center\"><a href=\"javascript:popup('%s',%s,%s,$j);\"><img src=\"%s\" alt=\"Click\" border=\"0\"></a></td>\n",
                            "$this->src/".$itemlist[1],
                            $itemlist[2]+20,
                            $itemlist[3]+20,
                            "$this->path/".$itemlist[0] );
                  $k++;
                  if($k == $cols ) {
                      $table .= "</tr>\n<tr>\n";
                      $k = 0;
                  }
              }
          }
          $table .= "</tr>\n<tr><td colspan=\"$cols\" align=\"center\">";

// create page index
		for($n=0, $l=0; $n<count($idx); $n=$n+($cols*$rows) ) {
			$table .= sprintf("<a href=\"?%s\">%s</a>\n", $this->url($this->page, "$this->page=$l" ), ++$l );
			}

		$table .= "</td></tr>\n</table>\n";
		return $table;
	}



// Proper handling of query-string to make this script
// application-independent and easy-integratable.
// @param $index, $addon

      function url($index="page", $addon="" ) {
          global $HTTP_GET_VARS;
          foreach($HTTP_GET_VARS as $key => $val ) {
              $q[$key] = $val;
          }
          if(is_array($q )) {
              // remove $index element from the list
              unset($q[$index]);
              // create new query-string
              foreach($q as $key => $val ) {
                  $str .= "$key=$val&";
              }
              return $str . $addon;
          } else {
              return $addon;
          }
      }

  }
?>