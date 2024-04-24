<?php

namespace l20\Hydrator;

use l20\Entity\User;

/**
 *
 */
class UserHydrator
{
    /**
     * @param array $data
     * @return User
     */
    public function hydrate(array $data): User
    {
        $user = new User($data['email'], $data['password']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        
        return $user;
    }
    
    /**
     * @param User $user
     * @return array
     */
    public function extract(User $user): array
    {
        return [
            'email'      => $user->getEmail(),
            'password'   => $user->getPassword(),
            'first_name' => $user->getFirstName(),
            'last_name'  => $user->getLastName(),
        ];
    }
}