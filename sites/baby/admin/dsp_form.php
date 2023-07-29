<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="assets/scripts/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />

<!-- main calendar program -->
<script type="text/javascript" src="assets/scripts/jscalendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="assets/scripts/jscalendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
   adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="assets/scripts/jscalendar/calendar-setup.js"></script>

<?PHP
	$row = mysqli_fetch_array($result);
	$id = $row["id"];
	$date = $row["date"];
	$news = stripslashes (htmlspecialchars ($row["news"]));
	print ("<FORM METHOD='post' ACTION='$self' class='myForm'>");
	print ("Date: <INPUT TYPE='Text' NAME='date' id='date' VALUE='$date'><img src='assets/scripts/jscalendar/img.gif' id='f_trigger_e' style='cursor: pointer;' title='Date selector' /><br />");
	print ("<TEXTAREA NAME='news' COLS='45' ROWS='10'>$news</TEXTAREA><br />");
	if ($attributes['fuseaction'] == 'admin.Edit') {
		print ("<INPUT TYPE='Hidden' NAME='fuseaction' VALUE='admin.UpdateEntry' />");
		print ("<INPUT TYPE='Hidden' NAME='id' VALUE='$id' />");
		print ("<INPUT TYPE='Hidden' NAME='page' VALUE='$page' />");
		print ("<INPUT TYPE='Submit' VALUE='Update Message' />");
	} else {
		print ("<INPUT TYPE='Hidden' NAME='fuseaction' VALUE='admin.WriteEntry' />");
		print ("<INPUT TYPE='Submit' VALUE='Add Message' />");
	}
	print ("</FORM>");
?>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "date",     // id of the input field
        ifFormat       :    "%Y-%m-%d",     // format of the input field (even if hidden, this format will be honored)
        //displayArea    :    "show_e",       // ID of the span where the date is to be shown
        //daFormat       :    "%Y-%m-%d",// format of the displayed date
        button         :    "f_trigger_e",  // trigger button (well, IMG in our case)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>