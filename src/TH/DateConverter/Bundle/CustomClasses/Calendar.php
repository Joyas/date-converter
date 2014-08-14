<?php

namespace TH\DateConverter\Bundle\CustomClasses;

use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Date;

class Calendar
{
    // Translate a date from gregorian to julian
    public static function GregorianToJulian($date)
    {
        $d = $date->getDay();
        $m = $date->getMonth();
        $y = $date->getYear();
        $jd = gregoriantojd($m, $d, $y);
        $date = jdtojulian($jd);
        return (new Date(Date::mdyToDmy($date), CalendarType::Julian));
    }
    
    // Translate a date from julian to gregorian
    public static function julianToGregorian($date) {
        $d = $date->getDay();
        $m = $date->getMonth();
        $y = $date->getYear();
        $jd = juliantojd($m, $d, $y);
        $date = jdtogregorian($jd);
        return (new Date(Date::mdyToDmy($date), CalendarType::Gregorian));
    }
    
    
    public static function kingToGregorian($date, $king) {
        
    }
    
    // As described in 
    // Jean Meeus, Astronomical algorithms, William Bell, Richmond (Virginia, États-Unis), 1991, (ISBN 0-943396-35-2), p. 67
    private static function getEasterOfGregorianYear($year) {
        $n = $year % 19;
        $c = floor($year / 100);
        $u = $year % 100;
        $s = floor($c / 4);
        $t = $c % 4;
        $p = floor(($c + 8) / 25);
        $q = floor(($c - $p + 1) / 3);
        $e = floor(((19 * $n) + $c - $s - $q + 15) % 30);
        $b = floor($u / 4);
        $d = $u % 4;
        $L = floor((32 + (2 * $t) + (2 * $b) - $e - $d) % 7);
        $h = floor(($n + (11 * $e) + (22 * $L)) / 451);
        $m = floor(($e + $L - (7 * $h) + 114) / 31);
        $j = ($e + $L - (7 * $h) + 114) % 31;
        return (new Date(Date::dateToString($j + 1, $m, $year), CalendarType::Gregorian));
    }
    
    // As described in 
    // Jean Meeus, Astronomical algorithms, William Bell, Richmond (Virginia, États-Unis), 1991, (ISBN 0-943396-35-2), p. 69
    private static function getEasterOfJulianYear($year) {
        $A = $year % 19;
        $B = $year % 7;
        $C = $year % 4;
        $D = (19 * $A + 15) % 30;
        $E = (2 * $C + 4 * $B - $D + 34) % 7;
        $F = floor(($D + $E + 114) / 31);
        $G = ($D + $E + 114) % 31;
        return (new Date(Date::dateToString($G + 1, $F, $year), CalendarType::Julian));
    }
    
    // I am using the Meeus' method in order to calculate the easter day.
    // There are two different algorithms, one for the gregorian date and another one for the julian ones.
    // In fact, Meeus uses the Delambre algorithm for the julian calendar and the Butcher's algorithm for the 
    // gregorian one. 
    // If you want more information, you can read the pages 67 and 69 of 
    // Jean Meeus, Astronomical algorithms, William Bell, Richmond (Virginia, États-Unis), 1991, (ISBN 0-943396-35-2)
    public static function getEasterDate($year, $type = CalendarType::Gregorian) {
        if ($type == CalendarType::Gregorian)
            return (Calendar::getEasterOfGregorianYear($year));
        else 
            return (Calendar::getEasterOfJulianYear($year));
    }
    
    // Check if $type exists in the CalendarType. Every CalendarType must be check on this function, even the kings.
    public static function typeExist($type) {
        switch ($type) {
            case CalendarType::Julian:
                return (TRUE);
            case CalendarType::Gregorian:
                return (TRUE);
            default:
                return (FALSE);
        }
    }
    
    // Check if $type is a calendar, like gregorian or gregorian. The kings, for example, are not a calendar.
    public static function isCalendar($type) {
        switch ($type) {
            case CalendarType::Julian:
                return (TRUE);
            case CalendarType::Gregorian:
                return (TRUE);
            default:
                return (FALSE);
        }   
    }
}


