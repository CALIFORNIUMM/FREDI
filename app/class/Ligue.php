<?php
    class Ligue {
        private $id_ligue;
        private $lib_ligue;

        function __construct(Array $ligue){
            $this->fill($ligue);        
        }
        // Functions GET
        public function get_id_ligue(){
            return $this->id_ligue;
        }
        
        public function get_lib_ligue(){
            return $this->lib_ligue;
        }

        //Function SET
        public function set_id_ligue($id_ligue){
            $this->id_ligue = $id_ligue;
        }

        public function set_lib_ligue($lib_ligue){
            return $this->lib_ligue = $lib_ligue;
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