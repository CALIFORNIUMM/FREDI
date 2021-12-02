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
            $lignes = array();
            foreach ($rows as $row) {
                $lignes[] = new Ligne($row);
            }
            // Retourne un tableau d'objets
            return $lignes;
        } // function findAll()

        /**
        * Lecture de toutes les lignes d'un ID note
        * @param int $id_note
        * @return \Ligne
        * @throws Exception
        */
        function findAllByIdNote($id_note) {
            $sql = "select * from ligne where id_note = :id_note";
            try {
                $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":id_note" => $id_note));
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $lignes = array();
            foreach ($rows as $row) {
            $lignes[] = new Ligne($row);
            }
            // Retourne un tableau d'objets
            return $lignes;
        } //findAllByIdNote()


        /**
    * Ajout d'une ligne
    * @param \Ligne
    * @return int Nombre de mises à jour
    */
    public function insert(ligne $ligne)
    {
        $sql = "INSERT INTO ligne(lib_trajet, nb_km, mt_peage, mt_repas, mt_hebergement, id_motif, id_note) 
        values (:lib_trajet, :nb_km, :mt_peage, :mt_repas, :mt_hebergement, :id_motif, :id_note)";
        $params = array(
          ":lib_trajet" => $ligne->get_lib_trajet(),
          ":nb_km" => $ligne->get_nb_km(),
          ":mt_peage" => $ligne->get_mt_peage(),
          ":mt_repas" => $ligne->get_mt_repas(),
          ":mt_hebergement" => $ligne->get_mt_hebergement(),
          ":id_motif" => $ligne->get_id_motif(),
          ":id_note" => $ligne->get_id_note()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()

    /**
    * Modification d'une ligne
    * @param \ligne
    * @return int Nombre de mises à jour
    */
    public function update(ligne $ligne)
    {
        $sql = "update ligne set lib_trajet=:lib_trajet,nb_km=:nb_km,mt_peage=:mt_peage,mt_repas=:mt_repas,mt_hebergement=:mt_hebergement,id_motif=:id_motif where id_ligne= :id_ligne";
        $params = array(
            ":id_ligne" => $ligne->get_id_ligne(),
            ":lib_trajet" => $ligne->get_lib_trajet(),
            ":nb_km" => $ligne->get_nb_km(),
            ":mt_peage" => $ligne->get_mt_peage(),
            ":mt_repas" => $ligne->get_mt_repas(),
            ":mt_hebergement" => $ligne->get_mt_hebergement(),
            ":id_motif" => $ligne->get_id_motif()
        );
        try {
            $sth = $this->pdo->prepare($sql); // On passe par la méthode de la classe mère
            $sth->execute($params);
            $nb = $sth->rowCount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // update()

    /**
    * Suppression d'une ligne
    * @param int ID de la ligne
    * @return int Nombre de mises à jour
    */
    public function delete($id_ligne)
    {
        $sql = "DELETE FROM ligne WHERE id_ligne= :id_ligne";
        $params = array(
        ":id_ligne" => $id_ligne
        );
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params); // On passe par la méthode de la classe mère
            $nb = $sth->rowCount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    }

    }
?>