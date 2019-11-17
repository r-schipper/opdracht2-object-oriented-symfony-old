<?php

namespace App\FileHandler;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class XmlHandler
{
    public function arrayToXml($input_array = [], $normalize_fields): ?string
    {
	    $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new XmlEncoder()]
        );

        if(is_array($normalize_fields))
        {
            $input_array = $serializer->normalize($input_array, null, [AbstractNormalizer::ATTRIBUTES => $normalize_fields]);
        }

        return $serializer->encode($input_array, 'xml');
    }
}
