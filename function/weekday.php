<?php  // weekday.php


function dayOfWeek($year, $month, $day) {
    if ($month < 3) {
        $month += 12;
        $year -= 1;
    }
    $leap = $year + $year / 4 - $year / 100 + $year / 400;
    $weekday = ($leap + (13 * $month + 8) / 5 + $day) % 7;

    switch ($weekday) {
        case 0:
            return '日曜日';
        case 1:
            return '月曜日';
        case 2:
            return '火曜日';
        case 3:
            return '水曜日';
        case 4:
            return '木曜日';
        case 5:
            return '金曜日';
        case 6:
            return '土曜日';
        default:
            return '？？？';
    }
            
}

$ymd = explode('/', $argv[1]);
$year = $ymd[0];
$month = $ymd[1];
$day = $ymd[2];
print dayOfWeek($year, $month, $day);
