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

        public function cumulFrais($id_ligue, $annee)
        {
            $sql = "SELECT lib_ligue, lib_club, lib_motif, SUM(mt_total)
            FROM ligue, club, ligne, motif, periode, note
            WHERE ligue.id_ligue=club.id_ligue
            AND ligne.id_motif=motif.id_motif
            AND ligue.id_ligue=:ligue
            AND periode.lib_periode=:annee";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                ":ligue" => $id_ligue,
                ":annee" => $annee
            ));
            $rows=$sth->fetchALL(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $rows;
        }
    }
?>