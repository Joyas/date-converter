<?php

namespace TH\DateConverter\Bundle\CustomClasses;

class Date
{
    private $_day;
    private $_month;
    private $_year;
    private $_dateType;
    
    function __construct($date, $type) {
        
        $split_date = preg_split('/\//', $date);
        if (count($split_date) == 3)
        {
            $this->setDate(intval($split_date[0]), intval($split_date[1]), intval($split_date[2]));
            $_dateType = $type;
        }
        else
            $this->error();
    }
    
    public function getDay()
    {
        return ($this->_day);
    }
    
    public function getMonth()
    {
        return ($this->_month);
    }
    
    public function getYear()
    {
        return ($this->_year);
    }
    
     public function getType()
    {
        return ($this->_dateType);
    }
    
    public function toString()
    {
        return ($this->_day . "/" . $this->_month . "/" . $this->_year);
    }
    private function setDate($day, $month, $year)
    {
        if ($day > 0 && $month > 0 && $day <= 31 && $month <= 12)
        {
            $this->_day = $day;
            $this->_month = $month;
            $this->_year = $year;
        }
        else
            $this->error();
    }
   
    private function error($error = null)
    {
        if ($error == null)
        {
            $error = "Your date does not has the good format. The format is DD/MM/YYYY with 0 < DD <= 31 and 0 < MM <= 12 and calendarType has it is described on /calendars";
        }
       throw new \Exception($error);
    }
     
    // Translate a string MM/DD/YY to DD/MM/YY
    public static function mdyToDmy($date)
    {
        $split_date = preg_split('/\//', $date);
        $final_date = $split_date[1] . "/" . $split_date[0] . "/" . $split_date[2];
        return ($final_date);
    }
    
    public static function dateToString($d, $m, $y)
    {
        return ($d . "/" . $m . "/" . $y);
    }
    
}


