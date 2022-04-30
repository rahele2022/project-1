<?php

class DB
{
    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;
    protected $conn;
    protected $stmt;

    public function __construct($host , $user , $pass , $dbname)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
    }

    public function connect(){

       $conn = new mysqli($this->host , $this->user ,$this->pass , $this->dbname);

        if ($conn->connect_error){

            die("Connection Failed : " . $conn->connect_error);
        }

    }

    public function insert($name , $family , $email , $age){

        $conn = new mysqli($this->host , $this->user ,$this->pass , $this->dbname);

        $stmt = $conn->prepare("INSERT INTO users(name, family, email,age) VALUES (?,?,?,?)");

        $stmt->bind_param('sssi', $name, $family, $email, $age);

        $stmt->execute();



    }
    public function select(){

    }
    public function delete(){
        
    }
}


