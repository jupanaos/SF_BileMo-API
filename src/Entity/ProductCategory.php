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
    operations: [],
)]
class ProductCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get:product', 'get:products:category', 'post:product', 'patch:product'])]
    #[ORM\Column(length: 150)]
    #[Length(
        min: 1,
        minMessage: '{{ label }} must have at least {{ limit }} characters.',
        max: 150,
        maxMessage: '{{ label }} cannot contain more than {{ limit }} characters.'
    )]
    #[NotBlank(message: '{{ label }} is empty, please enter a value.')]
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
