<?php

namespace App\ResponseHandler;

use Symfony\Component\HttpFoundation\Response;

use App\FileHandler\XmlHandler;

class ResponseHandler
{
    public function getXmlResponse($input_array, $filename, $normalize_attributes): ?object
    {
        $response = new Response();
        $xml_handler = new XmlHandler();

        $filename = "$filename.xml";

        $xml = $xml_handler->arrayToXml($input_array, $normalize_attributes);

        $response->headers->set('Content-type', 'text/xml' );
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '";');
        $response->headers->set('Content-length',  strlen($xml));

        $response->sendHeaders();
        $response->setContent($xml);

        return $response;
    }
}
