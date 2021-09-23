<?php
    class Adherent {
        private $id_adherent;
        private $nr_licence;
        private $adr1;
        private $adr2;
        private $adr3;
        private $id_utilisateur;
        private $id_club;

        function __construct(Array $adherent){
            $this->fill($adherent);        
        }
        // Functions GET
        public function get_id_adherent(){
            return $this->id_adherent;
        }
        
        public function get_nr_licence(){
            return $this->nr_licence;
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
        
        public function get_id_utilisateur(){
            return $this->id_utilisateur;
        }

        public function get_id_club(){
            return $this->id_club;
        }

        //Function SET
        public function set_id_adherent($id_adherent){
            $this->id_adherent = $id_adherent;
        }

        public function set_nr_licence($nr_licence){
            return $this->nr_licence = $nr_licence;
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
        
        public function set_id_utilisateur($id_utilisateur){
            return $this->id_utilisateur = $id_utilisateur;
        }

        public function set_id_club($id_club){
            return $this->id_club = $id_club;
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