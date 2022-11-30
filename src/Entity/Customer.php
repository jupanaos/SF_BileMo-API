<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Entity\CustomerAddress;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomerRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter as SearchFilter;
use ApiPlatform\Metadata\Patch;
use App\Doctrine\CustomerSetUserListener;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\EntityListeners([CustomerSetUserListener::class])]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: [
            'groups' => ['get:customer:item']
            ],
        ),
        new Post(
            denormalizationContext: [
            'groups' => ['post:customer']
            ],
            uriTemplate: '/customers/create',
        ),
        new GetCollection(
            normalizationContext: [
            'groups' => ['get:customer:collection']
            ],
        ),
        new Patch(
            denormalizationContext: [
            'groups' => ['patch:customer']
            ],
            uriTemplate: '/customers/{id}/update',
        ),
        new Delete(
            uriTemplate: '/customers/{id}/delete',
        ),
        new Get(
            name: 'address',
            uriTemplate: '/customers/{id}/address',
            openapiContext: [
                'summary' => 'Retrieves a Customer Address resource.'
            ],
            normalizationContext: [
                'groups' => ['get:customer:address']
            ]
        )
    ],
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'firstName' => SearchFilter::STRATEGY_PARTIAL,
        'lastName' => SearchFilter::STRATEGY_PARTIAL,
        'email' => SearchFilter::STRATEGY_PARTIAL,
    ]
)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('get:customer:collection')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:customer:item', 'get:customer:collection', 'post:customer', 'patch:customer'])]
    #[Length(
        min: 2,
        minMessage: '{{ label }} must have at least {{ limit }} characters.',
        max: 255,
        maxMessage: '{{ label }} cannot contain more than {{ limit }} characters.'
    )]
    #[NotBlank(message: '{{ label }} is empty, please enter a value.')]
    #[NotNull(message: '{{ label }} is empty, please enter a value.')]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:customer:item', 'get:customer:collection', 'post:customer', 'patch:customer'])]
    #[Length(
        min: 2,
        minMessage: '{{ label }} must have at least {{ limit }} characters.',
        max: 255,
        maxMessage: '{{ label }} cannot contain more than {{ limit }} characters.'
    )]
    #[NotBlank(message: '{{ label }} is empty, please enter a value.')]
    #[NotNull(message: '{{ label }} is empty, please enter a value.')]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:customer:item', 'get:customer:collection', 'post:customer', 'patch:customer'])]
    #[Length(
        min: 2,
        minMessage: '{{ label }} must have at least {{ limit }} characters.',
        max: 255,
        maxMessage: '{{ label }} cannot contain more than {{ limit }} characters.'
    )]
    #[NotBlank(message: '{{ label }} is empty, please enter a value.')]
    #[NotNull(message: '{{ label }} is empty, please enter a value.')]
    private ?string $email = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:customer:item', 'get:customer:address', 'post:customer', 'patch:customer'])]
    #[NotBlank(message: '{{ label }} is empty, please enter a value.')]
    private ?CustomerAddress $address = null;

    #[ORM\Column]
    #[Groups(['get:customer:item', 'post:customer', 'patch:customer'])]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'customers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    #[Groups(['get:customer:item'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get:customer:item'])]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?CustomerAddress
    {
        return $this->address;
    }

    public function setAddress(CustomerAddress $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
