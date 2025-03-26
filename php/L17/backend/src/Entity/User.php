<?php

namespace pwa\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 *
 */
class User implements \JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private UuidInterface $id;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $passwordHash;
    
    /**
     * @param UuidInterface $id
     * @param string $username
     * @param string $passwordHash
     */
    public function __construct(UuidInterface $id, string $username, string $passwordHash)
    {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
    }
    
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    
    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
    
    
    public function jsonSerialize(): mixed
    {
        return [
            'id'       => $this->id->toString(),
            'username' => $this->username,
        ];
    }
}