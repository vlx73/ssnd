<?php

namespace app\Service;

class DbService
{
    private string $host;
    private int $port;
    private string $dbname;
    private string $user;
    private string $password;
    private string $connection;
    
    private function __construct()
    {
    
    }
    
    public static getInstance( ): DbService
    {
        return new self();
    }
    
    public function connect(
    string $host,
    int $port,
    string $dbname,
    string $user,
    string $password
)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        
        $this->connection = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
        return new \PDO($dsn, $this->user, $this->password);
    }
    
}