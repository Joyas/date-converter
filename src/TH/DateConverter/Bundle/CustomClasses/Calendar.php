<?php

namespace TH\DateConverter\Bundle\CustomClasses;

use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\FeastType;
use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\Entity\King;

class Calendar
{
    // Translate a date from gregorian to julian
    public static function GregorianToJulian($date)
    {
        if ($date->getType() == CalendarType::Gregorian)
        {
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear();
            $jd = gregoriantojd($m, $d, $y);
            $date = jdtojulian($jd);
            return (new Date(Date::mdyToDmy($date), CalendarType::Julian));
        }   
        else 
            return ($date);
    }
    
    // Translate a date from julian to gregorian
    public static function julianToGregorian($date) {
        if ($date->getType() == CalendarType::Julian)
        {
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear();
            $jd = juliantojd($m, $d, $y);
            $date = jdtogregorian($jd);
            return (new Date(Date::mdyToDmy($date), CalendarType::Gregorian));
        }
        else 
            return ($date);
    }
    
    // Translate a king date to gregorian
    public static function kingToGregorian($date, $king, $em) {
        $repository = $em->getRepository('THDateConverterBundle:King');
        $kingEntity = $repository->getKingByName($king);
        if (count($kingEntity) != 1)
            return null;
        else 
        {
            $kingYear = intval(date_format($kingEntity[0]->getStartDateReign(), 'Y'));
            $finalDate = new Date(Date::dateToString($date->getDay(), $date->getMonth(), $date->getYear() + $kingYear), CalendarType::Gregorian);
            return ($finalDate);
        }
    }
    
    // Translate a french date to gregorian
    public static function frenchToGregorian($date) {
        if ($date->getType() == CalendarType::FrenchRepublicanCalendar)
        {
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear();
            $jd = frenchtojd($m, $d, $y);
            $date = jdtogregorian($jd);
            return (new Date(Date::mdyToDmy($date), CalendarType::Gregorian));
        }
        else 
            return ($date);
    }
    
    // Translate a date from gregorian to french republican calendar
    public static function GregorianToFrenchCalendar($date) {
        if ($date->getType() == CalendarType::Gregorian)
        {
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear();
            $jd = gregoriantojd($m, $d, $y);
            $date = jdtofrench($jd);
            return (new Date(Date::mdyToDmy($date), CalendarType::FrenchRepublicanCalendar));
        }
        else 
            return ($date);
    }
    
    // Translate a date from gregorian to jewish calendar
    public static function GregorianToJewish($date) {
        if ($date->getType() == CalendarType::Gregorian)
        {
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear();
            $jd = gregoriantojd($m, $d, $y);
            $date = jdtojewish($jd);
            return (new Date(Date::mdyToDmy($date), CalendarType::Jewish));
        }
        else 
            return ($date);
    }
    
    // Translate a gregorian date in a date using the regnal year of the $king.
    public static function GregorianToKing($date, $king, $em) {
        if ($date->getType() == CalendarType::Gregorian)
        {
            $repository = $em->getRepository('THDateConverterBundle:King');
            $kingEntity = $repository->getKingByName($king);
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear() - (intval(date_format($kingEntity[0]->getStartDateReign(), 'Y')));
            return (new Date(Date::dateToString($d, $m, $y), $kingEntity[0]->getName(), $em));
        }
        else 
            throw \Exception("The king " . $king . " does not exist. Go check on /documentation the king which are managed.");
    }
   
    // Translate the Gregorian date from a year, a day and a feast.
    public static function feastToGregorian($year, $day, $feast, $calendarType) {
        if (Calendar::isFeast($feast) == TRUE && Calendar::isCalendar($calendarType) == TRUE)
         {
            $feastDate = Calendar::getDateOfFeast($day, $year, $feast);
            $d = $feastDate->getDay();
            $m = $feastDate->getMonth();
            $y = $feastDate->getYear();
            $jd = gregoriantojd($m, $d, $year);
            $date = jdtogregorian($jd + $day);
            return (new Date(Date::mdyToDmy($date), $calendarType));
        }
        else 
            throw \Exception("The feast " . $feast . " does not exist. Go check on /documentation the feasts which are managed.");
    }
    
    public static function JewishToGregorian($date)
    {
        if ($date->getType() == CalendarType::Jewish)
        {
            $d = $date->getDay();
            $m = $date->getMonth();
            $y = $date->getYear();
            $jd = jewishtojd($m, $d, $y);
            $date = jdtogregorian($jd);
            return (new Date(Date::mdyToDmy($date), CalendarType::Gregorian));
        }
        else 
            return ($date);
    }
    
    // You give the name of a month in the $type calendar, and it returns the number. For example January / Gregorian returns 1.
    public static function getMonthNbrByName($month, $type)
    {
        
        if ($type == CalendarType::FrenchRepublicanCalendar)
            $calendarType = CAL_FRENCH;
        else if ($type == CalendarType::Julian)
            $calendarType = CAL_JULIAN;
        else if ($type == CalendarType::Gregorian)
            $calendarType = CAL_GREGORIAN;
        else if ($type == CalendarType::Jewish)
            $calendarType = CAL_JEWISH;
        $calInfos = cal_info($calendarType);
        foreach ($calInfos["months"] as $key => $value){
            if (strtolower($value) == strtolower($month))
                return $key;
        }
        return (-1);   
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
    
    public static function isKing($type, $em) {
        if (is_null($em) == TRUE)
            return (FALSE);
        $repository = $em->getRepository('THDateConverterBundle:King');
        $kingEntity = $repository->findAll();
        foreach ($kingEntity as $king){
            if (strtolower($king->getName()) == strtolower($type))
              return (TRUE); 
        }
        return (FALSE);
    }
    
    // Check if $type exists in the CalendarType. Every CalendarType must be check on this function, even the kings.
    public static function typeExist($type, $em) {
        if (Calendar::isKing($type, $em) == TRUE
            || $type == CalendarType::Julian 
            || $type == CalendarType::Gregorian 
            || $type == CalendarType::FrenchRepublicanCalendar
            || $type == CalendarType::Jewish)
            return (TRUE);
        return (FALSE);
    }
    
    // Check if $type is a calendar, like gregorian or gregorian. The kings, for example, are not a calendar.
    public static function isCalendar($type) {
        switch ($type) {
            case CalendarType::Julian:
                return (TRUE);
            case CalendarType::Gregorian:
                return (TRUE);
            case CalendarType::FrenchRepublicanCalendar:
                return (TRUE);
            case CalendarType::Jewish:
                return (TRUE);
            default:
                return (FALSE);
        }   
    }
    
    // Check if $type is a christianFeast. All the feast are listed on FeastType.
    public static function isFeast($type) {
        switch ($type) {
            case FeastType::Easter:
                return (TRUE);
            case FeastType::Annunciation:
                return (TRUE);
            case FeastType::Christmas:
                return (TRUE);
            case FeastType::Midsummer:
                return (TRUE);
            case FeastType::Michaelmas:
                return (TRUE);
            default:
                return (FALSE);
        }   
    }
    
    public static function getDateOfFeast($year, $calendarType, $feast)
    {
        if ($feast == FeastType::Annunciation)
        {
            $d = 25;
            $m = 3;
            $y = $year;
        }
        else if ($feast == FeastType::Christmas)
        {
            $d = 25;
            $m = 12;
            $y = $year;   
        }
        else if ($feast == FeastType::Midsummer)
        {
            $d = 24;
            $m = 6;
            $y = $year;   
        }
        else if ($feast == FeastType::Michaelmas)
        {
            $d = 29;
            $m = 9;
            $y = $year;   
        }
        else if ($feast == FeastType::Easter)
        {
            $easterDate = Calendar::getEasterDate($year, $calendarType);
            $d = $easterDate->getDay();
            $m = $easterDate->getMonth();
            $y = $year;
        }
        return (new Date(Date::dateToString($d, $m, $y), CalendarType::Gregorian));
    }
}


