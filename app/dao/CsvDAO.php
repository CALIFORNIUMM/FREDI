<?php
    class CsvDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }

        function insert($csv) {
            // Import du fichier CSV sous la forme d'un tablau PHP
            $rows = load_from_csv(ROOT . DS . "files" . DS ."".$csv.".csv", 1);
            // Génération des ordres SQL de réinitialisation de la base (drop/create)
            $sql = file_get_contents(ROOT . DS . "storage" . DS . "__fredi21_structure.sql") . PHP_EOL;
            // Génération de l'ordre SQL "INSERT"
            $sql .= "USE fredi21;" . PHP_EOL;
            if($csv=='motifs') {
                $sql .= "INSERT INTO motif (id_motif, lib_motif) VALUES " . PHP_EOL;
                foreach ($rows as $row) {
                    $sql .= "(";
                    $sql .= $this->pdo->quote( $row[0], PDO::PARAM_STR). ", ";
                    $sql .= $this->pdo->quote( $row[1], PDO::PARAM_STR) ;
                    $sql .= ")," . PHP_EOL;
                }
            }
            else if($csv=='clubs') {
                $sql .= "INSERT INTO club (id_club, lib_club, adr1, adr2, adr3, id_ligue) VALUES " . PHP_EOL;
                foreach ($rows as $row) {
                    $sql .= "(";
                    $sql .= $this->pdo->quote( $row[0], PDO::PARAM_STR). ", ";
                    $sql .= $this->pdo->quote( $row[1], PDO::PARAM_STR). ", ";
                    $sql .= $this->pdo->quote( $row[2], PDO::PARAM_STR). ", ";
                    $sql .= $this->pdo->quote( $row[3], PDO::PARAM_STR). ", ";
                    $sql .= $this->pdo->quote( $row[4], PDO::PARAM_STR). ", ";
                    $sql .= $this->pdo->quote( $row[5], PDO::PARAM_STR) ;
                    $sql .= ")," . PHP_EOL;
                }
            }
            else if($csv=='ligues') {
                $sql .= "INSERT INTO ligue (id_ligue, lib_ligue) VALUES " . PHP_EOL;
                foreach ($rows as $row) {
                $sql .= "(";
                $sql .= $this->pdo->quote( $row[0], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[1], PDO::PARAM_STR) ;
                $sql .= ")," . PHP_EOL;
                }
            }
            else {
                throw new Fredi_Errors("Erreur lors du chargement du CSV", 1);
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