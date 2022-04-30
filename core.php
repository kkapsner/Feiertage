<?php

function easternDate($year){
	$a = $year % 19;
	$b = floor($year/100);
	$c = $year % 100;
	$d = floor($b/4);
	$e = $b % 4;
	$f = floor(($b+8)/25);
	$g = floor(($b-$f+1)/3);
	$h = (19*$a+$b-$d-$g+15) % 30;
	$i = floor($c/4);
	$k = $c % 4;
	$l = (32+2*$e+2*$i-$h-$k) % 7;
	$m = floor(($a+11*$h+22*$l)/451);
	$n = floor(($h+$l-7*$m+114)/31);
	$o = ($h+$l-7*$m+114) % 31;
	$p = round($o+1);
	
	return sprintf("%04d-%02d-%02d", $year, $n , $p);
}

function regionMatch($region, $states){
	foreach ($states as $state){
		if ($state === substr($region, 0, strlen($state))){
			return true;
		}
	}
	return false;
}

function getDateInWeek($year, $holiday){
	$startDate = new DateTime(sprintf(
		"%04d-%02d-%02d",
		$year,
		$holiday["inWeek"]["start"]["month"],
		$holiday["inWeek"]["start"]["day"]
	));
	$startDay = $startDate->format("N");
	$diff = $holiday["inWeek"]["weekday"] - $startDay;
	while ($diff < 0){
		$diff += 7;
	}
	$startDate->modify($diff . " days");
	return $startDate;
}

function eachHoliday($callback){
	global $startYear, $endYear, $dataFile, $region;
	$holidays = json_decode(file_get_contents($dataFile), true);
	
	$easternDates = array();
	for ($year = $startYear; $year <= $endYear; $year += 1){
		$easternDates[] = new DateTime(easternDate($year));
	}
	$dates = array();
	foreach ($holidays as $holiday){
		if (regionMatch($region, $holiday["states"])){
			switch ($holiday["type"]){
				case "fixed":
					$date = new DateTime(sprintf("%04d%s", $startYear, $holiday["date"]));
					$dates[] = array($holiday["name"], $date, true, null);
					break;
				case "eastern":
					foreach ($easternDates as $easternDate){
						$date = clone $easternDate;
						$date->modify($holiday["distanceToEastern"] . " days");
						$dates[] = array($holiday["name"], $date, false, $holiday["name"] . "_" . $date->format("Y"));
					}
					break;
				case "inWeek":
					for ($year = $startYear; $year <= $endYear; $year += 1){
						$date = getDateInWeek($year, $holiday);
						$dates[] = array($holiday["name"], $date, false, $holiday["name"] . "_" . $year);
					}
					break;
				case "once":
					$date = new DateTime($holiday["date"]);
					$dates[] = array($holiday["name"], $date, false, null);
					break;
			}
		}
	}
	
	usort($dates, function($date1, $date2){
		$date1 = $date1[1];
		$date2 = $date2[1];
		if ($date1 < $date2){
			return -1;
		}
		else if ($date1 > $date2){
			return 1;
		}
		return 0;
	});
	
	foreach ($dates as $date){
		$callback($date[0], $date[1], $date[2], $date[3]);
	}
}
