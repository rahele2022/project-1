<?php

class DB
{
    protected $link;
    private $dsn , $server , $dbName , $dbUser , $dbPass;

    public function __construct($server , $db ,$user , $pass  )
    {
        $this->dsn = 'mysql:host=' . $server . ';db=' . $db;
        $this->server = $server;
        $this->dbName = $db;
        $this->dbUser = $user;
        $this->dbPass = $pass;
        $this->connect();

    }

    public function connect()
    {
        try {
            $this->link = new PDO($this->dsn , $this->dbUser , $this->dbPass);
            $this->link->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo 'Connection Failed :' . $e->getMessage();
        }


    }

    public function insert(){

    }
    public function select(){

    }
    public function delete(){

    }
}


