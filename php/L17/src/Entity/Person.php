<?php

namespace ssnd\Entity;

use ssnd\Enum\Email;

class Person
{
    private string $firstName;
    private string $lastName;
    
    private Email $email;
    
    public function __construt(Email $email)
    {
        $this->email = $email;
    }
    
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }
    
    public function getLastName(): string
    {
        return $this->lastName;
    }
    
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
    
    
}