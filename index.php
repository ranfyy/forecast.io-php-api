<pre>
<?php
include_once( "curl.inc.php" );
include('lib/forecast.io.php');

$set = parse_ini_file( "secret.ini", true );

$lat = $set["loc"]["lat"];
$lon = $set["loc"]["lon"];
$units = 'auto';  // Can be set to 'us', 'si', 'ca', 'uk' or 'auto' (see forecast.io API); default is auto
$lang = 'de'; // Can be set to 'en', 'de', 'pl', 'es', 'fr', 'it', 'tet' or 'x-pig-latin' (see forecast.io API); default is 'en'

$forecast = new ForecastIO(
  $set["api"]["key"]
, $units
, $lang
);

// all default will be
// $forecast = new ForecastIO($api_key);

if( false ) {
    print "
/*
 * GET CURRENT CONDITIONS
 */
";
    $condition = $forecast->getCurrentConditions($lat, $lon);

    echo 'Current temperature: '.$condition->getTemperature(). "\n";


    print "
/*
 * GET HOURLY CONDITIONS FOR TODAY
 */
";
    $conditions_today = $forecast->getForecastToday($lat, $lon);

    echo "\n\nTodays temperature:\n";
    foreach($conditions_today as $cond) {
	echo $cond->getTime('H:i:s') . ': ' . $cond->getTemperature(). "\n";
    }
} // if

print "
/*
 * GET DAILY CONDITIONS FOR NEXT 7 DAYS
 */
";
$conditions_week = $forecast->getForecastWeek($lat, $lon);

echo "\n\nConditions this week:\n";
foreach($conditions_week as $conditions) {
    $dow = $conditions->getTime('D');
    echo $conditions->getTime('Y-m-d') . " " . $dow . ': ' 
    . $conditions->getMaxTemperature()		." "
    . $conditions->getPrecipitationType()	." "
    . "\n";

}

if( false ) {
    print "
/*
 * GET HISTORICAL CONDITIONS
 */
";
    $condition = $forecast->getHistoricalConditions($lat, $lon, '2010-10-10T14:00:00-0700');
    echo "\n\nTemperatur 2010-10-10: ". $condition->getMaxTemperature(). "\n";
} // if

