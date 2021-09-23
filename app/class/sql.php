<?php
class sql extends PDO {

    public $dbh;
    private $host ="localhost";
    private $user="fredi21";
    private $password="Limayrac#31";
    private $db="fredi21";

    function __construct()
    {
        $dsn="mysql:host=".$this->host.";dbname=".$this->db;
        try{
            $this->dbh= new PDO($dsn, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $ex){
            die("Erreur lors de la  connexion SQL : ".$ex->getMessage());
        }
    }

    function select_all($table){
        $sql="select * from ".$table;
        $request=$this->dbh->prepare($sql);
        $request->execute();
        $response=$request->fetchAll();
        return $response;
    }
}

?>