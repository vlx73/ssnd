<?php

namespace l20\Service\factory;

use l20\Service\ConfigProvider;
use l20\Service\DbService;
use l20\Service\UserModel;

class UserModelFactory
{
    public function create(): UserModel
    {
        $config = new ConfigProvider();
        $dbConfig = $config->getConfig('db');
        
        $dbService = new DbService(
            $dbConfig['host'],
            $dbConfig['port'],
            $dbConfig['dbname'],
            $dbConfig['user'],
            $dbConfig['password']
        );
        
        return new UserModel($dbService);
    }
}