<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.
$version = "2.0.4";

// mySQL
$database = "yogaroad";
$host = "mysql.server101.com";
$user = "yogaroad";
$pass = "yurtgirl";

// Admin Page
$sitename = "Yogaroad";
$baseurl = "www.yogaroad.net";
$contact = "info@yogaroad.net";
$phone = "";

// disable HTML 1=true 0=false
$html = 0;

//mail
$mailurl = "mail.php";
// signature, disclaimer and/or opt-out for the mail form
$disclaimer = "\n\n____________________\nThis email was sent from the " . $sitename . " at " . $baseurl . ". Your email address has not been published on this web site. It is listed in our database as the contact for a event on our calendar. If you would like to be removed from the database, please contact " . $contact;
// first paragraph content in the mail form
$mailparaa = "This form helps prevent spam being sent to the contact's email address by parties that collect addresses from web sites.";
// second paragraph content ends with the event's name
$mailparab = "Information you supply below will be forwarded to the contact of ";

// CSS Class style
$cssstyle = "blue-angel.css";

// CSS Class definitions
$class = array();
$class[0] = ' class="mfcclass00"';
$class[1] = ' class="mfcclass01"';
$class[2] = ' class="mfcclass02"';
$class[3] = ' class="mfcclass03"';
$class[4] = ' class="mfcclass04"';
$class[5] = ' class="mfcclass05"';
$class[6] = ' class="mfcclass06"';
$class[7] = ' class="mfcclass07"';
$class[8] = ' class="mfcclass08"';
$class[9] = ' class="mfcclass09"';
$class[10] = ' class="mfcclass10"';
$class[11] = ' class="mfcclass11"';
$class[12] = ' class="mfcclass12"';
$class[13] = ' class="mfcclass13"';
$class[14] = ' class="mfcclass14"';
$class[15] = ' class="mfcclass15"';
$class[16] = ' class="mfcclass16"';
$class[17] = ' class="mfcclass17"';
$class[18] = ' class="mfcclass18"';
$class[19] = ' class="mfcclass19"';
$class[20] = ' class="mfcclass20"';

// Button
$buttonw = 110;
$buttonh = 15;

// start in year dropdown
$thisyear = date("Y",time());
// number of years in year dropdown
$yearinc = 10;

// text format in dropdown boxes. keys must not change
$weekdays = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
$months = array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
$longmth = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$order = array(1=>"First", "Second", "Third", "Fourth", "Last");

// Legend in calendarb - change to suit your needs.
$legend = array();
// enable image legend 1=true, 0=false
$legend[0] = 1; 
// image legend name
$legend[1] = "Image Legend";
// elements in image legend Key=image file in Image dir, Value=text in dropdown
$legend[2] = array("conflict0.gif"=>"None Specified", "conflict1.gif"=>"Image 1", "conflict2.gif"=>"Image 2", "conflict3.gif"=>"Image 3", "conflict4.gif"=>"Image 4");
// enable text legend 1=true, 0=false
$legend[3] = 1;
// text legend name
$legend[4] = "Text Legend";
// elements in text legend Key=, Value=text in dropdown
$legend[5] = array("A"=>"Legend A", "B"=>"Legend B", "C"=>"Legend C", "D"=>"Legend D", "E"=>"Legend E", "F"=>"Legend F");

// add whatever states you need change them to teacher's names
$states = array("", "AZ", "DC", "GA", "MD", "MS", "NC", "PA", "SC", "VA");

/*
Change the table names and fields to what suits you.
Make sure you don't drop or add elements in the arrays
Do not change the table structure.
*/

// calendar type a
$table = array();
$table[0] = array();
// table name
$table[0][0] = "calendara";
// 10 fields
$table[0][1] = array("ID", "ScheduleStart", "Open", "ScheduleEnd", "Close", "Title", "Description", "Directions", "SiteURL", "Repeat");
// table structure
$table[0][2] = "CREATE TABLE ".$table[0][0]." (".$table[0][1][0]." int(11) NOT NULL auto_increment, ".$table[0][1][1]." date DEFAULT '0000-00-00' NOT NULL, ".$table[0][1][2]." text NOT NULL, ".$table[0][1][3]." date DEFAULT '0000-00-00' NOT NULL, ".$table[0][1][4]." text NOT NULL, ".$table[0][1][5]." text NOT NULL, ".$table[0][1][6]." text NOT NULL, ".$table[0][1][7]." text NOT NULL, ".$table[0][1][8]." text NOT NULL, ".$table[0][1][9]." text NOT NULL, PRIMARY KEY (".$table[0][1][0]."))";
// Number of items to display
$table[0][3] = 3;
// Display page file name
$table[0][4] = "calendara.php";
// Display page name and title
$table[0][5] = "Class Calendar";
// 1st text area displayed name
$table[0][6] = "Description";
// 2nd text area displayed name
$table[0][7] = "Directions";

$table[1] = array();
// table name
$table[1][0] = "subcalendara";  
// 7 fields
$table[1][1] = array($table[0][1][0], "Day", "Weekday", "Occure", "Event");
// table structure
$table[1][2] = "CREATE TABLE ".$table[1][0]." (".$table[1][1][0]." int(11) DEFAULT '0' NOT NULL auto_increment, ".$table[1][1][1]." date DEFAULT '0000-00-00' NOT NULL, ".$table[1][1][2]." tinyint(1) DEFAULT '0' NOT NULL, ".$table[1][1][3]." tinyint(1) DEFAULT '0' NOT NULL, ".$table[1][1][4]." text NOT NULL, PRIMARY KEY (".$table[1][1][0]."))";
// Months to calculate in advance for calendar type a
$table[1][3] = 6;

// calendar type b
// $table[2] = array();
// table name
$table[2][0] = "calendarb"; 
// 9 fields
$table[2][1] = array($table[0][1][0], $table[0][1][1], $table[0][1][3], "EventName", "SiteURL", "HostGroup", "City", "State", "Notes", "Legendimg", "Legendtxt");
// table structure
$table[2][2] = "CREATE TABLE ".$table[2][0]." (".$table[2][1][0]." int(11) NOT NULL auto_increment, ".$table[2][1][1]." date DEFAULT '0000-00-00' NOT NULL, ".$table[2][1][2]." date DEFAULT '0000-00-00' NOT NULL, ".$table[2][1][3]." text NOT NULL, ".$table[2][1][4]." text NOT NULL, ".$table[2][1][5]." text NOT NULL, ".$table[2][1][6]." text NOT NULL, ".$table[2][1][7]." text NOT NULL, ".$table[2][1][8]." text NOT NULL, ".$table[2][1][9]." text NOT NULL, ".$table[2][1][10]." text NOT NULL, PRIMARY KEY (".$table[2][1][0]."))";
// Number of events to display
$table[2][3] = 20;
// Display file page name
$table[2][4] = "calendarb.php";
// Display page name and title
$table[2][5] = "Calendar B";
// 1st text input displayed name
$table[2][6] = "Event Name";
// 2nd text input displayed name
$table[2][7] = "Organization";
// 3rd text input displayed name
$table[2][8] = "Location";


//minutes or journal
$table[3] = array();
// table name
$table[3][0] = "minutes"; 
// 3 fields
$table[3][1] = array ($table[0][1][0], "TimeLog", "Content");
// table structure
$table[3][2] = "CREATE TABLE ".$table[3][0]." (".$table[3][1][0]." int(11) NOT NULL auto_increment, ".$table[3][1][1]." date DEFAULT '0000-00-00' NOT NULL, ".$table[3][1][2]." text NOT NULL, PRIMARY KEY (".$table[3][1][0]."))";
// Number of items to display
$table[3][3] = 2;
// Display page file name
$table[3][4] = "eventlog.php";
// Display page name and title
$table[3][5] = "Updates";

//news
$table[4] = array();
// table name
$table[4][0] = "mfnews";  
// 5 fields
$table[4][1] = array ($table[0][1][0], $table[0][1][1], $table[0][1][3], "Headline", "News");
// table structure
$table[4][2] = "CREATE TABLE ".$table[4][0]." (".$table[4][1][0]." int(11) NOT NULL auto_increment, ".$table[4][1][1]." date DEFAULT '0000-00-00' NOT NULL, ".$table[4][1][2]." date DEFAULT '0000-00-00' NOT NULL, ".$table[4][1][3]." text NOT NULL, ".$table[4][1][4]." text NOT NULL, PRIMARY KEY (".$table[4][1][0]."))";
// Number of items to display
$table[4][3] = 10;
// Display page file name
$table[4][4] = "summary.php";
// Display page name and title
$table[4][5] = "Summary";
// number of days shown in summary
$table[4][6] = 7;
// text input displayed name
$table[4][7] = "Headline";
// text area displayed name
$table[4][8] = "News";


$link = mysql_pconnect($host, $user, $pass) or die ('<font' . $class[4] . '>Error: Connection to the database failed!</font>');
mysql_select_db($database,$link);

?>
