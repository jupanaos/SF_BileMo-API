<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(
            security: "is_granted('ROLE_BILEMO')"
        ),
        new Put(
            security: "is_granted('ROLE_BILEMO')"
        )
    ],
    normalizationContext: [
        'groups' => ['getProduct']
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'name' => SearchFilter::STRATEGY_PARTIAL,
        'category' => SearchFilter::STRATEGY_PARTIAL,
    ]
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('getProduct')]
    #[ORM\Column(length: 100)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 100,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $name = null;

    #[Groups('getProduct')]
    #[ORM\Column(length: 255)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 255,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $description = null;

    #[Groups('getProduct')]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?ProductCategory $category = null;

    #[Groups('getProduct')]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Groups('getProduct')]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
