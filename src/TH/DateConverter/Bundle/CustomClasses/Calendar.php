<?php

namespace TH\DateConverter\Bundle\CustomClasses;

use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Date;

class Calendar
{
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
}


