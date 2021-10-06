<?php
    class Club {
        private $id_club;
        private $lib_club;
        private $adr1;
        private $adr2;
        private $adr3;
        private $id_ligue;

        function __construct(Array $club){
            $this->fill($club);        
        }
        // Functions GET
        public function get_id_club(){
            return $this->id_club;
        }
        
        public function get_lib_club(){
            return $this->lib_club;
        }

        public function get_adr1(){
            return $this->adr1;
        }

        public function get_adr2(){
            return $this->adr2;
        }

        public function get_adr3(){
            return $this->adr3;
        }
        
        public function get_id_ligue(){
            return $this->id_ligue;
        }

        //Function SET
        public function set_id_club($id_club){
            $this->id_club = $id_club;
        }

        public function set_lib_club($lib_club){
            return $this->lib_club = $lib_club;
        }

        public function set_adr1($adr1){
            return $this->adr1 = $adr1;
        }

        public function set_adr2($adr2){
            return $this->adr2 = $adr2;
        }

        public function set_adr3($adr3){
            return $this->adr3 = $adr3;
        }
        
        public function set_id_ligue($id_ligue){
            return $this->id_ligue = $id_ligue;
        }

        //Function de fill sur les setter
        public function fill(array $tableau){
            foreach($tableau as $key => $valeur){
                $methode = 'set_'.$key;
                if(method_exists($this, $methode)){
                    $this->$methode($valeur);
                }
            }
        }
    }