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

        public function cumulFraisLigue()
        {
            $sql = "SELECT ligue.id_ligue, ligue.lib_ligue, SUM(note.mt_total) as total
            FROM ligue, club, adherent, utilisateur, note, periode
            WHERE ligue.id_ligue = club.id_ligue
            AND club.id_club = adherent.id_club
            AND utilisateur.id_utilisateur = adherent.id_utilisateur
            AND note.id_utilisateur = utilisateur.id_utilisateur
            AND note.id_periode = periode.id_periode
            AND periode.est_active = 1
            GROUP BY ligue.id_ligue;";

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