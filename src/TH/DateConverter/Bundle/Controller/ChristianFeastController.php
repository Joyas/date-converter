<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;
use TH\DateConverter\Bundle\CustomClasses\Request;


class ChristianFeastController extends Controller
{
    public function indexAction()
    {
        try {
            $feast = $this->getRequest()->get("feast");
            $year = $this->getRequest()->get("year");
            $day = $this->getRequest()->get("day");
            $returnType = $this->getRequest()->get("returnType");
            if (is_null($feast) || is_null($year) || is_null($day) || is_null($returnType)) {
                throw new \Exception("Error: Missing or bad arguments.\nArguments: feast [format: String] && year [format: YYYY] && day [format: DD]. [Go on /documentation for more information about the feasts which are managed.]");
            }
            $convertDate = Calendar::feastToGregorian($day, $year, $feast, $returnType);
            $data = array(
                "responseCode" => "success",
                "responseMessage" => "success",
                "result" => array(
                    "originalDate" => $day . " days after " . $feast . " of " . $year,
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
