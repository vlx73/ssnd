<?php

namespace pwa\Service;

use Firebase\JWT\JWT;
use PDO;

class AuthService
{
    private UserModel $userModel;
    private ClientApplicationModel $clientApplicationModel;
    
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clientApplicationModel = new ClientApplicationModel();
        
    }
    
    /**
     * Login method: Verifies username and password.
     * @throws \Exception
     */
    public function login(string $username, string $password): JWT
    {
        $user = $this->userModel->getUserByUsername($username);
        
        
        // Verify password
        if ($user && password_verify($password, $user->getPasswordHash())) {
         
            //TODO: Implement JWT token generation
//            $jwt = JWT::encode([
//                'iss' => 'http://localhost:8080',
//                'sub' => $user->getId(),
//                'exp' => time() + 60 * 60,
//                'iat' => time(),
//                'nbf' => time(),
//            ], getenv('JWT_SECRET'));
            
        }
        
        throw new \Exception('Invalid username or password');
    }
    
    /**
     * Register method: Creates a new user with a hashed password.
     * @throws \Exception
     */
    public function register(string $username, string $password): bool
    {
        return $this->userModel->createUser($username, $password);
    }
    
    /**
     * Validates clientId and clientSecret against the ClientApplicationModel.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @return bool
     */
    public function clientIsAuthorized(string $clientId, string $clientSecret): bool
    {
        $client = $this->clientApplicationModel->getClientByClientId($clientId);
        
        if ($client && $clientSecret === $client->getClientSecret()) {
            return true;
        }
        
        return false;
    }
}
