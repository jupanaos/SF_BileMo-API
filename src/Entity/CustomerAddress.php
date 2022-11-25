<?php

namespace App\Entity;

use ApiPlatform\Action\NotFoundAction;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomerAddressRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: CustomerAddressRepository::class)]
class CustomerAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get:customer:item', 'get:customer:address', 'post:customer', 'put:customer'])]
    #[ORM\Column]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?int $streetNumber = null;

    #[Groups(['get:customer:item', 'get:customer:address', 'post:customer', 'put:customer'])]
    #[ORM\Column(length: 255)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 255,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $streetName = null;

    #[Groups(['get:customer:item', 'get:customer:address', 'post:customer', 'put:customer'])]
    #[ORM\Column]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?int $zipcode = null;

    #[Groups(['get:customer:item', 'get:customer:address', 'post:customer', 'put:customer'])]
    #[ORM\Column(length: 255)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 255,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $city = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetNumber(): ?int
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(int $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
}
