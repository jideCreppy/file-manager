<?php


class Database {

    private $table_name;
    public $connection;


    private $host_name;
    private $database;
    private $username;
    private $password;

    public function __construct(){

        $this->host_name    = "localhost";
        $this->database     = "file_manager";
        $this->username     = "root";
        $this->password     = "samuraijack1";
    }

    public function connect(){

        $this->connection = null;
        
        try{

            $this->connection = new PDO("mysql:host=".$this->host_name.";dbname=".$this->database,
            $this->username,$this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){

                echo "Error connecting to the database server. Error - ".$e->getMessage();

        }

        return $this->connection;
    }


}
