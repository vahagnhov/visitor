<?php

require_once 'DbConfig.php';

class Crud extends DbConfig
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get row inside table
     *
     * @param string $sql
     * @return array $result
     */
    public function getData($sql)
    {
        $data = $this->connection->prepare($sql);
        $data->execute();
        $result = $data->fetch(\PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Update row inside table
     *
     * @param string $sql
     * @param integer $id
     * @return int current Id inside table
     */
    public function update($sql, $id)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $update = $stmt->execute([':id' => $id]);
        } catch (\Exception $e) {
            die("There's an error in the query!");
        }
        return $update;
    }

    /**
     * Insert row inside table
     * @param string $sql
     * @param array $dataArray
     * @return int last insert Id inside table
     */
    public function create($sql, $dataArray)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $create = $stmt->execute($dataArray);
        } catch (\Exception $e) {
            die("There's an error in the query!");
        }
        return $create;
    }
}

?>