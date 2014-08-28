<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;
use TH\DateConverter\Bundle\CustomClasses\Request;

class JewishController extends Controller
{
    public function indexAction()
    {
        try {
            $date = $this->getRequest()->get("date");
            $day = $this->getRequest()->get("day");
            $monthName = $this->getRequest()->get("monthName");
            $year = $this->getRequest()->get("year");
            if ((is_null($date) == TRUE) && (is_null($day) == TRUE || is_null($monthName) == TRUE || is_null($year) == TRUE)) {
                throw new \Exception("Error: Missing or bad arguments.\nArgument: date [format: DD/MM/Y] or day [format: DD] && monthName [format: String] && year [format: Y].");
            }
            if (is_null($date))
            {
                $month = Calendar::getMonthNbrByName($monthName, CalendarType::Jewish);
                $date = Date::dateToString($day, $month, $year);
            }
            $jewishDate = new Date($date, CalendarType::Jewish);
            $convertDate = Calendar::JewishToGregorian($jewishDate);
            $data = array(
                "responseCode" => "success",
                "responseMessage" => "success",
                "result" => array(
                    "originalDate" => $date,
                    "convertDate" => $convertDate->toString(),
                    "day" => $convertDate->getDay(),
                    "month" => $convertDate->getMonth(),
                    "year" => $convertDate->getYear(),
                    "calendarType" => $convertDate->getType()
                )
            );
            return Request::json($data);
        }
        catch(\Exception $e){
            return Request::jsonError($e->getMessage());
        }
    }
}
