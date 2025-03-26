<?php

namespace pwa\Controller;

use pwa\Service\AuthService;
use pwa\Service\UserModel;
use pwa\View\JsonView;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 *
 */
class AuthController
{
    /**
     * @var UserModel
     */
    private UserModel $userModel;
    /**
     * @var JsonView
     */
    private JsonView $view;
    /**
     * @var AuthService
     */
    private AuthService $authService;
    
    /**
     *
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new JsonView();
        $this->authService = new AuthService();
    }
    
    /**
     * Register a new user
     *
     * @throws \Exception
     */
    public function create(): void
    {
        // test this request comes from authorized client application
        $this->validateClientApplication();
        
        // Get the request body
        $body = file_get_contents('php://input');
        $bodyData = json_decode($body, true);
        
        // Check if the request body contains the required fields
        if (!isset($bodyData['identity']) || !isset($bodyData['secret'])) {
            $this->view->render(['error' => 'Invalid request'], 400);
        }
        
        // submit to the UserModel
        try {
            $user = $this->userModel->createUser($bodyData['identity'], $bodyData['secret']);
        } catch (\Exception $e) {
            $this->view->render(['error' => 'User already exists'], 409);
            return;
        }
        
        $this->view->render($user);
    }
    
    /**
     * @return void
     */
    public function update(): void
    {
    
    }
    
    /**
     * delete endpoint
     *
     * @param string $userId
     * @return void
     * @throws \Exception
     */
    public function delete(string $userId): void
    {
        $this->validateClientApplication();
        
        // validate userId format
        Uuid::isValid($userId) ?: $this->view->render(['error' => 'Invalid request'], 400);
        
        // submit to the UserModel
        try {
            $this->userModel->deleteUserById(Uuid::fromString($userId));
        } catch (\Exception $e) {
            $this->view->render(['message' => 'User not found'], 404);
            return;
        }
        
        $this->view->render(['message' => 'User deleted'],204);
    }
    
    
    /**
     * Validate the Authorization header $clientId and $clientSecret
     * that date is base64 encoded and separated by a colon.
     * If the client is not authorized, return a 401 Unauthorized response.
     *
     * @return void
     */
    private function validateClientApplication(): void
    {
        $headers = getallheaders();
        $authorizationHeader = $headers['Authorization'] ?? null;
        
        if ($authorizationHeader === null) {
            $this->view->render(['error' => 'Not allowed'], 403);
        }
        
        // Extract clientId and clientSecret from the Authorization header
        if (preg_match('/Basic\s(\S+)/', $authorizationHeader, $matches)) {
            $decodedAuth = base64_decode($matches[1]);
            [$clientId, $clientSecret] = explode(':', $decodedAuth, 2);
        } else {
            $this->view->render(['error' => 'Invalid request'], 400);
        }
        
        if (!$this->authService->clientIsAuthorized($clientId, $clientSecret)) {
            $this->view->render(['error' => 'Invalid client credentials'], 401);
        }
    }
}