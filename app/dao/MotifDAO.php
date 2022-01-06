<?php
    class MotifDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_motif) {
            $sql = "SELECT * FROM motif WHERE id_motif= :id_motif";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_motif" => $id_motif));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $motif=null;
            if($row) {
                
                $motif = new Motif($row);
            }
            // Retourne l'objet
            return $motif;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM motif";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $motif = array();
            foreach ($rows as $row) {
                $motif[] = new Motif($row);
            }
            // Retourne un tableau d'objets
            return $motif;
        } // function findAll()

        public function cumulFraisMotif()
        {
            $sql = "SELECT motif.id_motif, motif.lib_motif, SUM(ligne.mt_total) as total
            FROM motif, ligne, note, periode
            WHERE motif.id_motif = ligne.id_motif
            AND ligne.id_note = note.id_note
            AND note.id_periode = periode.id_periode
            AND periode.est_active = 1
            GROUP BY motif.id_motif;";

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