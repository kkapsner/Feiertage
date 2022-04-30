<?php
include_once("loadFramework.php");

$dataFile = "data/Feiertage.json";

// read type parameter

$types = array(
	"ics"  => "text/calendar;charset=UTF-8",
	"txt"  => "text/plain;charset=UTF-8",
	"html" => "text/html;charset=UTF-8",
	"json" => "application/json",
	"raw"  => "application/json",
	"csv"  => "text/csv;charset=UTF-8");

$type = strToLower(array_read_key("type", $_GET, "ics"));

if (!array_key_exists($type, $types)){
	$type = "ics";
}

if ($type === "raw"){
	header("Content-Type: " . $types[$type]);
	echo file_get_contents($dataFile);
	die();
}

// read region parameter

if (!array_key_exists("region", $_GET)){
	include("errors/noRegion.php");
	die();
}
$region = $_GET["region"];

// read start year parameter

if (array_key_exists("year", $_GET)){
	$startYear = (int) $_GET["year"];
}
else {
	$now = new DateTime();
	$startYear = $now->format("Y") - (int) array_read_key("yearsAgo", $_GET, 1);
}

// read end year parameter

if (array_key_exists("endYear", $_GET)){
	$endYear = (int) $_GET["endYear"];
}
else {
	$endYear = $startYear + (int) array_read_key("yearsCount", $_GET, 5);
}

header("Content-Type: " . $types[$type]);

$cacheFile = "cache/Feiertage." . $region . "." . $startYear . "-" . $endYear . "." . $type;
$useCache = !array_key_exists("noCache", $_GET);
if (
	$useCache &&
	file_exists($cacheFile) &&
	filemtime($cacheFile) >= filemtime($dataFile)
){
	echo file_get_contents($cacheFile);
	die();
}

include_once("core.php");
$content = include("Feiertage." . $type . ".php");
if ($useCache){
	file_put_contents($cacheFile, $content);
}
echo $content;