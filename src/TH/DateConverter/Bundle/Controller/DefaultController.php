<?php

namespace TH\DateConverter\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('THDateConverterBundle:Default:index.html.twig', array('name' => $name));
    }
}
