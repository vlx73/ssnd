<?php

namespace pwa\Controller;

use pwa\Service\AuthService;
use pwa\Service\PersonModel;
use pwa\View\JsonView;
use Ramsey\Uuid\Uuid;

/**
 *
 */
class PersonController
{
    /**
     * @var AuthService
     */
    private AuthService $authService;
    private JsonView $view;
    
    /**
     *
     */
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->view = new JsonView();
    }
    
    /**
     * @return void
     */
    public function read(): void
    {
        try {
            $this->authService->validateToken();
        } catch (\Exception) {
            $this->view->render(['error' => 'Unauthorized'], 401);
        }
        
        // echo "hallo from index";
        $personModel = new PersonModel();
        $data = $personModel->getAll();
        
        $view = new JsonView();
        $view->render($data);
    }
    
    /**
     * Action for creating a new person.
     *
     * @return void
     */
    public function create(): void
    {
        
        $personModel = new PersonModel();
        
        // get the request body
        $body = file_get_contents('php://input');
        $bodyData = json_decode($body, true);
        
        // here we should validate the data
        //TODO: validate the data
        
        // create a new person
        $data = $personModel->create($bodyData);
        
        $view = new JsonView();
        $view->render($data);
    }
    
    /**
     * Action for deleting a person.
     *
     * @param Uuid $id
     * @return void
     */
    public function delete(Uuid $id): void
    {
        $personModel = new PersonModel();
        $view = new JsonView();
        
        if ($personModel->delete($id)) {
            $view->render([], 204);
            
        } else {
            $view->render(['message' => 'Person not found'], 404);
        }
        
    }
}