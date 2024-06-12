<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profileImage = null;

    #[ORM\Column(length: 255)]
    private ?string $identityCard = null;

    #[ORM\Column]
    private ?int $telephoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $personalAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $taxRegistrationCard = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        if (!in_array('ROLE_CUSTOMER', $roles)) {
            $roles[] = 'ROLE_CUSTOMER';
        }
        if (!in_array('ROLE_OWNER', $roles)) {
            $roles[] = 'ROLE_OWNER';
        }
        return array_unique($roles);
    }
    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profileImage;
    }

    public function setProfileImage(?string $profileImage): static
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    public function getIdentityCard(): ?string
    {
        return $this->identityCard;
    }

    public function setIdentityCard(string $identityCard): static
    {
        $this->identityCard = $identityCard;

        return $this;
    }

    public function getTelephoneNumber(): ?int
    {
        return $this->telephoneNumber;
    }

    public function setTelephoneNumber(int $telephoneNumber): static
    {
        $this->telephoneNumber = $telephoneNumber;

        return $this;
    }

    public function getPersonalAddress(): ?string
    {
        return $this->personalAddress;
    }

    public function setPersonalAddress(?string $personalAddress): static
    {
        $this->personalAddress = $personalAddress;

        return $this;
    }

    public function getTaxRegistrationCard(): ?string
    {
        return $this->taxRegistrationCard;
    }

    public function setTaxRegistrationCard(?string $taxRegistrationCard): static
    {
        $this->taxRegistrationCard = $taxRegistrationCard;

        return $this;
    }
}
