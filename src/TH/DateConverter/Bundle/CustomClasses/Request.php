<?php

namespace TH\DateConverter\Bundle\CustomClasses;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class Request
{
    public static function json($data)
    {
        $response = new JsonResponse();
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $response->setData($data);
        return ($response);
    }
    
    public static function jsonError($msg)
    {
        $data = array(
            "responseCode" => "failure",
            "responseMessage" => $msg,
            "result" => array(
            )
        );
        $response = new JsonResponse();
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $response->setData($data);
        return ($response);
    }
}


