<?php

namespace pwa\Service;

use pwa\Entity\Person;
use PDO;

class PersonModel
{
    private PDO $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Creates a new person in the database.
     *
     * @param Person $person The person entity to insert.
     * @return bool True on success, false on failure.
     */
    public function create(Person $person): bool
    {
        $sql = "INSERT INTO person (first_name, last_name, email, phone)
                VALUES (:first_name, :last_name, :email, :phone)";
        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute([
            ':first_name' => $person->getFirstname(),
            ':last_name'  => $person->getLastname(),
            ':email'      => $person->getEmail(),
            ':phone'      => $person->getPhone(),
        ]);
        
        if ($result) {
            // For PostgreSQL, adjust the sequence name if necessary.
            $person->id = (int)$this->pdo->lastInsertId('person_id_seq');
        }
        
        return $result;
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
            $persons[] = new Person(
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone'],
                (int)$row['id']
            );
        }
        return $persons;
    }
    
    /**
     * Deletes a person from the database by ID.
     *
     * @param int $id The ID of the person to delete.
     * @return bool True on success, false on failure.
     */
    public function delete(int $id): bool
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
     * @throws InvalidArgumentException If neither email nor phone is provided.
     */
    public function getByEmailOrPhone(?string $email, ?string $phone): array
    {
        if ($email === null && $phone === null) {
            throw new InvalidArgumentException('Either email or phone must be provided.');
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
            $persons[] = new Person(
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone'],
                (int)$row['id']
            );
        }
        return $persons;
    }
}
