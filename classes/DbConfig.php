<?php

class DbConfig
{
    /**
     * @var string type of database
     */
    private $_type = 'mysql';
    /**
     * @var string host of database
     */
    private $_host = 'localhost';
    /**
     * @var string name of database
     */
    private $_database = 'visitor';
    /**
     * @var string username of database
     */
    private $_username = 'root';

    /**
     * @var string password of database
     */
    private $_password = 'root';

    /**
     * @var array set error reporting, set default fetch mode
     */
    private $options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,);

    protected $connection;

    public function __construct()
    {
        if (!isset($this->connection)) {

            $pdo = new \PDO("{$this->_type}:host={$this->_host};dbname={$this->_database}", $this->_username, $this->_password);

            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->connection = $pdo;

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }
        }

        return $this->connection;
    }
}

?>