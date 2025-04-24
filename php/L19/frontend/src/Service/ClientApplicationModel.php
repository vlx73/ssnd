<?php

namespace pwa\Service;

use pwa\Entity\ClientApplication;
use PDO;

/**
 *
 */
class ClientApplicationModel
{
    /**
     * @var PDO
     */
    private PDO $pdo;
    
    /**
     *
     */
    public function __construct()
    {
        // setup DSN - Data Source Name
        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s',
            getenv('POSTGRES_HOST') ? getenv('POSTGRES_HOST') : 'localhost',
            getenv('POSTGRES_PORT') ? getenv('POSTGRES_PORT') : 5432,
            getenv('POSTGRES_DB') ? getenv('POSTGRES_DB') : 'your_database'
        );
        
        // setup DB connection options
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        // get username and password from the environment
        $dbUser = getenv('POSTGRES_USER') ?? 'default_user';
        $dbPass = getenv('POSTGRES_PASSWORD') ?? 'default_password';
        
        // create a new PDO - PHP Data Objects instance
        $this->pdo = new PDO($dsn, $dbUser, $dbPass, $options);
    }
    
    /**
     * Get exactly one client application by client_id
     *
     * @param string $clientId
     * @return ClientApplication|null
     */
    public function getClientByClientId(string $clientId): ?ClientApplication
    {
        $stmt = $this->pdo->prepare("SELECT client_id, client_secret FROM client_applications WHERE client_id = :client_id LIMIT 1");
        $stmt->bindParam(':client_id', $clientId, PDO::PARAM_STR);
        $stmt->execute();
        
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$clientData) {
            return null;
        }
        
        $clientApplication = new ClientApplication();
        $clientApplication->setClientId($clientData['client_id']);
        $clientApplication->setClientSecret($clientData['client_secret']);

        return $clientApplication;
    }
}