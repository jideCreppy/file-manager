<?php


class Database
{

    public $connection;
    private $host_name;
    private $username;
    private $password;


    public function __construct()
    {

        $this->host_name = "db";
        $this->database = "file_manager";
        $this->username = "user";
        $this->password = "password";

    }

    /**
     *
     * Database connection class
     *
     * @return PDO object
     */
    public function connect()
    {

        $this->connection = null;

        try {

            $this->connection = new PDO("mysql:host=" . $this->host_name . ";dbname=" . $this->database,
                $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo "Error connecting to the database server. Error - " . $e->getMessage();

        }

        return $this->connection;

    }

}
