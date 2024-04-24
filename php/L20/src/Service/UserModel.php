<?php

namespace l20\Service;

use l20\Entity\User;
use l20\Enum\Email;
use l20\Hydrator\UserHydrator;

class UserModel
{
    private DbService $dbService;
    
    public function __construct(DbService $dbService)
    {
        $this->dbService = $dbService;
    }
    
    public function getAll(): array
    {
        $result = $this->dbService->query("SELECT * FROM ssnd_user");
        
        $users = [];
        
        $userHydrate = new UserHydrator();
        
        foreach ($result as $row) {
            $users[] = $userHydrate->hydrate($row);
        }
        
        return $users;
    }
    
    public function getUserByEmail(Email $email): User
    {
        $result = $this->dbService->query(
            "SELECT * FROM ssnd_user WHERE email = ?",
            [(string)$email]
        );
        
        if (count($result) === 0) {
            throw new \InvalidArgumentException('User not found');
        }
        
        $userHydrate = new UserHydrator();
        
        return $userHydrate->hydrate($result[0]);
    }
}