<?php
    class Ligue {
        private $id_ligue;
        private $lib_ligue;

        function __construct(Array $club){
            $this->fill($club);        
        }
        // Functions GET
        public function get_id_adherent(){
            return $this->id_club;
        }
        
        public function get_lib_club(){
            return $this->lib_club;
        }

        //Function SET
        public function set_id_club($id_club){
            $this->id_club = $id_club;
        }

        public function set_lib_club($lib_club){
            return $this->lib_club = $lib_club;
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