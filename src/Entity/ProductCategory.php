<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ProductCategoryRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProductCategoryRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(uriTemplate: '/categories'),
        new Get(uriTemplate: '/categories/{id}')
    ],
)]
class ProductCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('getProduct')]
    #[ORM\Column(length: 150)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 150,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
