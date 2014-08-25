<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;
use TH\DateConverter\Bundle\CustomClasses\Request;


class GregorianController extends Controller
{
    public function indexAction()
    {
        try {
            $date = $this->getRequest()->get("date");
            $returnType = $this->getRequest()->get("returnType");
            if (is_null($date) == TRUE || is_null($returnType) == TRUE || Calendar::typeExist($returnType) == FALSE) {
                throw new \Exception("Error: Missing or bad arguments.\nArguments: date [format: DD/MM/YYYY] && returnType [Go on /documentation for more information.]");
            }
            $gregorianDate = new Date($date, CalendarType::Gregorian);
            if ($returnType == CalendarType::Julian)
                $convertDate = Calendar::GregorianToJulian($gregorianDate);
            else if ($returnType == CalendarType::Gregorian)
                $convertDate = $gregorianDate;
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
