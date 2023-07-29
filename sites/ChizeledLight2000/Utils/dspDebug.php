
<div align="center"><br><br><hr><b>. : | DEBUG ENABLED | : .</b><br><br></div>

<table border="0" cellpadding="3" cellspacing="0" bgcolor="#cccccc"><tr><td>


<?php
	$temp = $Fusebox["layout"];
	$Fusebox["layout"] = "...emptied for debug...";
reset($attributes);
print "<b>Attributes:</b>\n<pre>";
print_r($attributes);

print "</pre>";reset($HTTP_SESSION_VARS);
print "<b>Session:</b>\n<pre>";
print_r($HTTP_SESSION_VARS);
print "</pre>";

reset($XFA);
print "<b>XFA:</b>\n<pre>";
print_r($XFA);
print "</pre>";

reset($Fusebox);
print "<b>Fusebox:</b>\n<pre>";
print_r($Fusebox);
print "</pre>";

reset($HTTP_GET_VARS);
print "<b>Get Vars:</b>\n<pre>";
print_r($HTTP_GET_VARS);
print "</pre>";

reset($HTTP_POST_VARS);
print "<b>Post Vars:</b>\n<pre>";
print_r($HTTP_POST_VARS);
print "</pre>";

reset($HTTP_SERVER_VARS);
print "<b>Server Vars:</b>\n<pre>";
print_r($HTTP_SERVER_VARS);
print "</pre>";
	$Fusebox["layout"] = $temp;
?>

</td></tr></table>