<?php

require_once(__DIR__.'/../database/DBConnection.php');

class ContactRepository
{
    private $tableName = 'contact';

    function __construct()
    {
        $db = new DBConnection();
        $this->connection = $db->getConnection();
    }

    /**
     * @param ContactModel $contact
     * @return int|string
     */
    function create($contact)
    {
        $sql = 'INSERT INTO '.$this->tableName.'(first_name, last_name , date_of_birth, email, tel, contact_type_id)';
        $sql .= ' VALUES(';
        $sql .= '\''.$contact->getFirstName().'\',';
        $sql .= '\''.$contact->getLastName().'\',';
        $sql .= '\''.$contact->getDateOfBirth().'\',';
        $sql .= '\''.$contact->getEmail().'\',';
        $sql .= '\''.$contact->getTelephone().'\',';
        $sql .= '\''.$contact->getContactTypeId().'\',';
        $sql = rtrim($sql, ',');
        $sql .= ')';
        $sql .= ';';
        $result = $this->connection->query($sql);
        if ($result === true) {
            return $this->connection->insert_id;
        }

        return 'Error at ContactRepository/create';
    }

    /**
     * @param ContactModel $contact
     * @return bool|mysqli_result|string
     */
    function update($contact)
    {
        $sql = 'UPDATE '.$this->tableName;
        $sql .= ' SET ';
        $sql .= 'first_name =\''.$contact->getFirstName().'\',';
        $sql .= 'last_name =\''.$contact->getLastName().'\',';
        $sql .= 'date_of_birth =\''.$contact->getDateOfBirth().'\',';
        $sql .= 'email =\''.$contact->getEmail().'\',';
        $sql .= 'tel =\''.$contact->getTelephone().'\',';
        $sql .= 'contact_type_id =\''.$contact->getContactTypeId().'\'';
        $sql = rtrim($sql, ',');

        $sql .= ' WHERE id = '.$contact->getId();

        $sql .= ';';

        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        } else {
            return 'Error at ContactRepository/create';
        }
    }

    /**
     * @param ContactModel $contact
     * @return bool|mysqli_result|string
     */
    function delete($contact)
    {
        $sql = 'DELETE FROM '.$this->tableName;

        $sql .= ' WHERE id = '.$contact->getId();
        $sql .= ';';
        $result = $this->connection->query($sql);

        if ($result) {
            return $result;
        } else {
            return 'Error at CJ_MODEL/delete';
        }
    }

    /**
     * @param $id
     * @return array|string
     */
    function findOne($id)
    {
        $sql = 'SELECT id, first_name, last_name , date_of_birth, email, tel, contact_type_id';
        $sql = rtrim($sql, ',');
        $sql .= ' FROM '.$this->tableName;
        $sql .= ' WHERE id = '.$id;

        $sql .= ';';
        $finale = [];

        $result = $this->connection->query($sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($finale, $row);
            }

            return $finale[0];
        } else {
            return 'Error at CJ_MODEL/read';
        }
    }

    /**
     * @param $id
     * @return array|string
     */
    function findMany($start = 0, $size = 10)
    {
        $sql = 'SELECT id, first_name, last_name , date_of_birth, email, tel, contact_type_id';
        $sql = rtrim($sql, ',');
        $sql .= ' FROM '.$this->tableName;
        $sql .= ' LIMIT '.$start.' , '.$size;
        $sql .= ';';
        $finale = [];

        $result = $this->connection->query($sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($finale, $row);
            }

            return $finale;
        } else {
            return 'Error at CJ_MODEL/read';
        }
    }
}
