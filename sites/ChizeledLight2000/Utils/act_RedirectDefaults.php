<? 
# Redirect.php Copyright 2001 Jim Fletcher jim@WebsiteCode.com 
# 
# This script, when called, will look like: 
# redirect.php?backtext=Back+To+My+World&backlink=http://www.myworld.com&linktitle=Microsoft+Website&url=http://www.microsoft.com 
# 
# All variables are optional, and you may set the default for left-out variables below. 
# 
if (!$sitetitle) { 
    $sitetitle="Chizeled Light"; 
} 
if (!$url) { 
    $url="http://www.chizeledlight.com"; 
} 
if (!$backtext) { 
    $backtext="Back To Chizeled Light"; 
} 
if (!$backlink) { 
    $backlink=$HTTP_REFERER; 
} 
if (!$linktitle) { 
    $linktitle="Redirection From Chizeled Light"; 
} 
?> 

