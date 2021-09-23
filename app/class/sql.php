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

    function get_user(int $id){
        $sql="SELECT * FROM utilisateur WHERE id_utilisateur = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_adherent(int $id){
        $sql="SELECT * FROM adherent WHERE id_adherent = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_club(int $id){
        $sql="SELECT * FROM club WHERE id_club = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_ligue(int $id){
        $sql="SELECT * FROM ligue WHERE id_ligue = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_ligne(int $id){
        $sql="SELECT * FROM ligne WHERE id_ligne = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_motif(int $id){
        $sql="SELECT * FROM motif WHERE id_motif = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_periode(int $id){
        $sql="SELECT * FROM periode WHERE id_periode = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    function get_note(int $id){
        $sql="SELECT * FROM note WHERE id_note = :id";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":id" => $id
        ));
        $response = $request->fetch();
        return $response;
    }

    public function new_user(Array $user){
        $sql="INSERT INTO utilisateur(pseudo, mdp, mail, nom, prenom, role) VALUES (:pseudo, :mdp, :mail, :nom, :prenom, 1)";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":pseudo" => $user[0],
            ":mdp" => $user[1],
            ":mail" => $user[2],
            ":nom" => $user[3],
            ":prenom" => $user[4],
        ));
    }

    public function is_exist_pseudo($pseudo){
        $sql="SELECT count(*) as nb FROM utilisateur WHERE pseudo = :pseudo";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":pseudo" => $pseudo
        ));
        $response = $request->fetch();
        if($response['nb'] == 0){
            return False;
        }else{
            return True;
        };
    }

    public function is_exist_mail($mail){
        $sql="SELECT count(*) as nb FROM utilisateur WHERE mail = :mail";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":mail" => $mail
        ));
        $response = $request->fetch();
        if($response['nb'] == 0){
            return False;
        }else{
            return True;
        };
    }

    function connexion_user($pseudo){
        $sql="SELECT id_utilisateur, mdp FROM utilisateur WHERE pseudo = :pseudo";
        $request=$this->dbh->prepare($sql);
        $request->execute(array(
            ":pseudo" => $pseudo
        ));
        $response = $request->fetch();
        return $response;
    }
}

?>