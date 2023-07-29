<?PHP
	//In case no fuseaction was given, I'll set up one to use by default.
	if(!isset($attributes["fuseaction"])){ $attributes["fuseaction"] = "baby.home"; }
	if(!isset($GLOBALS["self"])){ $GLOBALS["self"] = "index.php"; }
	if(!isset($GLOBALS["myself"])){ $GLOBALS["myself"] = $self."?fuseaction="; }

	$XFA = array(
		"pics"=>"pics.home"
	);

	//should fusebox silently suppress its own error messages? default is FALSE
	$Fusebox["suppressErrors"] = true;

	if(!isset($layout)){ $GLOBALS["layout"] = "baby";}
	$phpRoot = "/home1/ron1973/public_html/sites/baby";
	$webRoot = "/baby/";
	$myDomain = '://sites.chizeledlight.com/';
	$myEmail = 'ron@rongallant.com';
	$myGraphics = 'assets/images/';
	$myTheme = 'assets/theme/';
	$myTemplates = 'assets/templates/';
	$mySSL = '';
	$mySSLCGI = '';
	$photoRoot = 'assets/images/20010824/';	// Sets the root path for the photos
	$images = "pictures/pictures";
	$thumbs = "pictures/pictures/thumbs";

	// START pagination configuration
	$per_page = 10;
	if (isset($attributes["date"])) $date = $attributes["date"];
	if (isset($attributes["page"])) $start = $attributes["page"] * $per_page - $per_page; else $start = 0;
	// END pagination configuration
	
	//functions
	function displayDate($theDate) {
		$yr=strval(substr($theDate,0,4));
		$mo=strval(substr($theDate,5,2));
		$da=strval(substr($theDate,8,2));
		$theDate = date('l, F jS, Y',mktime ($hr,$mi,0,$mo,$da,$yr));
		return $theDate;
	}
	function getYear($date) {
		$yr=strval(substr($date,0,4));
		$theDate = date('Y',mktime (0,0,0,0,0,$yr));
		return $theDate;
	}
	function displayDateNoYear($theDate) {
		$yr=strval(substr($theDate,0,4));
		$mo=strval(substr($theDate,5,2));
		$da=strval(substr($theDate,8,2));
		$theDate = date('F jS (l)',mktime ($hr,$mi,0,$mo,$da,$yr));
		return $theDate;
	}
?>