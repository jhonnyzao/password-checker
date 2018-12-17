<?php

namespace Erasys\Models;

class BasePasswordModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Returns all rows from passwords table
     *
     * @return array of associative passwords arrays
     */

    public function fetchAll(): array
    {
        $statement = $this->db->query('SELECT * FROM passwords');

        $result = [];

        try {
            foreach ($statement as $row) {
                array_push($result, $row);
            }
        } catch (\PDOException $e) {
            fwrite(STDERR, $e);
            die(1);
        }

        return $result;
    }

    /**
     * Updates a row from passwords table
     * @param $values associative array with password values
     * $id password unique identifier
     *
     * @return bool
     */

    public function update($values, $id): bool
    {
        $sql = "
            UPDATE passwords
            SET password = :password,
                valid = :valid
            WHERE id = :id
        ";

        $statement = $this->db->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":password", $values['password']);
        $statement->bindValue(":valid", $values['valid']);

        try {
            $result = $statement->execute();
        } catch (\PDOException $e) {
            fwrite(STDERR, $e);
            die(1);
        }

        if (!$result) {
            throw new \Exception(
                sprintf("Password %s could not be updated in database", $values['password'])
            );
        }

        return $result;
    }
}
