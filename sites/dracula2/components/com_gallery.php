<?
//RSGallery//
############################################
# RSGallery - A Mambo Gallery Component!   #
# Copyright (C) 2003  by  Ronald Smit      #
# Homepage   : mamboserver.homedns.org     #
# Version    : 1.1                         #
# License    : Released under GPL          #
############################################

include('./configuration.php');
include('language/'.$lang.'/lang_com_gallery.php');


//-----------------Variables-----------------------//
$conversiontype	= 2;					//	0. No autothumbnailing, upload prepared thumbnail
										//	1. ImageMagick
										//	2. NETPBM
										//	3. GD
$imagepath 		= "images/gallery/";	//Path from the Mamboroot to the imagelocation. Trailing slash needed!
$IM_path		= "c:/ImageMagick/";	//Exact path to Imagemagick convert.exe. Trailing slash needed
$NETPBM_path		= "/usr/local/apache/htdocs/assets/GalleryAssets/NetPBM/";//Exact path to NETPBM executables. Trailing slash needed(use forward slashes on LINUX-box)
$size			= "100";				//Width of thumbnail in pixels
$JPEGquality		= "75";					//Quality of JPEG conversion
$columns		= 1;					//Number of columns to show
$PageSize 		= 6;					//Number of thumbs per page

$counter		= 0;					//Don't change!
$nbfiles 		= 0;					//Don't change!
$currfile 		= "";					//Don't change!
$file[0] 		= "";					//Don't change!
$isAdmin		= False;				//Don't change!
$isUser    	 	= False;				//Don't change!
$CurrUID		= -1;					//Don't change!
$StartRow 		= 0;					//Don't change!

//----------------End variables-----------------//
//-------Do not edit below this line!!!!--------//

//-------------Functions-----------------//
####################################
#       Function checkAdmin        #
#----------------------------------#
#       Created Arthur Konze       #
#    http://www.mamboportal.com    #
#----------------------------------#
# Checks whether logged in user is #
# admin or not!					   #
####################################

function checkAdmin($database, $db, $dbprefix, $cook, $admin)
	{
  	global $CurrUID;
  	/* Get the visitor's UserType */
  	$utype = "";
  	if ($cook<>"")
		{
    	$cryptSessionID=md5($cook);
    	$queryg = "SELECT usertype, userid FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
    	$resultg = $database->openConnectionWithReturn($queryg);
    	while ($rowg = mysql_fetch_object($resultg))
			{
      		$utype = $rowg->usertype;
      		$CurrUID = $rowg->userid;
    		}
	    if ($admin) 
			{
	      	if ($utype=="administrator" or $utype=="superadministrator")
				{
	        	return true;
	      		}
			else
				{
	        	return false;
	      		}
	     	} 
		else 
			{
	      	if ($utype=="user" or $utype=="editor")
				{
	        	return true;
	      		}
			else 
				{
	        	return false;
	      		}
			}
		}
	}
####################################
#         Function deldir          #
#----------------------------------#
#       Created Ronald Smit        #
#  http://mamboserver.homedns.org  #
#----------------------------------#
# Deletes directory, empty or not! #
####################################
function deldir($dir)
{
 	$current_dir = opendir($dir);
 	while($entryname = readdir($current_dir))
	{
    	if(is_dir("$dir/$entryname") and ($entryname != "." and $entryname!=".."))
		{
       	deldir("${dir}/${entryname}");
    		}
	elseif($entryname != "." and $entryname!="..")
		{
       	unlink("${dir}/${entryname}");
    		}
 		}
 	closedir($current_dir);
 	rmdir(${dir});
}
####################################
#         Function newdir          #
#----------------------------------#
#       Created Ronald Smit        #
#  http://mamboserver.homedns.org  #
#----------------------------------#
# Generates a random directoryname #
####################################
function newdir()
{
$newdir = "";
srand((double) microtime() * 1000000);
for ($acc = 1; $acc <= 6; $acc++) 
	{
    $newdir .= chr(rand (0,25) + 65);
   	}
return $newdir;
}
####################################
#     Function CreateThumbIM       #
#----------------------------------#
#       Created Ronald Smit        #
#  http://mamboserver.homedns.org  #
#----------------------------------#
# Creates thumb with ImageMagick   #
####################################
function CreateThumbIM($in, $out, $size)
	{
	$cmd = $IM_path."convert -resize $size $in $out";
	exec($cmd);
	}
####################################
#   Function CreateThumbNETPBM     #
#----------------------------------#
#       Created Ronald Smit        #
#  http://mamboserver.homedns.org  #
#----------------------------------#
#    Creates thumb with NETPBM     #
####################################
function CreateThumbNETPBM($file,$desfile,$maxsize,$origname,$quality) 
	{ 
	global $NETPBM_path; 
	if($NETPBM_path) 
		{ 
		if(!is_dir($NETPBM_path))
			{ 
			echo "NetPbm path not correct";
			die; 
			} 
		} 
		if (eregi("\.png", $origname))
			{ 
			$cmd = $NETPBM_path . "pngtopnm $file | " . $NETPBM_path . "pnmscale -xysize $maxsize $maxsize | " . $NETPBM_path . "pnmtopng > $desfile" ; 
			}
		else if (eregi("\.(jpg|jpeg)", $origname))
			{ 
			$cmd = $NETPBM_path . "jpegtopnm $file | " . $NETPBM_path . "pnmscale -xysize $maxsize $maxsize | " . $NETPBM_path . "ppmtojpeg -quality=$quality > $desfile" ;
			}
		else if (eregi("\.gif", $origname))
			{ 
			$cmd = $NETPBM_path . "giftopnm $file | " . $NETPBM_path . "pnmscale -xysize $maxsize $maxsize | " . $NETPBM_path . "ppmquant 256 | " . $NETPBM_path . "ppmtogif > $desfile" ; 
			}//end if.. 
	exec($cmd); 
	}
####################################
#     Function CreateThumbGD2      #
#----------------------------------#
#       Created Ronald Smit        #
#  http://mamboserver.homedns.org  #
####################################
function CreateThumbGD2($img_source, $img_dest, $img_quality, $size_limit)
{
if (!file_exists($img_source))
	{
	return(1); //file not found return 1
 	}

 // increase the $size_limit variable by 1 as it is going to be chopped by 1 below
 $size_limit++;

 //load the original image and put its height/width in $img_info
 $img_info = getimagesize($img_source); 

 //$img_info ARRAY KEY
 //0 = width
 //1 = height
 //2 = image type
 //3 = hight and width string
 $orig_height = $img_info[1]; //source height from $img_info
 $orig_width = $img_info[0]; //source width from $img_info

 $jpegQuality = $img_quality; //quality of the JPG

 if(($orig_width > $size_limit) || ($orig_height > $size_limit)) //make sure the image isnt already resized
	{ 
   	if ($orig_height > $orig_width)
    	$scaledown = $orig_height;
 	else
     	$scaledown = $orig_width;

	$newscale = $size_limit / $scaledown; //set the new scale size
   	//calculate the new aspect ratio
   	$new_w = (int)abs($orig_width * $newscale);
   	$new_h = (int)abs($orig_height * $newscale);
  	//create the blank limited-palette image
   	$base_image = imageCreate($new_w, $new_h);
   	//convert and save it to temp.jpg
   	imagejpeg($base_image, './temp.jpg');
  	imagedestroy($base_image);
	//get the image pointer to the temp jpeg
	$image = imageCreateFromJpeg('./temp.jpg');
	// get the image pointer to the original image
   	$imageToResize = imageCreateFromJpeg("./$img_source");
   	//resize the original image over temp.jpg
   	// NOTE: if you have GD2, you could also use imageCopyResampled
   	imageCopyResampled($image, $imageToResize, 0, 0, 0, 0, $new_w, $new_h, $orig_width, $orig_height);
   	$new_image = imageCreate($new_w - 1, $new_h - 1);
   	imagecopy ($new_image, $image, 0, 0, 0, 0, $new_w - 1, $new_h - 1);
	//create the resized image
	imageJpeg($new_image, "./$img_dest", $jpegQuality); //image destination
	imagedestroy($image);
   	imagedestroy($new_image);
  	imagedestroy($imageToResize);
	unlink('./temp.jpg'); //del the temp image file
   	return (2); //completed successfully
 	}
else
 	{
   	return(3); //errors occured
 	}
}

####################################
#     	  Function GetDir          #
#----------------------------------#
#       Created Ronald Smit        #
#  http://mamboserver.homedns.org  #
#----------------------------------#
# Retrieves dirname from db        #
####################################
function GetDir($z)
	{
	$q = "SELECT * FROM ".$dbprefix."gallery WHERE id=$z";
	$xx = $database->openConnectionWithReturn($q);
	$name = mysql_fetch_object($xx);
	$imagedir = $name->catdir;
	return $imagedir;
	}
//----------------End functions-----------------------//
##############################################################
// Check for Admin rights
$isAdmin=checkAdmin($database, $db, $dbprefix, $HTTP_COOKIE_VARS["sessioncookie"], true);

// Check for User rights
if (!$isAdmin) {
  $isUser=checkAdmin($database, $db, $dbprefix, $HTTP_COOKIE_VARS["sessioncookie"], false);
}


switch ($page)
{
case 'edit':
	include('components/rsgallery/edit.php');
	break;
case 'delete':
	include('components/rsgallery/delete.php');
	break;
case 'new':
	include('components/rsgallery/new.php');
	break;
case 'upload':
	include('components/rsgallery/upload.php');
	break;
case 'delpic':
	include('components/rsgallery/delpic.php');
	break;
case 'editpic':
	include('components/rsgallery/editpic.php');
	break;
default:
##############################################################
if (!$catid)
	{
	//No gallery selected, show main screen
	?>
	<CENTER>
	<TABLE BORDER=0 width="100%">
	<TR>
		<TD colspan="3"><span class='articlehead'><? echo _GALLERY_TITLE;?></span></TD>
	</TR>
	<TR>
		<TD colspan="3" align="right">
		
		<?if ($isAdmin)
			{
			echo "<strong>admin</strong><br>";
			echo "[<a href=\"index.php?option=com_gallery&page=new\">"._GALLERY_NEW."</a>]&nbsp;";
			echo "[<a href=\"index.php?option=com_gallery&page=delete\">"._GALLERY_DEL."</a>]<br><br>";
			}
		?>
		
		</TD>
	</TR>
	<?
	//Haal alle categorieen uit de database en echo ze naar het scherm
	$sql = "SELECT * FROM ".$dbprefix."gallery";
	$result = $database->openConnectionWithReturn($sql);
	//$result = mysql_query($sql);
	?>
	<TR>
		<td width="30">&nbsp;</td>
		<TD align="left" width="300" valign="top">
		<form name="selection" method="POST" action="index.php?option=com_gallery">
			<select name="catid" onchange="this.form.submit();">
			<OPTION value="" SELECTED>---&nbsp;<?echo _GALLERY_PICK;?>&nbsp;---</OPTION>
			<?
			while ($row = mysql_fetch_array($result))
				{
				$catid = $row['id'];
				$catname = $row['catname'];
		
				echo "<option value=\"$catid\">$catname</option>";
				}
			?>
			</SELECT>
			</form>
			<?echo _GALLERY_TEXT;?>
		</TD>
		<TD width="100" valign="top">
			<img src="components/rsgallery/gallery.gif" alt="" border="0">
		</TD>
	</TR>
	<?
	//Haal alle categorieen uit de database en echo ze naar het scherm
	$sql = "SELECT * FROM ".$dbprefix."gallery";
	$result = $database->openConnectionWithReturn($sql);
	//$result = mysql_query($sql);
	?>
	<TR>
		<TD colspan="3" align="center">&nbsp;</TD>
	</TR>
	</TABLE>
	<?
	}
else
	{
	$q = "SELECT * FROM ".$dbprefix."gallery WHERE id=$catid";
	$xx = $database->openConnectionWithReturn($q);
	$name = mysql_fetch_object($xx);
	$imagedir = $name->catdir;
	//---------------------Pagination part 1---------------------------//
	
	//Set the page no
	if(empty($_GET['PageNo']))
		{
	    if($StartRow == 0)
			{
	        $PageNo = $StartRow + 1;
	    	}
		}
	else
		{
	    $PageNo = $_GET['PageNo'];
	    $StartRow = ($PageNo - 1) * $PageSize;
		}
	
	//Set the counter start
	if($PageNo % $PageSize == 0)
		{
	    $CounterStart = $PageNo - ($PageSize - 1);
		}
	else
		{
	    $CounterStart = $PageNo - ($PageNo % $PageSize) + 1;
		}
	
	//Counter End
	$CounterEnd = $CounterStart + ($PageSize - 1);
	$TRecord = $database->openConnectionWithReturn("SELECT * FROM ".$dbprefix."galleryfiles WHERE gallery_id=$catid");
	if (!$TRecord) echo _GALLERY_NOPICS;
	$result = @mysql_query("SELECT * FROM ".$dbprefix."galleryfiles WHERE gallery_id=$catid LIMIT $StartRow, $PageSize");
	if (!$result) echo _GALLERY_NOPICS;
 	//Total of record
 	$RecordCount = @mysql_num_rows($TRecord);//Number of files in gallery

 	//Set Maximum Page
 	$MaxPage = $RecordCount % $PageSize;
 	if($RecordCount % $PageSize == 0)
		{
    	$MaxPage = $RecordCount / $PageSize;
 		}
	else
		{
    	$MaxPage = ceil($RecordCount / $PageSize);
 		}
	//------------------------------------------------//
	?>
	<span class='articlehead'><? echo $name->catname;?></span>
	<CENTER>
	<TABLE cellpadding="3" cellspacing="0" border="0" width="100%">
	<TR>
		<TD>
		<a href="index.php?option=com_gallery">
		<img src="components/rsgallery/home.gif" alt="<?echo _GALLERY_BACK;?>" border="0">&nbsp;&nbsp;<?echo _GALLERY_BACK;?>
		</a>
		</TD>
		<TD  COLSPAN="<?echo $columns-1?>" align="right" nowrap>
		<?if ($isAdmin) 
			{
			echo "<strong>admin</strong><br>";
			echo "[<a href=\"index.php?option=com_gallery&page=upload&id=$catid\">"._GALLERY_UPLOAD."</a>]&nbsp;";
			echo "[<a href=\"index.php?option=com_gallery&page=edit&catid=$catid\">"._GALLERY_EDIT."</a>]&nbsp;";
			}
			?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN="<?echo $columns?>" align="center">
		<? 
		if ($RecordCount != 0)
			{
			echo $RecordCount." photos - Page ".$PageNo." of ".$MaxPage;
			}
		else
			{
			echo _GALLERY_NOIMG;
			}
			?>
			<br><br>
		</TD>
	</TR>
	<TR>
	<?
	//
	$i = 1;
	$sql1 = "SELECT * FROM ".$dbprefix."galleryfiles WHERE gallery_id = $catid LIMIT $StartRow, $PageSize";
	$result1 = $database->openConnectionWithReturn($sql1);
	while ($row = mysql_fetch_object($result1))
		{
		//Teller om aantal per rij te tellen
		$count++;
		$bil = $i + ($PageNo-1)*$PageSize;
		$size = getimagesize("images/gallery/$imagedir/$row->name");
		?>
		<td>
		<? //added table and discription - Ron Gallant - 2003-09-12 ?>
		<table><tr>
		<td width="110" height="110" bgcolor="#f5f5f5" align="center">
<A HREF="#" onClick="window.open('components/rsgallery/view.php?<? echo "picdir=$imagedir&name=$row->name&xwidth=$size[0]&ywidth=$size[1]&id=$row->id";?>', 'win1', 'width=620, height=600')"><img border="1" alt="<?echo $row->descr;?>" src="<?echo $imagepath.$imagedir."/thumbs/".$row->name;?>"></A>
		</td>
		<td>
		<?//echo $row->name;?>
		<?echo $row->descr;?>
		</td>
		</tr></table>
		<?
		if ($isAdmin)
			{
			echo "<br>[<A HREF=\"index.php?option=com_gallery&page=delpic&id=$row->id&imdir=$imagedir\">"._GALLERY_DELETE."</A>]&nbsp;[<A HREF=\"index.php?option=com_gallery&page=editpic&id=$row->id&imdir=$imagedir\">"._GALLERY_EDITPIC."</A>]";
			}
		?>
		</td>
		<?
		if ($count % $columns == 0) 
			{ 
			echo "</tr><tr>"; 
			}
		$i++;
		}
	?>


	</TR>
	<TR>
		<TD COLSPAN="<?echo $columns?>" align="center">
		<?
		//--------------------------------------------------------//
        //Print First & Previous Link is necessary
        if($CounterStart != 1)
			{
            $PrevStart = $CounterStart - 1;
            print "<a href=index.php?option=com_gallery&catid=$catid&PageNo=1>First </a>: ";
            print "<a href=index.php?option=com_gallery&catid=$catid&PageNo=$PrevStart>Previous </a>";
        	}
        //print " [ ";
        $c = 0;

        //Print Page No
        for($c=$CounterStart;$c<=$CounterEnd;$c++){
            if($c < $MaxPage){
                if($c == $PageNo){
                    if($c % $PageSize == 0){
                        print "<strong>$c</strong> ";
                    }else{
                        print "<strong>$c</strong> - ";
                    }
                }elseif($c % $PageSize == 0){
                    echo "<a href=index.php?option=com_gallery&catid=$catid&PageNo=$c><strong>$c</strong></a> ";
                }else{
                    echo "<a href=index.php?option=com_gallery&catid=$catid&PageNo=$c><strong>$c</strong></a> - ";
                }//END IF
            }else{
                if($PageNo == $MaxPage){
                    print "<strong>$c</strong> ";
                    break;
                }else{
                    echo "<a href=index.php?option=com_gallery&catid=$catid&PageNo=$c><strong>$c</strong></a> ";
                    break;
                }//END IF
            }//END IF
       }//NEXT

      //echo "] ";

      if($CounterEnd < $MaxPage){
          $NextPage = $CounterEnd + 1;
          echo "<a href=index.php?option=com_gallery&catid=$catid&PageNo=$NextPage>Next</a>";
      }

      //Print Last link if necessary
      if($CounterEnd < $MaxPage){
       $LastRec = $RecordCount % $PageSize;
        if($LastRec == 0){
            $LastStartRecord = $RecordCount - $PageSize;
        }
        else{
            $LastStartRecord = $RecordCount - $LastRec;
        }

        print " : ";
        echo "<a href=index.php?option=com_gallery&catid=$catid&PageNo=$MaxPage>Last</a>";
        }
      ?>
      </div>
<?php
    @mysql_free_result($result);
    @mysql_free_result($TRecord);
		//--------------------------------------------------------//
		?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN="<?echo $columns?>" align="center">
		<!--<a href="index.php?option=com_gallery">
		<img src="components/rsgallery/home.gif" alt="<?echo _GALLERY_BACK;?>" border="0">&nbsp;&nbsp;<?echo _GALLERY_BACK;?>
		</a>-->
		</TD>
	</TR>
	</TABLE><br><br>		
	<?
	}
}
?>
