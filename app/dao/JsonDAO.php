<?php
    class JsonDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function verif_mdp($mail) {
            $sql = "SELECT mail, mdp FROM utilisateur WHERE mail = :mail;";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":mail" => $mail));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $verif_mdp=null;
            if($row) {
                $verif_mdp = $row;
            }
            // Retourne l'objet
            return $verif_mdp;
        } // function find()

        function get_user_mail($mail) {
            $sql = "SELECT * FROM utilisateur WHERE mail = :mail;";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":mail" => $mail));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $user=null;
            if($row) {
                $user = new User($row);
            }
            // Retourne l'objet
            return $user;
        } // function find()
    }
?>