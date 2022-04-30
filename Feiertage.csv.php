<?php
$data = array(array("Name", "Date", "Repeat"));

eachHoliday(function($name, $date, $repeat = false, $id = null) use (&$data){
	$data[] = array($name, $date->format("Y-m-d"), $repeat);
});

$csv = new CSVWriter();
$csv->separator = array_read_key("separator", $_GET, ",");
return $csv->writeToString($data);