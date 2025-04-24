<?php

namespace pwa\View;

use InvalidArgumentException;

/**
 * Renders HTML views.
 */
class HtmlView
{
    private string $templatesDir;
    
    public function __construct()
    {
        $basePath = dirname(__DIR__);
        $this->templatesDir = $basePath . '/templates';
        
        if (!is_dir($this->templatesDir)) {
            throw new InvalidArgumentException("Templates directory not found or is not a directory: " . $this->templatesDir);
        }
    }
    
    /**
     * Renders the specified HTML template file.
     *
     * @param string $templateFilename The name of the template file (e.g., 'index.html') relative to the templates directory.
     * @param int $responseCode The HTTP response code to send (default: 200)
     *
     * @return void
     * @throws InvalidArgumentException If the template file does not exist or is not readable.
     */
    public function render(string $templateFilename, int $responseCode = 200): void
    {
        $filePath = $this->templatesDir . '/' . ltrim($templateFilename, '/');
        
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("Template file not found or is not readable: " . $templateFilename . " (Resolved path: " . $filePath . ")");
        }
        
        // Set headers only if they haven't been sent yet
        http_response_code($responseCode);
        header('Content-Type: text/html; charset=UTF-8');
        
        readfile($filePath);
    }
}
