<!DOCTYPE html>
<html>
	<head>
		<title>Deutsche Feiertage - keine Region ausgew&auml;lt</title>
	</head>
	<body>
		<h1>Deutsche Feiertage</h1>
		
		Sie haben keine Region ausgew&auml;lt.
		<ul>
		<?php
			foreach (json_decode(file_get_contents(__DIR__ . "/../data/regions.json")) as $region){
				echo "<li><a href=\"?region=" . $region->short . "\">" . htmlentities($region->name, ENT_QUOTES, "UTF-8") . "</a></li>";
			}
		?>
		</ul>
	</body>
</html>