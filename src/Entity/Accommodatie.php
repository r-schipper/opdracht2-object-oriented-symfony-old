<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\FileHandler\CsvHandler;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccommodatieRepository")
 */
class Accommodatie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accommodatie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $land;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skigebied;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plaats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $afbeelding;

    public function getAccommodatiesCsvLocation(): ?string
    {
        if($_SERVER['APP_ENV'] == 'test')
        {
            return 'data/accommodatie.csv';
        }

        return '../data/accommodatie.csv';
     }

    public function getAccommodaties(): ?array
    {
        $csv_handler = new CsvHandler();
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()]
        );

        $accommodaties_arr = $csv_handler->csvToArray($this->getAccommodatiesCsvLocation());
        $accommodaties = $serializer->denormalize($accommodaties_arr, 'App\Entity\Accommodatie[]');

        return $accommodaties;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccommodatie(): ?string
    {
        return $this->accommodatie;
    }

    public function setAccommodatie(string $accommodatie): self
    {
        $this->accommodatie = $accommodatie;

        return $this;
    }

    public function getLand(): ?string
    {
        return $this->land;
    }

    public function setLand(string $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getSkigebied(): ?string
    {
        return $this->skigebied;
    }

    public function setSkigebied(string $skigebied): self
    {
        $this->skigebied = $skigebied;

        return $this;
    }

    public function getPlaats(): ?string
    {
        return $this->plaats;
    }

    public function setPlaats(string $plaats): self
    {
        $this->plaats = $plaats;

        return $this;
    }

    public function getAfbeelding(): ?string
    {
        return $this->afbeelding;
    }

    public function setAfbeelding(string $afbeelding): self
    {
        $this->afbeelding = $afbeelding;

        return $this;
    }
}
