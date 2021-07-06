<?php


class ContactTypeRepository
{
    private $tableName = 'contact_type';
    private $connection;

    function __construct(){
        $db = new DBConnection();
        $this->connection =  $db->getConnection();
    }

    /**
     * @param $id
     * @return array|string
     */
    function findOne($id)
    {
        $sql = 'SELECT id, name';
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
            return 'Error at ContactTypeRepository/read';
        }
    }


    /**
     * @param $id
     * @return array|string
     */
    function findMany(){
        $sql='SELECT id, name';
        $sql.=' FROM ' . $this->tableName;
        $sql .= ';';
        $finale=[];
        $result = $this->connection->query($sql);
        if($result){
            while($row=mysqli_fetch_assoc($result))
                array_push($finale,$row);
            return $finale;
        }
        else
            return 'Error at ContactTypeRepository/read';
    }
}
