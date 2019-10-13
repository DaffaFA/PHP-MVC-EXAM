<?php


class Database {

    public $pdo;
    public $stmt;

    public function __construct()
    {
        try 
        {
            $this->pdo = new PDO("mysqli:host=localhost;dbname=native", 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (Exception $ex)
        {
            die($ex->getMessage());
        }
    }

    /**
     * Query SQL
     * @param string SQL syntax
     */
    public function query($statement)
    {
        $this->stmt = $this->pdo->prepare($statement);
    }

    /**
     * Bind with prepare method SQL
     * @param mixed $parameter
     * @param mixed $value
     * @param mixed $type
     * 
     */
    public function bind($parameter, $value, $type)
    {
        if ( is_null($type) ) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function fetchAll()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }
    
    public function fetch()
    {
        $this->stmt->execute();
        return $this->stmt->fetch();
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}