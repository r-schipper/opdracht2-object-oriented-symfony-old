<?php

namespace App\FileHandler;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CsvHandler
{
    public function csvToArray($csv_location): ?array
    {
        $serializer = new Serializer(
            [new ObjectNormalizer()],
            [new CsvEncoder()]
        );

        return $serializer->decode(file_get_contents($csv_location), 'csv');
    }
}
