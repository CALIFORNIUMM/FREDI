<?php
    class CsvDAO extends dao {
        public $csv;
        public function __construct(Csv $csv)
        {
            parent::__construct();
            $this->csv = $csv;
        }

        public function motif(){
            $sql = $this->csv->get_sql();
            $sql .= "INSERT INTO motif (id_motif, lib_motif) VALUES " . PHP_EOL;
            foreach ($this->csv->get_rows() as $row) {
                $sql .= "(";
                $sql .= $row[0] . ", ";
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
            return $sth->rowCount();
        }

        public function ligue(){
            $sql = $this->csv->get_sql();
            $sql .= "INSERT INTO ligue (id_ligue, lib_ligue) VALUES " . PHP_EOL;
            foreach ($this->csv->get_rows() as $row) {
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
            return $sth->rowCount();
        }

        public function club(){
            $sql = $this->csv->get_sql();
            $sql .= "INSERT INTO club (id_club, lib_club, adr1, adr2, adr3, id_ligue) VALUES " . PHP_EOL;
            foreach ($this->csv->get_rows() as $row) {
                $sql .= "(";
                $sql .= $this->pdo->quote( $row[0], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[1], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[2], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[3], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[4], PDO::PARAM_STR). ", ";
                $sql .= $this->pdo->quote( $row[5], PDO::PARAM_STR) ;
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
            return $sth->rowCount();
        }
    } // function find()
?>