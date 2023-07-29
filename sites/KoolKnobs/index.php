<html>
	<head>
		<title>KoolKnobs Menu</title>
		<style>
			body {
				font-family: arial, sans-serif;
			}
		</style>
	</head>
	<body>
		<?php
			$directory = './';
			$hidden = array('..', '.', '.htaccess', '.well-known', 'index.php', 'error_log');
			$files = array_diff(scandir($directory), $hidden);

			print("<ul>");
			foreach ($files as $file) {
				echo "<li><a href=\"$file\" target=\"_blank\">$file</a></li>";
			}
			print("</ul>");
		?>
	</body>
</html>
