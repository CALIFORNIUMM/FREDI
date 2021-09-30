<?php
    class LigueDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_ligue) {
            $sql = "SELECT * FROM ligue WHERE id_ligue= :id_ligue";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_ligue" => $id_ligue));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $ligue=null;
            if($row) {
                
                $ligue = new Ligue($row);
            }
            // Retourne l'objet
            return $ligue;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM ligue";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $ligue = array();
            foreach ($rows as $row) {
                $ligue[] = new Ligue($row);
            }
            // Retourne un tableau d'objets
            return $ligue;
        } // function findAll()
    }
?>