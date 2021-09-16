<?php
class sql extends PDO {

    public $dbh;
    private $host ="localhost";
    private $user="histage";
    private $password="Limayrac#31";
    private $db="histage";

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

    function user($id_user){
        $sql="SELECT * FROM users WHERE id = :id_utilisateur";
        $request = $this->dbh->prepare($sql);
        $request->execute(array(
            ':id_utilisateur'=>$id_user
        ));
        $response=$request->fetch();
        return $response;
    }
}

?>