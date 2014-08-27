<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use \DateTime;


use TH\DateConverter\Bundle\CustomClasses\Date;
use TH\DateConverter\Bundle\CustomClasses\CalendarType;
use TH\DateConverter\Bundle\CustomClasses\Calendar;
use TH\DateConverter\Bundle\CustomClasses\Request;
use TH\DateConverter\Bundle\Entity\King;

    
# This controller is called for the route /king. It needs the parameters 
# king and the date in the gregorian calendar.
class KingController extends Controller
{
    public function indexAction()
    {
        try {
            $date = $this->getRequest()->get("kingDate");
            $king = $this->getRequest()->get("king");
            if (is_null($date) == TRUE || is_null($king) == TRUE) {
                throw new \Exception("Error: Missing or bad arguments.\nArgument: kingDate [format: DD/MM/YY] and king. You can see all the kings managed on /documentation.");
            }
            $convertDate = Calendar::kingToGregorian(new Date($date, CalendarType::Julian), $king, $this->getDoctrine()->getManager(), $this->getDoctrine()->getManager());
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
    
    public function addKingAction()
    {
        $king = new King();

        $startDateOption = array('widget' => 'choice',
            'input' => 'datetime',
            'label' => "Start of reign (dd/mm/yyyy)",
            'years' => range(0, 2000),
            'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
            'pattern' => "{{ day }}/{{ month }}/{{ year }}",
            'data' => new DateTime("1066-12-25")
        );
        
        $endDateOption = array('widget' => 'choice',
            'input' => 'datetime',
            'years' => range(0, 2000),
            'label' => "End of reign (dd/mm/yyyy)",
            'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
            'pattern' => "{{ day }}/{{ month }}/{{ year }}",
            'data' => new DateTime("1087-09-09")
        );
        
        $form = $this->createFormBuilder($king)
            ->add('name', "text")
            ->add('startDateReign', 'date', $startDateOption)
            ->add('endDateReign', 'date', $endDateOption)
            ->add('save', 'submit', array('label' => 'Save this king in the Database !'))
            ->getForm();
        $form->handleRequest($this->getRequest());
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($king);
            $em->flush();            
            return $this->render('THDateConverterBundle:Default:new.html.twig', array(
                'form' => $form->createView(), 'info' => "The request succeed."
            ));
        }
        
    return $this->render('THDateConverterBundle:Default:new.html.twig', array(
        'form' => $form->createView(),
    ));

    }

}
