Multifunction Calendar v2.0.3
http://www.lightwavesgraphics.com

DESCRIPTION
----------------------------
Multifunction Calendar currently supports two types of calendars, a journal or minutes,
a mail form, a summary page and news to be displayed on the summary page.

Calendar type A:
This is a traditional style calendar that shows links in each day to a event. Details are
then displayed when a user clicks on the link. This calendar also supports reoccurrence
of events. To do this, this calendar uses a second table to generate the information in
calendar display. This should be rebuilt using the rebuild option on the admin page after
changing dates of an event, adding a new event and/or at the beginning of each month
(this could be handled as a cron job).

Calendar type B:
This is a simple list style calendar.

Both calendars can either specify a URL or an email address for the contact. In the case
of a email address, the address is not published. Instead, visitors are supplied with a
form (Mail.html). This is intended to thwart any method of "Harvesting" addressed from
a web site.

Eventlog, Minutes or Journal:
This is provided to supply dated information. This could be used for such purposes as
a modification/updates log, minutes, journal, etc... Information is displayed from the
most recent.

News:
This information is displayed on the summery page. Start and stop times are specified
to have the entry displayed between two dates. The summery page also displays up-
coming events prior to a specific date.

TERMS OF USE AND LEGAL STUFF
----------------------------
Multifunction Calendar
Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

Multifunction Calendar will here after be referred as the 'Software'.

This Software is protected by Copyright laws.

You can use this software for Free As long as all copyright notices and notes stays
intact  and  ALL the "Multifunction Calendar 2.0.2" footer links stay intact.

You are allowed to modify the Software files, only for your needs. As long as any original
code remains ALL copyright notes and  ALL the "Multifunction Calendar 2.0.2" footer links
must stay intact.

If you join the Light Waves Graphics affiliate program, then you are allow to replace the
URL "http://www.lightwavesgraphics.com/" in the footer with your affiliate link provided to
you by us.

You or anyone or anything can NOT distribute this Software whole or in part.

You may post information or tutorials on how to add your modifications to this software.

You or anyone or anything can NOT use any code in this Software for your own software
or any other software then this software.

NO WARRANTY
----------------------------
By using this Software you agree to indemnify LIGHT WAVES GRAPHICS or anyone else
from any liability that might rise using this Software with respect to the Software.
This program is provided on an "as-is" basis, and as such has no official warranty.

Please send support requests, suggestions and feedback to calendar@lightwavesgraphics.com

If you want Light Waves Graphics to install the Multifunction Calendar for you please e-mail
calendar@lightwavesgraphics.com for support.

Please note, Multifunction Calendar install service is not free.

VERSION INFORMATION
----------------------------
Currently, Version 2.0.3


DONATION !
----------------------------
If you would like to support Multifunction Calendar !
you can send donations by mail to the following address.

Light Waves Graphics
10400 Courthouse Rd. PMB 258
Spotsylvania VA 22553

Thank you !
----------------------------

Requirements:
----------------------------
PHP 3-4.
MySQL 3
Fully Tested on
PHP 3.0.12, 4.0.4pl1 and 4.0.6
MySQL 3.22.27, 3.23.21-beta and 3.23.36 
Web Server: Apache Version 1.3.12 and 1.3.19
Operating System: Linux Redhat Version 6.1 (Cartman) and 7.1 (Seawolf)


To install:
----------------------------

(You need to have a open Mysql database to continue, ask your web hosting manager about it)

1: Change options in setup.php
2: Update the intro.php and help.php files to contain your desired 
3: Upload all in the same directory structure as below or as they came in the zip file.

	Calendar
	|   buglist.txt
	|   calendara.php
	|   calendarb.php
	|   mail.php
	|   eventlog.php
	|   readme.txt
	|   summary.php
	|
	+---admin
	|   |   admin.php
	|   |   help.php
	|   |   intro.php
	|   |
	|   +---calendara
	|   |       buildlog.php
	|   |       calendara.php
	|   |       functions.php
	|   |       rebuild.php
	|   |
	|   +---calendarb
	|   |       calendarb.php
	|   |       functions.php
	|   |
	|   +---images
	|   |       1.gif
	|   |       2.gif
	|   |       3.gif
	|   |       background.gif
	|   |       blue-angel.css.add.gif
	|   |       blue-angel.css.cancel.gif
	|   |       blue-angel.css.delete.gif
	|   |       blue-angel.css.edit.gif
	|   |       blue-angel.css.update.gif
	|   |       Golden.css.add.gif
	|   |       Golden.css.cancel.gif
	|   |       Golden.css.delete.gif
	|   |       Golden.css.edit.gif
	|   |       Golden.css.update.gif
	|   |       info.gif
	|   |       phone.gif
	|   |       spacer.gif
	|   |       spot.gif
	|   |
	|   +---install
	|   |       install.php
	|   |
	|   +---eventlog
	|   |       functions.php
	|   |       eventlog.php
	|   |
	|   +---news
	|   |       functions.php
	|   |       news.php
	|   |
	|   \---shared
	|           action.php
	|           functions.php
	|
	+---Images
	|       conflict0.gif
	|       conflict1.gif
	|       conflict2.gif
	|       conflict3.gif
	|       conflict4.gif
	|       spacer.gif
	|
	+---PHPIncludes
	|       calendara.php
	|       calendarb.php
	|       functions.php
	|       legend.php
	|       mail.php
	|       minutes.php
	|       setup.php
	|       summary.php
	|
	\---Style
	        blue-angel.css
	        Golden.css

4: You should password protect the admin directory.
5: Run the install.php (Calendar/admin/install/install.php) script. It will check to ensure that the table name
    you specified in setup.php has not already been created. If not, it will then create a table with the correct
    structure.
6: Change the style.css to suit your needs. class names should remain unchanged.
7: In your HTML editor, change the following files to the style of your site. Move the PHP statement in the body
    of the document to the location where you wish the information to display. Content prior to the <html> tag
    should remain unchanged. If you change the names of these files, make sure you update the setup.php file
    to reflect the change.

	calendar/calendara.php
	calendar/calendarb.php
	calendar/Mail.php
	calendar/eventlog.php
	calendar/summary.php

8: The following image files can be changed to suit your needs but should remain the same size. Images may
be added, deleted and renamed as needed. Make sure you update the legend section in the setup.php file to
reflect the changes.

	Calendar/Images/conflict0.gif
	Calendar/Images/conflict1.gif
	Calendar/Images/conflict2.gif
	Calendar/Images/conflict3.gif
	Calendar/Images/conflict4.gif

9: Before the traditional calendar will function correctly, you need to "Rebuild" it at least once to fill in the dates
in the second (default table name - subcalendara) table.


Thanks for using the Multifunction Calendar!



MISCELLANEOUS:
This Agreement shall be governed by the laws of the United States and of the Commonwealth of Virginia, as
applied to agreements made, entered into and performed entirely within the Commonwealth of Virginia,
notwithstanding your actual state of residence or principal business location. Any action relating to this Agreement
must be brought in federal or state courts located in Spotsylvania County, Virginia and you irrevocably consent to
the jurisdiction of such courts. You may not assign this agreement, by operation or law or otherwise, without our prior
written consent, any such purported assignment shall be null and void. Subject to such restriction, this Agreement will
be binding upon, inure to the benefit of and be enforceable against the parties and their respective successors and
assigns. If any provision herein is held to be invalid or unenforceable for any reason, the remaining provisions will
continue in full force without being impaired or invalidated in any way. Our failure to enforce your strict performance of
any provision of this Agreement will not constitute a waiver of our right to subsequently enforce such provision or any
other provision of this Agreement. This Agreement constitutes the entire agreement between the parties regarding its
subject matter, supersedes any other agreements or understandings between them, and may only be amended by a
writing signed by us.