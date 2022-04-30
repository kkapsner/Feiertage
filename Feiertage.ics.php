<?php
$calendar = new Calendar();
CalendarTimezone::addGermanTimezone($calendar);

eachHoliday(function($name, $date, $repeat = false, $id = null) use ($calendar){
	if (!$id){
		$id = $name;
	}
	
	$event = new CalendarEvent();
	$event->uid = preg_replace("/[^0-9a-z]/i", "_", $id) . "@kkapsner.de";
	$event->dtstart = $date->format("Ymd");
	$event->dtstart->VALUE = "DATE";
	$event->dtstart->tzid = "Europe/Berlin";
	if ($repeat){
		$event->rrule = "FREQ=YEARLY";
	}
	$event->summary = $name;
	$event->categories = "Feiertag";
	$calendar->addChild($event);
});

return $calendar->view(false, false);