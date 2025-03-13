<?php

namespace pwa\Entity;

class Person implements \JsonSerializable
{
    private string $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $phone;
    
    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getFirstname():string
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
    public function getLastname():string
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
     * @return mixed
     */
    public function getEmail():string
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
     * @return mixed
     */
    public function getPhone():string
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