<?php
    class Motif {
        private $id_motif;
        private $lib_motif;

        function __construct(Array $motif){
            $this->fill($motif);        
        }
        // Functions GET
        public function get_id_motif(){
            return $this->id_motif;
        }
        
        public function get_lib_ligue(){
            return $this->lib_motif;
        }

        //Function SET
        public function set_id_motif($id_motif){
            $this->id_motif = $id_motif;
        }

        public function set_lib_motif($lib_motif){
            return $this->lib_motif = $lib_motif;
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