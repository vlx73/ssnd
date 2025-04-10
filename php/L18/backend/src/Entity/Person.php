<?php

namespace pwa\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 *
 */
class Person implements \JsonSerializable
{
    /**
     * @var Uuid
     */
    private UuidInterface $id;
    /**
     * @var string
     */
    private string $firstname;
    /**
     * @var string
     */
    private string $lastname;
    /**
     * @var string|null
     */
    private ?string $email;
    /**
     * @var string|null
     */
    private ?string $phone;
    
    /**
     * @return mixed
     */
    public function getId(): Uuid
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    
    /**
     * @param mixed $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    
    /**
     * @return mixed
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }
    
    /**
     * @param mixed $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }
    
    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    
    /**
     * @param mixed $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
    
    
    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'        => $this->id,
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'email'     => $this->email,
            'phone'     => $this->phone,
        ];
    }
}