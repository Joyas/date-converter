<?php

namespace TH\DateConverter\Bundle\CustomClasses;

use TH\DateConverter\Bundle\CustomClasses\CalendarType;

class Date
{
  private $_day;
  private $_month;
  private $_year;
  private $_full_date;
  private $_calendarType;
   
    function __construct($date, $calendarType = CalendarType::Gregorian) {
        $this->_calendarType = $calendarType;
        $this->_full_date = $date;
        $split_date = preg_split('/\//', $date);
        if (count($split_date) == 3 
            && intval($split_date[0]) > 0 
            && intval($split_date[1]) > 0 
            && intval($split_date[0]) <= 31 
            && intval($split_date[1]) <= 12)
        {
            $this->_day = intval($split_date[0]);
            $this->_month = intval($split_date[1]);
            $this->_year = intval($split_date[2]);
        }
        else
        {
           throw new \Exception("Your date does not has the good format. The format is DD/MM/YYYY with 0 < DD <= 31 and 0 < MM <= 12 and calendarType has it is described on /calendars");
        }
    }
    
    public function getFullDate()
    {
        return ($this->_full_date);
    }
    
    // private function julianToJD($day, $month, $year) {
    //     /* Adjust negative common era years to the zero-based notation we use.  */
    //     if ($year < 1) {
    //         $year++;
    //     }

    //     /* Algorithm as given in Meeus, Astronomical Algorithms, Chapter 7, page 61 */
    //     if ($month <= 2) {
    //         $year--;
    //         $month += 12;
    //     }
    //     return ((floor(365.25 * ($year + 4716)) + floor(30.6001 * ($month + 1)) + $day) - 1524);
    // }
    
    public function GregorianToJulian()
    {
        $d = $this->_day;
        $m = $this->_month;
        $y = $this->_year;
        $jd = gregoriantojd($m, $d, $y);
        $date = jdtojulian($jd);
        return ($this->mdyToDmy($date));            
    }
    
    public function julianToGregorian() {
        $d = $this->_day;
        $m = $this->_month;
        $y = $this->_year;
        $jd = juliantojd($m, $d, $y);
        $date = jdtogregorian($jd);
        return ($this->mdyToDmy($date));
    }
    
    // Translate a string MM/DD/YY to DD/MM/YY
    private function mdyToDmy($date)
    {
        $split_date = preg_split('/\//', $date);
        $final_date = $split_date[1] . "/" . $split_date[0] . "/" . $split_date[2];
        return ($final_date);
    }
}


