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
*	File Name: pathway.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Display pathway of navigation. Enhanced by Emir Sakic - saka@hotmail.com
**/

$homequery="SELECT name FROM ".$dbprefix."menu WHERE id=1";
$homeresult=$database->openConnectionWithReturn($homequery);
list($home)=mysql_fetch_array($homeresult);

$path = '';
if ((trim($SubMenu)!="")||($SubMenu!=0)){
	$query = "SELECT componentid, link, contenttype, name, id FROM ".$dbprefix."menu WHERE id='$SubMenu'";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$componentid = $row->componentid;
		$mid[$i] =$row->id;
		$name[$i] = $row->name;
		$link[$i] = $row->link;
		$contenttype[$i]=$row->contenttype;
		$i++;
	}

	while ($componentid <> 0){
		$query = "SELECT componentid, name, link, contenttype, id FROM ".$dbprefix."menu WHERE id='$componentid'";
		$result1 = $database->openConnectionWithReturn($query);
		while ($row1 = mysql_fetch_object($result1)){
			$componentid = $row1->componentid;
			$mid[$i]=$row1->id;
			$name[$i] = $row1->name;
			$link[$i] = $row1->link;
			$contenttype[$i]= $row1->contenttype;
			$i++;
		}
	}

	$j = count($name);
	$j--;
	print "<A class=pathway HREF='index.php'>$home</A>  ";
	for ($k = $j; $k >= 0; $k--){
		if ($mid[$k]==$Itemid || empty($Itemid)) {
			$newlink= "  $name[$k]";
		} else if ($contenttype[$k]=="web"){
			$correctLink= eregi("http://", $link);
			if ($correctLink==1){
				$newlink= "<a class=pathway href='$link[$k]' target=_window>$name[$k]</a>";
			}else{
				$newlink="http://$link";
			}
		}else if ($contenttype[$k]=="file"){
			$newlink= " <a class=pathway href='index.php?option=displaypage&Itemid=$mid[$k]&op=file&SubMenu=$mid[$k]'>$name[$k]</a>";
		}else if ($contenttype[$k]=="typed"){
			$newlink= " <a class=pathway href='index.php?option=displaypage&Itemid=$mid[$k]&op=page&SubMenu=$mid[$k]'>$name[$k]</a>";
		}else if ($contenttype[$k]=="mambo"){
			$newlink= "  $name[$k]";
		}

		if ($newlink!="" && (empty($Itemid) || $Itemid==1)) {
			$path .= "$home ";
		} else if ($newlink!=""){
			$path .= "<img src='images/M_images/arrow.gif'> $newlink ";
		}
	}
	echo ("<span class=pathway>$path</span>");
}else{
	$i=0;
	$testquery="SELECT componentid, name, link, contenttype, id FROM ".$dbprefix."menu WHERE id='$Itemid'";
	$testresult=$database->openConnectionWithReturn($testquery);
	list($componentid, $name[$i], $link[$i], $contenttype[$i], $mid[$i])=mysql_fetch_array($testresult);
	$i++;

	while ($componentid <> 0){
		$query = "SELECT componentid, name, link, contenttype, id FROM ".$dbprefix."menu WHERE id='$componentid'";
		$result1 = $database->openConnectionWithReturn($query);
		while ($row1 = mysql_fetch_object($result1)){
			$componentid = $row1->componentid;
			$name[$i] = $row1->name;
			$link[$i]=$row1->link;
			$contenttype[$i]=$row1->contenttype;
			$mid[$i]=$row1->id;
			$i++;
		}
	}
	$j = count($name);
	$j--;

	if (eregi("option", $REQUEST_URI))
		print "<A class=pathway HREF='index.php'>$home</A>  ";
	for ($k = $j; $k >= 0; $k--){
		if ($mid[$k]==$Itemid || empty($Itemid)) {
			$newlink= "  $name[$k]";
		} else if ($contenttype[$k]=="web"){
			$correctLink= eregi("http://", $link);
			if ($correctLink==1){
				$newlink = "<a class=pathway href='$link[$k]' target=_window>$name[$k]</a>";
			}else{
				$newlink ="http://$link";
			}
		}else if ($contenttype[$k]=="file"){
			$newlink= "  <a class=pathway href='index.php?option=displaypage&Itemid=$mid[$k]&op=file&SubMenu=$mid[$k]'>$name[$k]</a>";
		}else if ($contenttype[$k]=="typed"){
			$newlink= "  <a class=pathway href='index.php?option=displaypage&Itemid=$mid[$k]&op=page&SubMenu=$mid[$k]'>$name[$k]</a>";
		}else if ($contenttype[$k]=="mambo"){
			$newlink= "  $name[$k]";
		}

		if ((trim($newlink)=="" && empty($Itemid) && !eregi("option", $REQUEST_URI)) || $Itemid==1) {
			$path .= "$home ";
		} else if (trim($newlink)!=""){
			$path .= "<img src='images/M_images/arrow.gif'> $newlink ";
		}
	}
	echo ("<span class=pathway>$path</span>");
	}?>
