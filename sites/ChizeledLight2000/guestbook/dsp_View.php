<?php
/*
<fusedoc fuse="dsp_View.php">
	<responsibilities>
		I am a case statement that shows all the guestbooks.
	</responsibilities>
	<io>
		<in>
			<string name="$Fusebox['fuseaction']" />
			<string name="$GB" />
		</in>
	</io>	
</fusedoc>
*/

switch($GB) {

	default:
		$title = 'Chizeled Light - View Guestbook';
		echo '<H1>Guestbook</H1>';
		include("dsp_Guestbook.php");
	break;

	case "1":
		$title = 'Chizeled Light - Guestbook Archive 1';
		include("dsp_Guestbook01.php");
	break;

	case "2":
		$title = 'Chizeled Light - Guestbook Archive 2';
		include("dsp_Guestbook02.php");
	break;

	case "1":
		$title = 'Chizeled Light - Guestbook Archive 1';
		include("dsp_Guestbook01.php");
	break;

	case "3":
		$title = 'Chizeled Light - Guestbook Archive 3';
		include("dsp_Guestbook03.php");
	break;

	case "4":
		$title = 'Chizeled Light - Guestbook Archive 4';
		include("dsp_Guestbook04.php");
	break;

}

?>