<?php
$table = array();

eachHoliday(function($name, $date, $repeat = false, $id = null) use (&$table){
	$table[] = "<tr><td>" .
		htmlentities($name) . "</td><td>" .
		$date->format("d.m.Y") . "</td><td>" .
		($repeat? "Ja": "Nein") . "</td></tr>";;
});

$regions = json_decode(file_get_contents(__DIR__ . "/data/regions.json"));
$regionName = "Unbekannt";
foreach ($regions as $r){
	if ($r->short === $region){
		$regionName = $r->name;
		break;
	}
}
$title = htmlentities("Deutsche Feiertage für " . $regionName . ": " . $startYear . " - " . $endYear, ENT_QUOTES, "UTF-8");
return "<!DOCTYPE html>
<html>
	<head>
		<title>$title</title>
	</head>
	<body>
		<h1>$title</h1>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Datum</th>
					<th>Wiederholt sich jedes Jahr</th>
				</tr>
			</thead>
			<tbody>
				" . join("\n\t\t\t\t", $table) . "
			</tbody>
		</table>
	</body>
</html>";