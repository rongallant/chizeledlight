<?php
/*
<fusedoc fuse="fbx_SaveContent.php">
	<responsibilities>
		I am a custom class recreating the functionality of ColdFusion's <CFSaveContent> tag. The tag was originally released as cf_BodyContent by Steve Nelson. This class is required for PHP-Fusebox 3.0.
		Useage:
			$SC = new SaveContent();
				print "Some stuff.";
			$SaveContent = $SC->close();
		The variable $SaveContent now contains "Some stuff.", and nothing has been sent to the browser yet.  This functionality is essential to the core code in Fusebox 3, not to mention a pretty cool tool in general.
	</responsibilities>	
</fusedoc>
*/

class SaveContent {
	function SaveContent() {
		ob_start(); //start the output buffer
	}
	function clear() {
		ob_end_clean(); //clear buffer, end collection of content
						//without returning the contents of the buffer
	}
	function forward($location) {
		ob_end_clean(); //clear buffer, end collection of content
		header("Location: $location"); //forward to another page
		exit; //end the PHP processing
	}
	function close() {
		$buf = ob_get_contents(); //get stuff out of buffer to variable
		ob_end_clean(); //clear buffer, end collection of content
		return $buf; // return the contents of the buffer--
					 // requires that the calling template receives this value like so:
					 // $SaveContent = $SC->close();
	}
}

function Location($URL, $addToken = 0) {
	$location = ($addToken)?$URL."?".$SID:$URL; //append the sessionID ($SID) by default
	ob_end_clean(); //clear buffer, end collection of content
	if(headers_sent()) {
		print('<META http-equiv="Refresh" content="0;URL="'.$location.'>');
	} else {
		header("Location: ".$location); //forward to another page
		exit; //end the PHP processing
	}
}

?>