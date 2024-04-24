<?php

namespace l20\Controller;

use l20\Hydrator\UserHydrator;
use l20\Service\DbService;
use l20\Service\UserModel;

class UserController
{
    private UserModel $userModel;
    private UserHydrator $userHydrator;
    
    public function __construct()
    {
        $this->userHydrator = new UserHydrator();
    }
    
    public function showUsers(): string
    {
        global $host, $port, $dbname, $user, $password;
        
        $this->userModel = new UserModel(
            new DbService(
                $host,
                $port,
                $dbname,
                $user,
                $password
            )
        );
        
        $users = $this->userModel->getAll();
        
        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $this->userHydrator->extract($user);
        }
        
        http_response_code(200);
        header('Content-Type: application/json');
        
        return json_encode($userArray);
    }
    
}