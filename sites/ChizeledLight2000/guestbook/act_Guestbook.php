<script language="php"> 

$PostPage = "dsp_Sign.php";
$gbPage = "dsp_Guestbook.php";

if ($name == ""):

	$error1 = "<B>It appears as if you've tried to submit a blank form:</B><br>";

	echo $error1;
	include($PostPage);

else:

	$gbFile = "dsp_Guestbook.php"; // Location of link database file
	$gbPage = "dsp_Guestbook.php"; // Link page file
	
	if ($html == 1):
	
	$allowHTML = 1;	// To allow HTML in site description 1 = Yes, 0 = No
	
	else:
	
	$allowHTML = 0;	// To allow HTML in site description 1 = Yes, 0 = No

endif;

	$notify = 0; // Would you like to be notified when a link is added? 1 = yes, 0 = No
	$my_email = "you@youremailaddress.com"; // Enter your email address
	$subject = "New Guestbook Entry" ; // Enter the subject of the notification email



// Code Follows Below

$page = $gbFile;

if ($allowHTML == 0):
	$name = ereg_replace("<","&lt;",$name);
	$name = ereg_replace(">","&gt;",$name);
	$email = ereg_replace("<","&lt;",$email);
	$email = ereg_replace(">","&gt;",$email);
	$url = ereg_replace("<","&lt;",$url);
	$url = ereg_replace(">","&gt;",$url);
	$urltitle = ereg_replace("<","&lt;",$urltitle);
	$urltitle = ereg_replace(">","&gt;",$urltitle);
	$referral = ereg_replace("<","&lt;",$referral);
	$referral = ereg_replace(">","&gt;",$referral);
	$comments = ereg_replace("<","&lt;",$comments);
	$comments = ereg_replace(">","&gt;",$comments);
endif;

$filename = "dsp_Guestbook.php";
$fd = fopen( $filename, "r" );
$current = fread( $fd, filesize( $filename ) );
fclose( $fd );

	$comments = ereg_replace("\n","<BR>",$comments);

	$fileMessage = "\n";
	$fileMessage .= "\n";
	$fileMessage .= "\n";
	$fileMessage .= "<P>\n";
	$fileMessage .= "<A HREF=\"MAILTO:$email\"><B>$name</B></A>\n";
	$fileMessage .= "<BR><B>Date: </B>";
	$fileMessage .= (date("l dS of F Y h:i:s A"));
	$fileMessage .= "\n";
	$fileMessage .= "</P>\n";
	$fileMessage .= "<P><B>Comments: </B><BR>$comments</P>\n";
	$fileMessage .= "<HR>\n";
	$fileMessage .= "\n";
	$fileMessage .= "\n";
	$fileMessage .= "$current\n";

if (file_exists("$page")):
	$cartFile = fopen("$page","w+");
	fputs($cartFile,$fileMessage);
	fclose($cartFile);
else:
	$cartFile = fopen("$page","w");
	fputs($cartFile,$fileMessage);
	fclose($cartFile);
endif;

// EMAIL THE NEW POST

if ($notify == 1):

$comments = ereg_replace("<BR>","\n",$comments);

mail
(
"$my_email",
"Example Issues List Entry",
"Name : $name
Email : $email
Note:

$comments\n
",
"From: $email\n"
);
endif;

// set vars for help checking against double entries

$name_chk = $name;
$email_chk = $email;
$comments_chk = $comments;

// include($gbPage);

// endif from very top where checking if form is empty

endif;

</script>
