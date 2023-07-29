<form action="https://www.paypal.com/cgi-bin/webscr" methd="post">
<p><input type="image" src="http://images.paypal.com/images/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it´s fast, free and secure!" align="right">Please help support it by making a donation.</p>
<p><i>Traditional Calendar:</i><br>This is a traditional style calendar that shows links in each day to a event. Details are then displayed when a user clicks on the link. This calendar also supports reoccurrence of events. To do this, this calendar uses a second table to generate the information in calendar display. This should be rebuilt using the rebuild option on the admin page after changing dates of an event, adding a new event and/or at the beginning of each month (this could be handled as a cron job).</p>
<p><i>List Calendar:</i><br>This is a simple list style calendar. There is an option to display two types of  legends, image and text, for this calendar (both are displayed in the demo).</p>
<p>Both calendars can either specify a URL or an email address for the contact. In the case of a email address, the address is not published. Instead, visitors are supplied with a form (mail.php). This is intended to thwart any method of &quot;Harvesting&quot; addressed from a web site.</p>
<p><i>Eventlog for Minutes, Journal or Update Log:</i><br>
This is provided to supply dated information. This could be used for such purposes as a modification/updates log, minutes, journal, etc... Information is displayed from the most recent.</p>
<p><i>News:</i><br>Displays time sensitive information. The summery page also displays up-coming events from the traditional and list calendars.</p>
<p><i>Requirements:</i><br>PHP 3-4.<br>MySQL 3</p>
<p><i>Fully Tested on:</i><br>PHP 3.0.12, 4.0.4pl1 and 4.0.6<br>MySQL 3.22.27, 3.23.21-beta and 3.23.36<br>Web Server: Apache Version 1.3.12<br>Operating System: Linux Redhat Version 6.1 and 7.1</p>
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="greghenle@lightwavesgraphics.com">
<input type="hidden" name="item_name" value="Multifunction Calendar">
<input type="hidden" name="item_number" value="10010">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://www.lightwavesgraphics.com/Calendar/admin/admin.php">
<input type="hidden" name="cancel_return" value="http://www.lightwavesgraphics.com/Calendar/admin/admin.php">
</form><p>1: Change options and information contained in setup.php</p>
<p>2: Update the intro.php and help.php files to contain your desired information.</p>
<p>3: Upload all in the same directory structure as below or as they came in the zip file.</p>
<dl>
<dd>calendar/calendara.php</dd>
<dd>calendar/calendarb.php</dd>
<dd>calendar/Mail.php</dd>
<dd>calendar/eventlog.php</dd>
<dd>calendar/summary.php</dd>
<dd>calendar/admin/admin.php</dd>
<dd>calendar/admin/calendara/calendar.php</dd>
<dd>calendar/admin/calendara/functions.php</dd>
<dd>calendar/admin/calendara/rebuild.php</dd>
<dd>calendar/admin/calendarb/functions.php</dd>
<dd>calendar/admin/calendarb/nrcalendar.php</dd>
<dd>calendar/admin/images/1.gif</dd>
<dd>calendar/admin/images/2.gif</dd>
<dd>calendar/admin/images/3.gif</dd>
<dd>calendar/admin/images/background.gif</dd>
<dd>calendar/admin/images/info.gif</dd>
<dd>calendar/admin/images/phone.gif</dd>
<dd>calendar/admin/images/spacer.gif</dd>
<dd>calendar/admin/images/spot.gif</dd>
<dd>calendar/admin/install/install.php</dd>
<dd>calendar/admin/eventlog/functions.php</dd>
<dd>calendar/admin/eventlog/eventlog.php</dd>
<dd>calendar/admin/news/functions.php</dd>
<dd>calendar/admin/news/news.php</dd>
<dd>calendar/admin/shared/action.php</dd>
<dd>calendar/admin/shared/functions.php</dd>
<dd>calendar/admin/shared/optimize.php
<dd>calendar/Images/conflict0.gif</dd>
<dd>calendar/Images/conflict1.gif</dd>
<dd>calendar/Images/conflict2.gif</dd>
<dd>calendar/Images/conflict3.gif</dd>
<dd>calendar/Images/conflict4.gif</dd>
<dd>calendar/Images/spacer.gif</dd>
<dd>calendar/PHPIncludes/calendara.php</dd>
<dd>calendar/PHPIncludes/calendarb.php</dd>
<dd>calendar/PHPIncludes/eventlog.php</dd>
<dd>calendar/PHPIncludes/setup.php</dd>
<dd>calendar/PHPIncludes/summary.php</dd>
<dd>calendar/Style/style.css</dd>
</dl>
<p>4: You should password protect the admin directory.</p>
<p>5: Run the install.php (calendar/admin/install/install.php) script. It will check to ensure that the table name you specified in setup.php has not already been created. If not, it will then create a table with the correct structure.</p>
<p>6: Change the style.css to suit your needs. If you change the class names, make sure you update the setup.php file to reflect the changes.</p>
<p>7: In your HTML editor, change the following files to the style of your site. Move the PHP statement in the body of the document to the location where you wish the information to display. Content prior to the &lt;HTML&gt; tag should remain unchanged. If you change the names of these files, make sure you update the setup.php file to reflect the change. These files should remain in their installation directory.</p>
<dl>
<dd>calendar/calendara.php
<dd>calendar/calendarb.php<dd>calendar/Mail.php<dd>calendar/eventlog.php<dd>calendar/summary.php</dl>
<p>8: The following image files can be changed to suit your needs but should remain the same size. Images may be added, deleted and renamed as needed. Make sure you update the legend section in the setup.php file to reflect the changes.</p>
<dl>
<dd>Calendar/Images/conflict0.gif</dd>
<dd>Calendar/Images/conflict1.gif</dd>
<dd>Calendar/Images/conflict2.gif</dd>
<dd>Calendar/Images/conflict3.gif</dd>
<dd>Calendar/Images/conflict4.gif</dd>
</dl>
<p>9: Before the traditional calendar will function correctly, you need to &quot;Rebuild&quot; it at least once to fill in the dates in the second (default table name - subcalendara) table.</p>