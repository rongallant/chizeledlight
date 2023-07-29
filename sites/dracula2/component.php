<?php 
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	03-02-2003
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: rightComponent.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 18/02/2003
* 	Version #: 4.0.12
*	Comments: Display all modules which are to be displayed on the right.
**/

include('language/'.$lang.'/lang_components.php');

for ($comp_count=0; $comp_count < sizeof($components_array); $comp_count++) {
	
	if($components_array[$comp_count]['position'] == $side){
		$module = $components_array[$comp_count]['module'];
		$id1 = $components_array[$comp_count]['id'];
		$title = $components_array[$comp_count]['title'];
		if ($module == "survey"){
			if ($Itemid == "")
			$Itemid = 1;
			$query1="select ".$dbprefix."poll_menu.pollid AS pollID from ".$dbprefix."poll_menu, ".$dbprefix."poll_desc where ".$dbprefix."poll_menu.menuid='$Itemid' AND ".$dbprefix."poll_desc.pollID=".$dbprefix."poll_menu.pollid AND ".$dbprefix."poll_desc.published=1";
			$result1=$database->openConnectionWithReturn($query1);
			while (list($pollID)=mysql_fetch_array($result1)){
				if (trim($pollID)!="0"){
					$query3 = "SELECT pollTitle FROM ".$dbprefix."poll_desc WHERE pollID='$pollID' and published=1";
					$result3 = $database->openConnectionWithReturn($query3);
					
					while ($row = mysql_fetch_object($result3)){
						$pollTitle = $row->pollTitle;
					}
					if (trim($pollTitle)!=""){
						$query = "SELECT voteid, optionText FROM ".$dbprefix."poll_data WHERE pollid='$pollID' AND optionText <> '' order by voteid";
						$result4 = $database->openConnectionWithReturn($query);
						$j = 0;
						while ($row = mysql_fetch_object($result4)){
							$optionText[$j] = $row->optionText;
							$voters[$j] = $row->voteid;
							$j++;
						}
						$components->survey($pollTitle, $optionText, $pollID, $voters, $title, $dbprefix, $lang, $absolute_path);
						$optionText="";
						echo "<hr>";
					}
				}
			}
		}elseif ($module == "newsarchive"){
			$content="<a href=\"index.php?option=archiveNews&type=News\">"._PAST_NEWS."</a>
				<BR>";
			$components->component($title, $content, $lang);
			echo "<hr>";
		}elseif ($module == "articlearchive"){
			$content="<a href=\"index.php?option=archiveNews&type=Articles\">"._PAST_ARTICLES."</a>
				<BR>";
			$components->component($title, $content, $lang);
			echo "<hr>";
			
		}else if ($module == "login"){
			if ($HTTP_COOKIE_VARS["usercookie"]==""){
				$components->AuthorLogin($title, $lang);
				echo "<hr>";
			}else{
				$cryptSessionID=md5($HTTP_COOKIE_VARS["usercookie"]);
				$query6="SELECT userid FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
				$result6=$database->openConnectionWithReturn($query6);
				if (mysql_num_rows($result6)==0){
					echo "<SCRIPT>document.location.href='index.php?option=logout';</SCRIPT>";
					echo "<hr>";
				}
			}
			
		}else if ($module == "usermenu"){
			if ($HTTP_COOKIE_VARS["usercookie"]!=""){
				$cryptSessionID=md5($HTTP_COOKIE_VARS["usercookie"]);
				$query6="SELECT userid FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
				$result6=$database->openConnectionWithReturn($query6);
				if (mysql_num_rows($result6)!=0){
					$op2="showMenuComponent";
					list($uid)=mysql_fetch_array($result6);
					include ("usermenu.php");
					echo "<hr>";
				}
			}
			
		}else if ($module == "newsfeeds"){
			echo "<div class=componentHeading>&nbsp;$title</div>";
			include("newsfeeds.php");
			echo "<hr>";
		}elseif ($module == "whos_online"){
			include ("whosOnline.php");
			$components->component($title, $content, $lang);
			echo "<hr>";
		}elseif ($module == "main_menu"){
			include ("mainmenu.php");
			echo "<hr>";
		}elseif ($module == "main_menu2"){
                        include ("mainmenu2.php");
                        echo "<hr>";
		}elseif ((substr("$module",0,4))=="mod_"){
			include ("modules/$module.php");
			$components->component($title, $content, $lang);
			echo "<hr>";
		}else {
			$query = "SELECT content FROM ".$dbprefix."component_module WHERE componentid=$id1";
			$result5 = $database->openConnectionWithReturn($query);
			while ($row5 = mysql_fetch_object($result5)){
				$content = $row5->content;
				$components->component($title, $content, $lang);
				echo "<hr>";
			}
		}
	}
}
?>
