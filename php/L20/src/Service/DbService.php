<?php

namespace l20\Service;

use PDO;
use PDOException;

/**
 *
 */
class DbService {
    /**
     * @var string
     */
    private string $host;
    /**
     * @var int
     */
    private int $port;
    /**
     * @var string
     */
    private string $dbname;
    /**
     * @var string
     */
    private string $user;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var PDO
     */
    private PDO $pdo;
    /**
     * @var \PDOStatement
     */
    private \PDOStatement $stmt;
    
    /**
     * @param string $host
     * @param int $port
     * @param string $dbname
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, int $port, string $dbname, string $user, string $password) {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        
        $this->connect();
    }
    
    /**
     * @return void
     */
    private function connect(): void
    {
        $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->password";
        
        try {
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
    
    /**
     * @param string $query
     * @param array $params
     * @return false|array
     */
    public function query(string $query, array $params = []): false|array
    {
        //var_dump($query, $params);
        
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->execute($params);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * @param string $query
     * @param array $params
     * @return bool
     */
    public function execute(string $query, array $params = []): bool
    {
        $this->stmt = $this->pdo->prepare($query);
        return $this->stmt->execute($params);
    }
    
    /**
     * @return false|array
     */
    public function getResult(): false|array
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * @return int
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }
}
