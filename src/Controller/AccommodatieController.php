<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Accommodatie;
use App\ResponseHandler\ResponseHandler;

class AccommodatieController extends AbstractController
{
    /**
     * @Route("/accommodaties.{_format}", name="accommodaties", defaults={"_format"="html"})
     */
    public function index($_format, $_route)
    {
        $accommodaties = new Accommodatie();
        $accommodaties = $accommodaties->getAccommodaties();

        if($_format == "xml")
        {
            $response_handler = new ResponseHandler();

            $filename = $_route;
            $xml_attributes = ['accommodatie', 'land', 'skigebied', 'plaats', 'afbeelding'];

            return $response_handler->getXmlResponse($accommodaties, $filename, $xml_attributes);
        }

        return $this->render('accommodatie/index.html.twig', [
            'accommodaties' => $accommodaties
        ]);
    }
}
