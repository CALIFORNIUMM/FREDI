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

        public function cumulFraisClub()
        {
            $sql = "SELECT club.id_club, club.lib_club, SUM(note.mt_total) as total
            FROM club, adherent, utilisateur, note, periode
            WHERE club.id_club = adherent.id_club
            AND utilisateur.id_utilisateur = adherent.id_utilisateur
            AND note.id_utilisateur = utilisateur.id_utilisateur
            AND note.id_periode = periode.id_periode
            AND periode.est_active = 1
            GROUP BY club.id_club;";

            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows=$sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $rows;
        }
        
    }
?>