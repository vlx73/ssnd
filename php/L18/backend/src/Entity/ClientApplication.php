<?php

namespace pwa\Entity;

/**
 *
 */
class ClientApplication
{
    /**
     * @var string
     */
    private string $clientId;
    /**
     * @var string
     */
    private string $clientSecret;
    
    /**
     * @var string
     */
    private string $corsOrigin;
    
    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }
    
    /**
     * @param string $clientId
     * @return void
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }
    
    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }
    
    /**
     * @param string $clientSecret
     * @return void
     */
    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }
    
    /**
     * @return string
     */
    public function getCorsOrigin(): string
    {
        return $this->corsOrigin;
    }
    
    public function setCorsOrigin(string $corsOrigin): void
    {
        $this->corsOrigin = $corsOrigin;
    }
    
    
    
}