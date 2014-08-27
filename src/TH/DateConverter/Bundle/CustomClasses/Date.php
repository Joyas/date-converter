<?php

namespace TH\DateConverter\Bundle\CustomClasses;

class Date
{
    private $_day;
    private $_month;
    private $_year;
    private $_dateType;
    
    function __construct($date, $type, $em = NULL) {
        $split_date = preg_split('/\//', $date);
     if (count($split_date) == 3 && Calendar::typeExist($type, $em) == TRUE)
        {
            $this->setDate(intval($split_date[0]), intval($split_date[1]), intval($split_date[2]), $type);
            $this->_dateType = $type;
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
    private function setDate($day, $month, $year, $type)
    {
        if ($type == CalendarType::FrenchRepublicanCalendar)
            {
                $monthNbr = 13;
                $dayNbr = 30;
                $yearMin =  1;
                $yearMax = 14;
            
            }
        else
            {
                $monthNbr = 12;
                $dayNbr = 31;
                $yearMin =  -4714;
                $yearMax = 9999;
            }
        if ($day > 0 && $month > 0 && $day <= $dayNbr && $month <= $monthNbr && $year >= $yearMin && $year <= $yearMax)
        {
            $this->_day = $day;
            $this->_month = $month;
            $this->_year = $year;
        }
        else
            $this->error("test");
    }
   
    private function error($error = null)
    {
        if ($error == null)
        {
            $error = "Your date or type parameters does not has the good format. You should check those formats on /documentation.";
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


