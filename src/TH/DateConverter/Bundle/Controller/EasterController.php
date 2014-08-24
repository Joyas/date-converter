<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;
use TH\DateConverter\Bundle\CustomClasses\Request;


class EasterController extends Controller
{
    public function indexAction()
    {
        try {
            $year = $this->getRequest()->get("year");
            $returnType = $this->getRequest()->get("returnType");
            if (is_null($year) == TRUE || is_null($returnType) == TRUE || Calendar::isCalendar($returnType) == FALSE) {
                throw new \Exception("Error: Missing or bad arguments.\nArguments: year [format: YYYY] && returnType [A calendar type. You can check them on /info.");
            }
            $date = Calendar::getEasterDate($year, $returnType);
            $data = array(
                "responseCode" => "success",
                "responseMessage" => "success",
                "result" => array(
                    "year" => $year,
                    "easterDate" => $date->toString(),
                    "day" => $date->getDay(),
                    "month" => $date->getMonth(),
                    "year" => $date->getYear(),
                    "calendarType" => $date->getType()
                )
            );
            return Request::json($data);
        }
        catch(\Exception $e) {
            return Request::jsonError($e->getMessage());
        }
    }
}
