<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;
use TH\DateConverter\Bundle\CustomClasses\Request;


class JulianController extends Controller
{
    public function indexAction()
    {
        try {
            $date = $this->getRequest()->get("date");
            if (is_null($date) == TRUE) {
                throw new \Exception("Error: Missing or bad arguments.\nArgument: date [format: DD/MM/YYYY].");
            }
            $julianDate = new Date($date, CalendarType::Julian);
            $convertDate = Calendar::JulianToGregorian($julianDate);
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
