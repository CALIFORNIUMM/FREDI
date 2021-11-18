<?php
    class  PeriodeDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_periode) {
            $sql = "SELECT * FROM periode WHERE id_periode= :id_periode";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_periode" => $id_periode));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $periode=null;
            if($row) {
                
                $periode = new Periode($row);
            }
            // Retourne l'objet
            return $periode;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM periode";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $periode = array();
            foreach ($rows as $row) {
                $periode[] = new Periode($row);
            }
            // Retourne un tableau d'objets
            return $periode;
        } // function findAll()

        function findLibEnCours() {
            $sql = "SELECT lib_periode FROM periode WHERE est_active = 1";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $periode=null;
            if($row) {
                $periode = new Periode($row);
            }
            // Retourne l'objet
            return $periode;
        } // function find()
    }
?>