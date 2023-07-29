#
# Table structure for table 'mos_gallery'
#

CREATE TABLE IF NOT EXISTS mos_gallery (
  id int(3) unsigned NOT NULL auto_increment,
  catname varchar(25) DEFAULT '0' ,
  catdir varchar(25) DEFAULT '0' ,
  PRIMARY KEY (id),
   KEY id (id)
);



#
# Table structure for table 'mos_galleryfiles'
#

CREATE TABLE IF NOT EXISTS mos_galleryfiles (
  id int(3) unsigned NOT NULL auto_increment,
  name varchar(30) NOT NULL DEFAULT '' ,
  descr blob ,
  gallery_id int(10) unsigned NOT NULL DEFAULT '0' ,
  PRIMARY KEY (id),
   KEY id (id)
);

