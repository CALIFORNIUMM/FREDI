<?php
    class ClubDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_club) {
            $sql = "SELECT * FROM club WHERE id_club= :id_club";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_club" => $id_club));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $club=null;
            if($row) {
                
                $club = new Club($row);
            }
            // Retourne l'objet
            return $club;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM club";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $club = array();
            foreach ($rows as $row) {
                $club[] = new Club($row);
            }
            // Retourne un tableau d'objets
            return $club;
        } // function findAll()

        function findClubByLigue($id_ligue){
            $sql = "SELECT * FROM club,ligue  WHERE ligue.id_ligue= club.id_ligue AND ligue.id_ligue = :id_ligue";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_ligue" => $id_ligue));
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $club = array();
            foreach ($rows as $row) {
                $club[] = new Club($row);
            }
            // Retourne un tableau d'objets
            return $club;
        } // function find()
        
    }
?>