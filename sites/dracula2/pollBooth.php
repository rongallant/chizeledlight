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
*	File Name: pollBooth.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Retrieve and display poll information.
**/
include("configuration.php");
include('language/'.$lang.'/lang_poll.php');
include("regglobals.php");

require ("classes/html/poll.php");
$poll = new poll();
$cookiename="voted".$polls;
$cook = $HTTP_COOKIE_VARS["$cookiename"];
switch ($task){
	case "Vote":
	addvote($voteID, $cook, $polls, $dbprefix);
	break;
	case "Results":
	pollresult($database, $dbprefix, $poll, $view, $polls, $month);
	break;
}

function addvote($voteID, $cook, $pollID, $dbprefix){
	if ($database==""){
		require("classes/database.php");
		$database = new database();
		}
	global $sessioncookie;
	if (empty($sessioncookie)) {
		print "<SCRIPT>alert(\""._ALERT_ENABLED."\"); window.history.go(-1);</SCRIPT>\n";
	} else {
		if($cook == "1") {
			print "<SCRIPT> alert(\""._ALREADY_VOTE."\"); window.history.go(-1);</SCRIPT>\n";
		}
		else {
			if ($voteID == 0){
				print "<SCRIPT>alert(\""._NO_SELECTION."\"); window.history.go(-1);</SCRIPT>\n";
			}
			$cvalue = "1";
			$cookiename="voted".$pollID;
			setcookie("$cookiename", $cvalue, time()+87640);
		}

		if($cook == "") {
			if ($voteID > 0) {
				$query = "UPDATE ".$dbprefix."poll_data SET optionCount=optionCount + 1 WHERE pollid='$pollID' AND voteid='$voteID'";
				$database->openConnectionNoReturn($query);
				$voters = $voters + 1;
				$query = "UPDATE ".$dbprefix."poll_desc SET voters=voters + 1 WHERE pollID='$pollID'";
				$database->openConnectionNoReturn($query);

				$today = date("Y-m-d G:i:s");
				$query = "INSERT INTO ".$dbprefix."poll_date SET date='$today', vote_id='$voteID', poll_id='$pollID'";
				$database->openConnectionNoReturn($query);

				echo "<SCRIPT> alert(\""._THANKS."\"); window.history.go(-1);</SCRIPT>";
			}
		}
	}
}
function pollresult($database, $dbprefix, $poll, $view, $pollID, $month){
	$year = date("Y");
	$number_of_days = date("t",mktime(0,0,0,1,$month,$year));

	$query = "SELECT pollID, pollTitle, voters FROM ".$dbprefix."poll_desc WHERE pollID='$pollID'";
	$result = $database->openConnectionWithReturn($query);
	while ($row = mysql_fetch_object($result)){
		$pollID = $row->pollID;
		$pollTitle = $row->pollTitle;
		$voters = $row->voters;
	}

	$query = "SELECT pollid, optionText, voteid FROM ".$dbprefix."poll_data WHERE pollid=$pollID AND optionText <> '' ORDER BY voteid";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$optionText[$i] = $row->optionText;
		$pollid[$i] = $row->pollid;
		$voteid[$i] = $row->voteid;
		$i++;
	}
	mysql_free_result($result);

	$query = "SELECT MIN(date) AS mindate, MAX(date) AS maxdate FROM ".$dbprefix."poll_date WHERE poll_id='$pollID'";
	$result = $database->openConnectionWithReturn($query);
	while ($row = mysql_fetch_object($result)){
		$mindate_time = $row->mindate;
		$maxdate_time = $row->maxdate;
	}

	if ($mindate_time <> ""){
		$split_mindate_time = split(" ", $mindate_time);
		$mindate = split("-", $split_mindate_time[0]);
		$mintime = split(":", $split_mindate_time[1]);
		$first_vote = strftime("%d %b %Y @ %H:%M",mktime($mintime[0],$mintime[1],$mintime[2],$mindate[1],$mindate[2],$mindate[0]));
	}

	if ($maxdate_time <> ""){
		$split_maxdate_time = split(" ", $maxdate_time);
		$maxdate = split("-", $split_maxdate_time[0]);
		$maxtime = split(":", $split_maxdate_time[1]);
		$last_vote = strftime("%d %b %Y @ %H:%M",mktime($maxtime[0],$maxtime[1],$maxtime[2],$maxdate[1],$maxdate[2],$maxdate[0]));
	}

	$sum = 0;
	if ($month == ""){
		$query = "SELECT optionText, optionCount FROM ".$dbprefix."poll_data WHERE pollid=$pollID AND optionText <> '' ORDER BY voteid";
		$result = $database->openConnectionWithReturn($query);
		$i = 0;
		while ($row = mysql_fetch_object($result)){
			$optionText[$i] = $row->optionText;
			$count[$i] = $row->optionCount;
			$sum += $count[$i];
			$i++;
		}
	}
	else {
		for ($i = 0; $i < count($voteid); $i++){
			$query2 = "SELECT * FROM ".$dbprefix."poll_date WHERE date >= '$year-$month-01 00:00:00' AND date <= '$year-$month-$number_of_days 23:59:59' AND vote_id='$voteid[$i]' AND poll_id='$pollID'";
			$result2 = $database->openConnectionWithReturn($query2);
			$count[$i] = mysql_num_rows($result2);
			$sum += $count[$i];
		}
		mysql_free_result($result2);
	}

	if ($sum < 50){
		$BarScale = 1;
	}
	elseif ($sum > 50 && $sum < 200){
		$BarScale = 2;
	}
	elseif ($sum > 200 && $sum < 500){
		$BarScale = 3;
	}
	elseif ($sum > 500 && $sum < 1000){
		$BarScale = 4;
	}
	elseif ($sum > 1000 && $sum < 5000){
		$BarScale = 5;
	}
	elseif ($sum > 5000 && $sum < 10000){
		$BarScale = 6;
	}

	if ($sum <> 0){
		for ($t = 0; $t < count($count); $t++){
			$percent = 100*$count[$t]/$sum;
			$percentInt[$t] = (int)$percent * 4 * $BarScale;
		}
	}

	$poll->pollresult($pollTitle, $last_vote, $first_vote, $voters, $percentInt, $optionText, $count, $sum, $month, $pollID);
}
?>
