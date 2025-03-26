<?php

namespace pwa\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDO;

/**
 *
 */
class AuthService
{
    /**
     * @var UserModel
     */
    private UserModel $userModel;
    /**
     * @var ClientApplicationModel
     */
    private ClientApplicationModel $clientApplicationModel;
    
    /**
     * @var string|array|false
     */
    private string $jwtSecret;
    
    
    /**
     *
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clientApplicationModel = new ClientApplicationModel();
        $this->jwtSecret = getenv('JWT_SECRET') ? getenv('JWT_SECRET') : 'default_secret';
    }
    
    /**
     * Login method: Verifies username and password.
     * @throws \Exception
     */
    public function login(string $username, string $password): string
    {
        $user = $this->userModel->getUserByUsername($username);
        
        // Verify password
        if (password_verify($password, $user->getPasswordHash())) {
            
            $jwt = JWT::encode(
                [
                    'iss'          => 'http://localhost:8080',  //issuer
                    'sub'          => $user->getId(),           //user id - subject
                    'exp'          => time() + 60 * 60,         //expiration time
                    'iat'          => time(),                    // issued at
                    'nbf'          => time(),                    // not before time
                    'ssnd-project' => [
                        'role'     => 'user',
                        'identity' => $user->getUsername(),
                    ],
                ],
                $this->jwtSecret,
                'HS256');
            
            return $jwt;
        }
        
        throw new \Exception('Invalid username or password');
    }
    
    /**
     * Verify JWT token and check the role.
     *
     * @param string $token
     * @param string $requiredRole
     * @return bool
     * @throws \Exception
     */
    public function verifyJWT(string $token, string $requiredRole): bool
    {
        try {
            $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
            $payload = (array) $decoded;
            
            if (isset($payload['ssnd-project']) && $payload['ssnd-project']->role === $requiredRole) {
                return true;
            }
        } catch (\Exception $e) {
            throw new \Exception('Invalid token or role');
        }
        
        return false;
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
