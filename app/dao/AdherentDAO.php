<?php
    class AdherentDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_adherent) {
            $sql = "SELECT * FROM adherent WHERE id_adherent= :id_adherent";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_adherent" => $id_adherent));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $adherent=null;
            if($row) {
                
                $adherent = new Adherent($row);
            }
            // Retourne l'objet métier
            return $adherent;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM adherent";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $adherent = array();
            foreach ($rows as $row) {
                $adherent[] = new Adherent($row);
            }
            // Retourne un tableau d'objets "salarié"
            return $adherent;
        } // function findAll()
    }
?>