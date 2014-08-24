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
        return $this->render('THDateConverterBundle:Documentation:index.html.twig', array('kings' => $kings));
    }
}
