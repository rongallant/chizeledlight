<h1>Daddy - Ron</h1>
<table cellpadding="10" cellspacing="0" border="0" width="100%">
	<tr valign="top">
		<td width="100">
			<img src="assets/images/daddy.jpg" width="100" height="100" id="photo">
		</td>
		<td>
			<p>Here I am, Daddy.  This is my first little baby and I can't wait.  I do my best to keep  Mommy happy during these hard months.  Let me tell you, thats not an easy job.</p>
			<?php 
				session_start();
				if (isset($_SESSION['LoggedIn'])) {
					echo "<p align=\"right\"><a class=\"menu\" href=\"{$self}?fuseaction=login.logout\">Logout</a></p>";
				} else {
					echo "<p align=\"right\"><a class=\"menu\" href=\"{$self}?fuseaction=login.home\">Login</a></p>";
				}
			?>
		</td>
	</tr>
</table>