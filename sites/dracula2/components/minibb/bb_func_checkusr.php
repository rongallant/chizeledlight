<?php
function checkUserData($mini_userData, $act) {

if (!eregi("^[0-9a-z]+([._-][0-9a-z]+)*_?@[0-9a-z]+([._-][0-9a-z]+)*[.][0-9a-z]{2}[0-9A-Z]?[0-9A-Z]?$", $mini_userData['email'])) { return 4; }
elseif ($mini_userData['user_icq'] != '' and !eregi("^[0-9]*$", $mini_userData['user_icq'])) { return 5; }
elseif ($mini_userData['user_website'] != '' and !eregi("^(f|ht)tp[s]?:\/\/.*$", $mini_userData['user_website'])) { return 6; }
else { return "ok"; }
}
?>