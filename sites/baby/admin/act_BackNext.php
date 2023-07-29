<?
// START page scroller application
if ($prev < 0) {$prevlink="";}
	else {$prevlink="<a href=\"$script?fuseaction=admin.View&offset=$prev\">&lt;&lt; PREV</a>";}
if ($num_of_rows <= $next) {$nextlink="";}
	else {$nextlink="<a href=\"$script?fuseaction=admin.View&offset=$next\">NEXT &gt;&gt;</a>";}
// END page scroller application
?>