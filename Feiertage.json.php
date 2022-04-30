<?php
$data = array();

eachHoliday(function($name, $date, $repeat = false, $id = null) use (&$data){
	$data[] = array("name" => $name, "date" => $date->format("Y-m-d"), "repeat" => $repeat);
});

return json_encode($data);