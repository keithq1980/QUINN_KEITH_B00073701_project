<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 14/04/2016
 * Time: 18:43
 */

$date_array = getdate();
foreach ( $date_array as $key => $val )
{
    print "$key = $val<br />";
}
$formated_date = "Today's date: ";
$formated_date .= $date_array[mday] . "-";
$formated_date .= $date_array[mon] . "-";
$formated_date .= $date_array[year];
$today = date("H:i:s");
$mysqltime = date ("Y-m-d H:i:s", $today);
print $formated_date . ' Time = ' . time() . ' Today = ' . $today . ' SQL ' . $mysqltime . '    ';

//echo ' <time datetime="'.date('c').'">'.date('Y - m - d').'</time>';

//echo date(DateTime::ISO8601);
//$strDate = $intDate ? date( $strFormat, $intDate ) : date( $strFormat ) ;
//print $strDate;
//$t = microtime(true);
//$micro = sprintf("%06d",($t - floor($t)) * 1000000);
//$d = new DateTime( date('Y-m-d H:i:s.'.$micro,$t) );

//print $d->format("d-m-Y H:i:s.u");

// set the date and the time  manually - - - -
$date = new DateTime('2001-01-01');

$date->setTime(14, 55);
echo $date->format('Y-m-d H:i:s') . "\n";

$date->setTime(14, 55, 24);
echo $date->format('Y-m-d H:i:s') . "\n";
$time = time();
$date->setTime();
echo $date->format('Y-m-d H:i:s') . "\n";

echo  "\n";

$now   = new DateTime;
$clone = clone $now;
$clone->modify( '+8 Hour' );

echo $date->format('Y-m-d H:i:s'), "\n", $clone->format('Y-m-d H:i:s');
echo '----', "\n";

// will print same.. if you want to clone make like this:
$now   = new DateTime;
$clone = clone $now;
$clone->modify( '-1 day' );

echo $now->format( 'd-m-Y' ), "\n", $clone->format( 'd-m-Y' );
echo "\n";

print date("m/d/y G.i:s<br>", time());
print "Today is ";
print date("j of F Y, \a\\t g.i a", time());
// -------------------------------------------------------
date_default_timezone_set("Europe/Dublin");

echo date_default_timezone_get();
echo time();
echo "\n";
$date = date_create();
echo date_format($date, 'U = d-m-Y H:i:s') . "\n";

$getStamp = date_timestamp_get($date);
//string to time lookup!
echo 'get stamp' . date_timestamp_get($date) . "\n";
$myStamp = date_timestamp_set($date, $getStamp);
$endTime = mktime();
echo 'mkTime ' . $endTime .  "\n";
echo  "\n";
/*
$now   = new DateTime;
$clone = clone $now;
$clone->modify( '+8 Hour' );

echo $date->format('d-m-Y H:i:s'), "\n", $clone->format('d-m-Y H:i:s');
echo '----', "\n";
$date2 = $clone;


if($myStamp < $date2) {
    print_r('really');
    echo date_format($myStamp, 'U = d-m-Y H:i:s') . "\n";
    echo date_format($date2, 'U = d-m-Y H:i:s') . "\n";
    print_r( $clone);
}
else {
    print_r('Oh my' . "\n");
    echo date_format($myStamp, 'U = d-m-Y H:i:s') . "\n";
    echo date_format($date2, 'U = d-m-Y H:i:s') . "\n";
}

date_default_timezone_set("Europe/Dublin");
echo "\n";
echo date_default_timezone_get();
echo "\n";
echo time();
echo "\n";
$date = date_create();
echo "\n";
echo date_format($date, 'U = d-m-Y ') . "\n";

$getStamp = date_timestamp_get($date);
echo "\n";
echo 'get stamp' . date_timestamp_get($date) . "\n";
$myStamp = date_timestamp_set($date, $getStamp);

echo  "\n";
$datetime1 = date_create('2009-10-11');
$datetime2 = date_create('2009-10-13');
$interval = date_diff($datetime1, $datetime2);
echo "\n";
echo $date->format('Y-m-d H:i:s'),
print_r( $interval );

$date = date_create('2001-01-01');

date_time_set($date, 14, 55);
echo date_format($date, 'Y-m-d H:i:s') . "\n";

date_time_set($date, 14, 55, 24);
echo date_format($date, 'Y-m-d H:i:s') . "\n";
*/
echo  "\n";
echo  "\n";


