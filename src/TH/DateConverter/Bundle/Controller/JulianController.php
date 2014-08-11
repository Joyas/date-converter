<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;

class JulianController extends Controller
{
    public function indexAction()
    {
        try {
            $date = $this->getRequest()->get("date");
            if (is_null($date) == TRUE) {
                throw new \Exception("You have to send the resquest with a date argument with the format DD/MM/YYYY");
            }
            $julianDate = new Date($date, CalendarType::Gregorian);
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
            $response = new JsonResponse();
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_UNESCAPED_SLASHES);
            $response->setData($data);
            return $response;
        }
        catch(\Exception $e){
            $data = array(
                "responseCode" => "failure",
                "responseMessage" => $e->getMessage(),
                "result" => array(
                )
            );
            $response = new JsonResponse();
            $response->setData($data);
            return ($response);
        }
    }
}
