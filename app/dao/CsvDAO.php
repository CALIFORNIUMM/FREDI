<?php
    class CsvDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }

        function insert($csv) {
            // Import du fichier CSV sous la forme d'un tablau PHP
            $rows = load_from_csv(ROOT . DS . "files" . DS ."".$csv.".csv", 2);
            // Génération des ordres SQL de réinitialisation de la base (drop/create)
            $sql = file_get_contents(ROOT . DS . "storage" . DS . "__fredi21_structure.sql") . PHP_EOL;
            // Génération de l'ordre SQL "INSERT"
            $sql .= "USE fredi21;" . PHP_EOL;
            $sql .= "INSERT INTO motif (id_motif, lib_motif) VALUES " . PHP_EOL;
            foreach ($rows as $row) {
                $sql .= "(";
                $sql .= $this->pdo->quote( $row[0], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[1], PDO::PARAM_STR) ;
                $sql .= ")," . PHP_EOL;
            }
            // Enlève la dernière virgule qui est en trop
            $sql = rtrim($sql, PHP_EOL);
            $sql = rtrim($sql, ',');

            // Exécution des ordres SQL
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
        }
    } // function find()
?>