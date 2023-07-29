-------------------------------------
Mambo_MiniBB MamboOS Component Add-On
-------------------------------------
June 23, 2003
Version: 1.5a+Patch06-23-03
Original Script: www.minibb.net
MamboOS Integration: Matt Smith(mambo@clippersoft.net)
Download Site: mambo.clippersoft.net

I. Features
-----------
+ MamboOS Integration Features
	+ Complete Integration - No Frames or New Pages
	+ User and Administrator Accounts Integration
	+ Visual Integration - Utilizes Mambo's CSS Settings
	+ Admin Options available directly from within Mambo
+ MiniBB Forum Features
	+ SMALL, SIMPLE, FAST and POWERFUL
	+ Easy and customizable search function. 
	+ Customizable date format (incl. AM/PM). 
	+	HTML is disabled, but there are basic BB codes (HTML replacements), which allow you to make your posts really good-looking. There is also an ability to turn on/off BBCode in posts. 
	+ Both anonymous and registered users can post messages in any forum. Registered users also can edit their messages. 
	+ Registered users can be notified via email, when their post or topic is replied, even if they are not authors of the topic. They also can unsubscribe. 
	+ Special rankings and titles for registered users. 
	+ Moderators feature. 
	+ Advanced statistics for users and forums. 
	+ IP tracking, which can be accessed by administrator or moderator. 
	+ Private, archive (read-only) and registered-users-only forums. 
	+ "Sticky" topics. 
	+ Expiration of editing messages. 
	+ Banning users by their IPs. 
	+ Basic spam protection. 
	+ Powerful admin panel and tools. 	

II. Requirements
----------------
MamboOS v4.0.12 or later

III. Installation
-----------------
1. Download the latest version of the add-on.
2. Unzip the download file in the root of your Mambo installation directory
	 (The package will place the files in the appropriate locations).
3. Install the SQL file into your Mambo Database in the same manner you
	 installed the Mambo SQL file. The file is located under your Mambo sql directory.
	 (Note: Assumes the prefix of "mos_")
4. Login to your Mambo's Admin Console.
5. Install the Add-On, by selecting Main Menu...Install Custom.  Then select
	 MiniBB Forum.
6. Add and Publish the new Mambo Component by selecting Main Menu...Top Section...Add.
7. To access the Admin features of MiniBB, login to your main site as your admin account.
	 You will then see an "Admin Panel" link on the bottom of the Forum page.

IV. Upgrading
-------------
+ 1.5aBetaX -> 1.5a+Patch06-23-03
  + Simply extract the zip file in the root of your Mambo installation - no re-install
	  is necessary.
	 
V. Changelog
-------------
+ 1.5aBeta1 -> 1.5aBeta2
  +	Fixed a bug in bb_admin.php, whereby forum images where not displayed.
	+ Integrated/Enhanced the Smilies plugin, which is turned on by default.
+ 1.5aBetaX -> 1.5a+Patch06-23-03
  + Mambo License/Naming Update
  + Fixed Bug - Email on Replies not being sent
  
	 
VI. FAQ
-------
1. Q: How do I make a forum topic postable by Registered Users only?
	 A: This is a MiniBB feature.  To add this feature to a topic, edit the
	 		bb_specials.php file under /components/minibb and add the forum topic
			number to the $regUsrForums list.
2. Q: I renamed a user/admin account, and now it doesn't work in the forum, why?
	 A:	There is no tie in to the Mambo Admin Console, so the only way to currently correct
	 		this would be to change the username under mos_minibb_users in the database.		
3. Q: How do I turn off the Smilies plugin?
	 A: Open up setup_options.php in your components/minibb directory, and change the
	 		setting, $hackSmilies, to FALSE.
			