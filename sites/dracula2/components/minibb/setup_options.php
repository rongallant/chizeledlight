<?php
/*
setup_options.php : basic options for miniBB.
Copyright (C) 2001-2002 miniBB.net.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$DB='mysql';

$bb_admin='index.php?option=com_minibb&current=bb_admin';

$lang='eng';
$skin='mambo_component';
$main_url=$live_site.'/components/minibb';
$emailadmin=0;
$emailusers=1;
$mini_userRegName='_A-Za-z0-9 ';
$l_sepr = '&middot;';

$post_text_maxlength=7500;
$post_word_maxlength=70;
$topic_max_length=50;
$viewmaxtopic=5;
$viewlastdiscussions=4;
$viewmaxreplys=30;
$viewmaxsearch=30;
$viewpagelim=10;
$viewTopicsIfOnlyOneForum=0;

$protectWholeForum=0;
$protectWholeForumPwd='pwd';

$postRange=30;

$dateFormat='MM DD, YYYY<br>T';

$cookiedomain='';
$cookiename='mambominiBB';
$cookiepath='';
$cookiesecure=FALSE;
$cookie_expires=90000;
$cookie_renew=1800;
$cookielang_exp=2592000;

/* New options for miniBB 1.1 */
$Tf=$dbprefix.'minibb_forums';
$Tp=$dbprefix.'minibb_posts';
$Tt=$dbprefix.'minibb_topics';
$Tu=$dbprefix.'minibb_users';
$Ts=$dbprefix.'minibb_send_mails';
$Tb=$dbprefix.'minibb_banned';
$Mu=$dbprefix.'users';

$disallowNames=array('Anonymous');

/* New options for miniBB 1.2 */
$sortingTopics=0;
$topStats=4;
$genEmailDisable=0;

/* New options for miniBB 1.3 */
$defDays=365;
$mini_userUnlock=0;

/* New options for miniBB 1.5 */
$emailadmposts=0;
$mini_useredit=86400; 

/* Add-Ons */
$hackSmilies=TRUE;
$max_smilies=20;
?>