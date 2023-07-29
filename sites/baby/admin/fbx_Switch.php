<?php
	switch($Fusebox["fuseaction"]) {
/*
		case View:
			//ValidateUser($my_database, $mysql_host, $mysql_login, $mysql_password, $_SESSION['username'], $_SESSION['username']);
			ValidateUser();
			$title = "Chizeled Light - View Entries";
			include ('dsp_menu.php');
			print "<H1>View Entries</H1>";
			if (isset($attributes['item_perpage'])) $item_perpage = $attributes['item_perpage']; else $item_perpage = 15;
			include ('act_VerifyDelete.php');
			include ('qry_List.php');
			include ('dsp_rows.php');
			include ('act_BackNext.php');
			include ('dsp_BackNext.php');
		break;
*/
		case 'Add':
			ValidateUser();
			$title = "Chizeled Light - Add Entry";
			include ('dsp_menu.php');
			print "<H1>Add Entry</H1>";
			include ('qry_Blank.php');
			include ('dsp_form.php');
		break;

		case 'Edit':
			ValidateUser();
			$title = "Chizeled Light - Modify Entry";
			include ('dsp_menu.php');
			print "<H1>Edit Entry</H1>";
			include ('qry_GetEntry.php');
			include ('dsp_form.php');
		break;

		case 'WriteEntry':
			ValidateUser();
			include ('qry_write.php');
			print ("<script language=javascript>window.location = 'index.php?fuseaction=baby.home&page=$page';</script>");
		break;

		case 'UpdateEntry':
			ValidateUser();
			include ('qry_update.php');
			print ("<script language=javascript>window.location = 'index.php?fuseaction=baby.home&page=$page';</script>");
		break;

		case 'DeleteEntry':
			ValidateUser();
			include ('qry_delete.php');
			print ("<script language=javascript>window.location = 'index.php?fuseaction=baby.home&page=$page';</script>");
		break;

		default:
			print "I received a fuseaction called <b>'" . $Fusebox["fuseaction"] . "'</b> that circuit <b>'" . $Fusebox["circuit"] . "'</b> does not have a handler for.";
		break;
	}
?>