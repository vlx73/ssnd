<?php

namespace pwa\Service;

use pwa\Entity\Person;
use PDO;
use Ramsey\Uuid\Uuid;

/**
 *
 */
class PersonModel
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
            getenv('POSTGRES_HOST') ?? 'localhost',
            getenv('POSTGRES_PORT_PORT') ?? '5432',
            getenv('POSTGRES_DB') ?? 'your_database'
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
     * Creates a new person in the database.
     *
     * @param Array $personData The person entity to insert.
     * @return Person True on success, false on failure.
     */
    public function create(array $personData): Person
    {
        $person = $this->hydratePerson($personData);
        
        // insert the data to the database
        $sql = "INSERT INTO person (id, first_name, last_name, email, phone)
                VALUES (:id, :first_name, :last_name, :email, :phone)";
        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute([
            ':id'         => $person->getId(),
            ':first_name' => $person->getFirstname(),
            ':last_name'  => $person->getLastname(),
            ':email'      => $person->getEmail(),
            ':phone'      => $person->getPhone(),
        ]);
        
        if (!$result) {
            throw new \RuntimeException('Error creating person');
        }
        
        return $person;
    }
    
    /**
     * Retrieves all persons from the database.
     *
     * @return Person[] Array of Person entities.
     */
    public function getAll(): array
    {
        $sql = "SELECT id, first_name, last_name, email, phone FROM person";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $persons = [];
        foreach ($rows as $row) {
            // add the Person entity to the array
            $persons[] = $this->hydratePerson($row);
        }
        return $persons;
    }
    
    /**
     * Deletes a person from the database by ID.
     *
     * @param Uuid $id The ID of the person to delete.
     * @return bool True on success, false on failure.
     */
    public function delete(Uuid $id): bool
    {
        $sql = "DELETE FROM person WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    /**
     * Retrieves persons by email or phone.
     *
     * Either parameter can be provided. If both are provided, the query uses OR to match either.
     *
     * @param string|null $email The email to search for.
     * @param string|null $phone The phone to search for.
     * @return Person[] Array of Person entities that match the criteria.
     * @throws \InvalidArgumentException If neither email nor phone is provided.
     */
    public function getByEmailOrPhone(?string $email, ?string $phone): array
    {
        if ($email === null && $phone === null) {
            throw new \InvalidArgumentException('Either email or phone must be provided.');
        }
        
        $conditions = [];
        $params = [];
        
        if ($email !== null) {
            $conditions[] = "email = :email";
            $params[':email'] = $email;
        }
        
        if ($phone !== null) {
            $conditions[] = "phone = :phone";
            $params[':phone'] = $phone;
        }
        
        $sql = "SELECT id, first_name, last_name, email, phone FROM person WHERE " . implode(" OR ", $conditions);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $persons = [];
        foreach ($rows as $row) {
            // add the Person entity to the array
            $persons[] = $this->hydratePerson($row);
        }
        return $persons;
    }
    
    /**
     * Create a person object from an array of data
     *
     * @param array $personData
     * @return Person
     */
    private function hydratePerson(array $personData): Person
    {
        // create a new Person entity
        $person = new Person();
        
        // if the ID is provided, use it, otherwise generate a new one
        if (isset($personData['id'])) {
            $person->setId(Uuid::fromString($personData['id']));
        } else {
            $person->setId(Uuid::uuid4());
        }
        
        // set required fields
        $person->setLastname($personData['last_name']);
        
        // set optional first name
        if(isset($personData['first_name'])) {
            $person->setFirstname($personData['first_name']);
        }
        
        // set optional email
        if (isset($personData['email'])) {
            $person->setEmail($personData['email']);
        }
        
        // set optional phone number
        if (isset($personData['phone'])) {
            $person->setPhone($personData['phone']);
        }
        
        return $person;
    }
}
