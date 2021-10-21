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
                $lignes = $lignesDAO->findAllByIdNote($id_note);
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
    }
?>