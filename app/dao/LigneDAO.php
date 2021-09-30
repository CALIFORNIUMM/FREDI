<?php
    class LigneDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_ligne) {
            $sql = "SELECT * FROM ligne WHERE id_ligne= :id_ligne";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_ligne" => $id_ligne));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $ligne=null;
            if($row) {
                
                $ligne = new Ligne($row);
            }
            // Retourne l'objet
            return $ligne;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM ligne";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $ligne = array();
            foreach ($rows as $row) {
                $ligne[] = new Ligne($row);
            }
            // Retourne un tableau d'objets
            return $ligne;
        } // function findAll()
    }
?>