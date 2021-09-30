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
            }
            // Retourne l'objet métier
            return $note;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM note";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $note = array();
            foreach ($rows as $row) {
                $note[] = new Note($row);
            }
            // Retourne un tableau d'objets
            return $note;
        } // function findAll()
    }
?>