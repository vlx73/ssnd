<?php

namespace l19\Entity;

use l19\Enum\Email;

/**
 *
 */
class User
{
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;
    /**
     * @var Email
     */
    private Email $email;
    /**
     * @var string
     */
    private string $password;
    
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = new Email($email);
        $this->password = $password;
    }
    
    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    
    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
    
    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }
    
    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
    
    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    
    /**
     * @param string $email
     * @return void
     */
    public function setPlainTextPassword(string $email): void
    {
        $this->password = password_hash($email, PASSWORD_DEFAULT);
    }
    
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
    
}