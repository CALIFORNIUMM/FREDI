<?php
    class Csv{
        private $rows;
        private $sql;

        public function __construct($csv)
        {
            // Import du fichier CSV sous la forme d'un tablau PHP
            $this->rows = load_from_csv(ROOT . DS . "files" . DS ."".$csv."s.csv", 1);
            // Génération de l'ordre SQL "INSERT"
            $this->sql = "USE fredi21;" . PHP_EOL;
            $this->sql .= file_get_contents(ROOT . DS . "storage" . DS . "sql" . DS . $csv . ".sql") . PHP_EOL;
            
        }

        public function get_rows(){
            return $this->rows;
        }

        public function get_sql(){
            return $this->sql;
        }
    }
?>