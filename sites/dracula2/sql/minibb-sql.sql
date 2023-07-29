# phpMyAdmin MySQL-Dump
# version 2.3.3
# http://www.phpmyadmin.net/ (download page)
#
# Generation Time: Jan 23, 2003 at 10:40 AM
# --------------------------------------------------------

#
# Table structure for table `mos_minibb_banned`
#

DROP TABLE IF EXISTS mos_minibb_banned;
CREATE TABLE mos_minibb_banned (
  id int(10) NOT NULL auto_increment,
  banip varchar(15) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `mos_minibb_forums`
#

DROP TABLE IF EXISTS mos_minibb_forums;
CREATE TABLE mos_minibb_forums (
  forum_id int(10) NOT NULL auto_increment,
  forum_name varchar(150) NOT NULL default '',
  forum_desc text NOT NULL,
  forum_order int(10) NOT NULL default '0',
  forum_icon varchar(255) NOT NULL default 'default.gif',
  PRIMARY KEY  (forum_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `mos_minibb_posts`
#

DROP TABLE IF EXISTS mos_minibb_posts;
CREATE TABLE mos_minibb_posts (
  post_id int(11) NOT NULL auto_increment,
  forum_id int(10) NOT NULL default '1',
  topic_id int(10) NOT NULL default '1',
  poster_id int(10) NOT NULL default '0',
  poster_name varchar(40) NOT NULL default 'Anonymous',
  post_text text NOT NULL,
  post_time datetime NOT NULL default '0000-00-00 00:00:00',
  poster_ip varchar(15) NOT NULL default '',
  post_status tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (post_id),
  KEY post_id (post_id),
  KEY forum_id (forum_id),
  KEY topic_id (topic_id),
  KEY poster_id (poster_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `mos_minibb_send_mails`
#

DROP TABLE IF EXISTS mos_minibb_send_mails;
CREATE TABLE mos_minibb_send_mails (
  id int(11) NOT NULL auto_increment,
  user_id int(10) NOT NULL default '1',
  topic_id int(10) NOT NULL default '1',
  PRIMARY KEY  (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `mos_minibb_topics`
#

DROP TABLE IF EXISTS mos_minibb_topics;
CREATE TABLE mos_minibb_topics (
  topic_id int(10) NOT NULL auto_increment,
  topic_title varchar(100) NOT NULL default '',
  topic_poster int(10) NOT NULL default '0',
  topic_poster_name varchar(40) NOT NULL default 'Anonymous',
  topic_time datetime NOT NULL default '0000-00-00 00:00:00',
  topic_views int(10) NOT NULL default '0',
  forum_id int(10) NOT NULL default '1',
  topic_status tinyint(1) NOT NULL default '0',
  topic_last_post_id int(10) NOT NULL default '1',
  PRIMARY KEY  (topic_id),
  KEY topic_id (topic_id),
  KEY forum_id (forum_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `mos_minibb_users`
#

DROP TABLE IF EXISTS mos_minibb_users;
CREATE TABLE mos_minibb_users (
  user_id int(10) NOT NULL auto_increment,
  username varchar(40) NOT NULL default '',
  user_regdate datetime NOT NULL default '0000-00-00 00:00:00',
  user_password varchar(32) NOT NULL default '',
  user_email varchar(50) NOT NULL default '',
  user_icq varchar(15) NOT NULL default '',
  user_website varchar(100) NOT NULL default '',
  user_occ varchar(100) NOT NULL default '',
  user_from varchar(100) NOT NULL default '',
  user_interest varchar(150) NOT NULL default '',
  user_viewemail tinyint(1) NOT NULL default '0',
  user_sorttopics tinyint(1) NOT NULL default '1',
  user_newpwdkey varchar(32) NOT NULL default '',
  user_newpasswd varchar(32) NOT NULL default '',
  PRIMARY KEY  (user_id)
) TYPE=MyISAM;

