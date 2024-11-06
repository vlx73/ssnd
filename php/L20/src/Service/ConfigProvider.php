<?php

namespace l20\Service;

class ConfigProvider
{
    public function getConfig(string $key): array
    {
        if ($key === 'db') {
            return [
                'host'     => $_ENV['POSTGRES_HOST'],
                'port'     => $_ENV['POSTGRES_PORT'] ?? '5432',
                'dbname'   => $_ENV['APP_DB_NAME'],
                'user'     => $_ENV['POSTGRES_USER'],
                'password' => $_ENV['POSTGRES_PASSWORD'],
            ];
        }
        
        return [];
    }
}