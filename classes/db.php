<?php

class db{

    private $dbhost = 'localhost';
    private $dbname = 'mydemy';
    private $dbuser = 'toto';
    private $dbpwd = '';
    private $pdo ;

public function __construct()
{
   try{
$this->pdo=new PDO("mysql:host=$this->dbhost;dbname=$this->dbname",$this->dbuser,$this->dbpwd);
$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e) 
{   echo 'failed connection' .$e->getMessage();
}



}

public function connect(){
    return $this->pdo;
}


}

