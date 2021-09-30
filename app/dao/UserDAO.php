<?php
    class UserDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_utilisateur) {
            $sql = "SELECT * FROM utilisateur WHERE id_utilisateur= :id_utilisateur";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_utilisateur" => $id_utilisateur));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $user=null;
            if($row) {
                
                $user = new User($row);
            }
            // Retourne l'objet métier
            return $user;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM utilisateur";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $user = array();
            foreach ($rows as $row) {
                $user[] = new User($row);
            }
            // Retourne un tableau d'objets "salarié"
            return $user;
        } // function findAll()
    }
?>