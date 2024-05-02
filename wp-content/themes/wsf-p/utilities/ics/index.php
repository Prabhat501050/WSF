<?php
// Include the ICS class
require_once '../../classes/ICS.php';

// Sanitation Regex
$date_regex = '/[^0-9]/';
$time_regex = '/[^0-9apm:]/';
$text_regex = '/[^0-9a-zA-Z-\s\,\.\:\&]/';

// Timezones
$timezones = array(
    'eastern' => 'America/New_York',
    'central' => 'America/Chicago',
    'mountain' => 'America/Denver',
    'pacific' => 'America/Los_Angeles',
    'arizona' => 'America/Phoenix'
);

// Get the incoming variables
$date = preg_replace($date_regex,'',$_GET['date']);
$starttime = ( !empty($_GET['starttime']) ) ? preg_replace($time_regex,'',$_GET['starttime']) : null;
$endtime = ( !empty($_GET['endtime']) ) ? preg_replace($time_regex,'',$_GET['endtime']) : null;
$name = preg_replace($text_regex,'',$_GET['name']);
$location = preg_replace($text_regex,'',$_GET['location']);
$timezone_var = preg_replace($text_regex,'',$_GET['timezone']);

// Build the time strings
$start = $date;
if ( !empty($starttime) ) $start .= ' '. $starttime;
$end = $date;
if ( !empty($endtime) ) $end .= ' '. $endtime;
// Figure out if we are an all day event
$allday = false;
if ( empty($starttime) ) $allday = true;
// Get the timezone
$timezone = $timezones[ $timezone_var ];

$ics = new ICS(array(
    'location' => $location,
    'dtstart' => $start,
    'dtend' => $end,
    'summary' => $name
), $allday, $timezone);

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=invite.ics');
echo $ics->to_string();
