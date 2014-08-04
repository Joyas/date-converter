<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TH\DateConverter\Bundle\CustomClasses\Date;

class JulianController extends Controller
{
    public function indexAction()
    {
        try {
            $date = $this->getRequest()->get("date");
            if (is_null($date)) {
                throw new \Exception("You have to send me a date in this format : DD/MM/YYYY");
            }
            $gregorianDate = new Date($date);
            $param = array("date" => $gregorianDate->GregorianToJulian());
            return $this->render('THDateConverterBundle:Julian:index.html.twig', $param);
        }
        catch(\Exception $e){
            return $this->render('THDateConverterBundle:Julian:index.html.twig', array( "error" => $e->getMessage()));
        }
    }
}
