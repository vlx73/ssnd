<?php

namespace pwa\Service;

use PDO;
use pwa\Entity\User;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 *
 */
class UserModel
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
     * @param string $userName
     * @return User
     * @throws \Exception
     */
    public function getUserByUsername(string $userName): User
    {
        $stmt = $this->pdo->prepare("SELECT id, password_hash FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
        $stmt->execute();
        
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$userData) {
            throw new \Exception('User not found');
        }
        
        return new User($userData['id'], $userName, $userData['password_hash']);
    }
    
    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws \Exception
     */
    public function createUser(string $username, string $password): User
    {
        // Check if the username already exists
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            throw new \Exception('User already exists');
        }
        
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Create a new User instance
        $user = $this->hydrate(
            [
                'id'            => Uuid::uuid4(),
                'username'      => $username,
                'password_hash' => $hashedPassword,
            ]
        );
        
        $userId = $user->getId()->toString();
        
        // Insert the new user
        $stmt = $this->pdo->prepare("INSERT INTO users (id, username, password_hash) VALUES (:id, :username, :password_hash)");
        $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $hashedPassword, PDO::PARAM_STR);
        
        if (!$stmt->execute()) {
            throw new \Exception('User not saved');
        }
        
        return $user;
    }
    
    /**
     * Delete a user by their identity (username).
     *
     * @param string $identity
     * @return bool
     * @throws \Exception
     */
    public function deleteUserById(UuidInterface $userId): bool
    {
        $user_id = $userId->toString();
        
        // Check if the user exists
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE id = :user_id LIMIT 1");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        
        if (!$stmt->fetch()) {
            throw new \Exception('User not found');
        }
        
        // Delete the user
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    
    private function hydrate(array $data): User
    {
        return new User($data['id'], $data['username'], $data['password_hash']);
    }
}