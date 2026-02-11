<?php

namespace pwa\View;

class JsonView
{
    
    private array $corsOrigins;
    
    public function __construct(array $corsOrigins = [])
    {
        $this->corsOrigins = $corsOrigins;
    }
    
    /**
     * Renders the provided data as a JSON response.
     *
     * @param mixed $data The data to be encoded as JSON.
     * @param int $statusCode HTTP status code (default is 200).
     * @return void
     */
    public function render(mixed $data, int $statusCode = 200): void
    {
        // Set the HTTP status code.
        http_response_code($statusCode);
        
        // Set the Content-Type header to application/json.
        header('Content-Type: application/json');
        
        // set the Access-Control-Allow-Origin header to allow cross-origin requests
        foreach ($this->corsOrigins as $corsOrigin) {
            header('Access-Control-Allow-Origin: ' . $corsOrigin);
        }
        
        // Encode the data as JSON and output it.
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
