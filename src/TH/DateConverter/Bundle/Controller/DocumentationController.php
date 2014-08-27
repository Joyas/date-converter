<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocumentationController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('THDateConverterBundle:King');
        $kings = $repository->findAll();
        $month_french_calendar = cal_info(CAL_FRENCH);
        $month_julian_gregorian_calendars = cal_info(CAL_JULIAN);
        return $this->render('THDateConverterBundle:Documentation:index.html.twig', 
            array('kings' => $kings, "month_french_calendar" => $month_french_calendar["months"],
                "month_gregorian_julian" => $month_julian_gregorian_calendars["months"]));
    }
}
