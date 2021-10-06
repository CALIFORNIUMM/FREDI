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
            // Retourne l'objet
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
            // Retourne un tableau d'objets
            return $adherent;
        } // function findAll()

        public function newAdherent(Adherent $adherent){
            $sql = "INSERT INTO adherent(nr_licence, adr1, adr2, adr3, id_utilisateur, id_club) VALUES (:nr_licence, :adr1, :adr2, :adr3, :id_utilisateur, :id_club)";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ":nr_licence" => $adherent->get_nr_licence(),
                    ":adr1" => $adherent->get_adr1(),
                    ":adr2" => $adherent->get_adr2(),
                    ":adr3" => $adherent->get_adr3(),
                    ":id_utilisateur" => $adherent->get_id_utilisateur(),
                    ":id_club" => $adherent->get_id_club()
                ));
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
        }

    }
?>