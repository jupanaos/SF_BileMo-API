<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\Patch;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(
            security: "is_granted('ROLE_BILEMO')",
            securityMessage: 'You need a valid token to execute this action.',
            denormalizationContext: [
                'groups' => ['post:product']
            ],
            uriTemplate: '/products/create',
        ),
        new Patch(
            security: "is_granted('ROLE_BILEMO')",
            securityMessage: 'You need a valid token to execute this action.',
            denormalizationContext: [
                'groups' => ['patch:product']
            ],
            uriTemplate: '/products/{id}/patch',
        ),
        new Get(
            name: 'category',
            uriTemplate: '/products/{id}/category',
            openapiContext: [
                'summary' => 'Retrieves the Category of a Product resource.'
            ],
            normalizationContext: [
                'groups' => ['get:products:category']
            ]
        )
    ],
    normalizationContext: [
        'groups' => ['get:product']
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

    #[Groups(['get:product', 'post:product', 'patch:product'])]
    #[ORM\Column(length: 100)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 100,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $name = null;

    #[Groups(['get:product', 'post:product', 'patch:product'])]
    #[ORM\Column(length: 255)]
    #[Length(
        min: 1,
        minMessage: 'Le nombre de caractères minimum est de {{ limit }}.',
        max: 255,
        maxMessage: 'Le nombre de caractères maximum est de {{ limit }}.'
    )]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?string $description = null;

    #[Groups(['get:product', 'post:product', 'patch:product', 'get:products:category'])]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank(message: '{{ label }} est vide, veuillez entrer une valeur.')]
    private ?ProductCategory $category = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

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
