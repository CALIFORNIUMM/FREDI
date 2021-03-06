<?php
    class NoteDAO extends dao
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_note) {
            $sql = "SELECT * FROM note WHERE id_note= :id_note";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_note" => $id_note));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $note=null;
            if($row) {
                $note = new Note($row);
                $ligneDAO = new LigneDAO();
                $lignes = $ligneDAO->findAllByIdNote($id_note);
                $note->set_lignes($lignes);
            }
            // Retourne l'objet métier
            return $note;
        } // function find()


        /**
        * Lecture de toutes les notes
        * @return array
        * @throws Exception
        */
        function findAll() {
            $sql = "SELECT * FROM note";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $notes = array();
            $lignesDAO = new LigneDAO();
            foreach ($rows as $row) {
                $lignes = $lignesDAO->findAllByIdNote($row["id_note"]);
                $row['lignes']=$lignes;
                $notes[] = new Note($row);
            }
            // Retourne un tableau d'objets
            return $notes;
        } // function findAll()

        function findByUser($id_user) {
            $sql = "SELECT * FROM note, periode WHERE note.id_periode = periode.id_periode AND periode.est_active = 1 AND note.id_utilisateur = :id_utilisateur";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_utilisateur" => $id_user));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $note=null;
            if($row) {
                $note = new Note($row);
                $ligneDAO = new LigneDAO();
                $lignes = $ligneDAO->findAllByIdNote($note->get_id_note());
                $note->set_lignes($lignes);
            }
            // Retourne l'objet métier
            return $note;
        } // function findByUser()

        function findAllByUser($id_user) {
            $sql = "SELECT * FROM note, periode WHERE note.id_periode = periode.id_periode AND periode.est_active = 1 AND note.id_utilisateur = :id_utilisateur";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_utilisateur" => $id_user));
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $notes = array();
            $ligneDAO = new LigneDAO();
            foreach ($rows as $row) {
                $note = new Note($row);
                $lignes = $ligneDAO->findAllByIdNote($note->get_id_note());
                $note->set_lignes($lignes);
                $notes[]=$note;
            }
            // Retourne l'objet métier
            return $notes;
        } // function findByUser()

        function findPeriode(){
          $sql = "SELECT * 
          FROM note, periode, utilisateur
          WHERE periode.id_periode = note.id_periode
          AND note.id_utilisateur = utilisateur.id_utilisateur
          AND periode.est_active = 1";
          try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
          } catch (PDOException $e){
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
          }
          return $rows;
        }

        function createNote($id_utilisateur){
            $id_periode = New PeriodeDAO();
            $id_periode = $id_periode->findLibEnCours()->get_id_periode();
            $sql = "INSERT INTO Note(est_valide, id_periode, id_utilisateur) VALUES (:est_valide, :id_periode, :id_utilisateur)";
            try {
              $sth = $this->pdo->prepare($sql);
              $sth->execute(array(
                  ":est_valide" => 0,
                  ":id_periode" => $id_periode,
                  ":id_utilisateur" => $id_utilisateur
              ));
              $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
              throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $rows;
          }
    }
?>
