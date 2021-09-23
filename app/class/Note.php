<?php
    class Club {
        private $id_note;
        private $est_valide;
        private $mt_total;
        private $dat_remise;
        private $nr_ordre;
        private $id_periode;
        private $id_utilisateur;

        function __construct(Array $note){
            $this->fill($note);        
        }
        // Functions GET
        public function get_id_note(){
            return $this->id_note;
        }
        
        public function get_est_valide(){
            return $this->est_valide;
        }

        public function get_mt_total(){
            return $this->mt_total;
        }

        public function get_dat_remise(){
            return $this->dat_remise;
        }

        public function get_nr_ordre(){
            return $this->nr_ordre;
        }
        
        public function get_id_periode(){
            return $this->id_periode;
        }
        
        public function get_id_utilisateur(){
            return $this->id_utilisateur;
        }

        //Function SET
        public function set_id_note($id_note){
            $this->id_note = $id_note;
        }

        public function set_est_valide($est_valide){
            return $this->est_valide = $est_valide;
        }

        public function set_mt_total($mt_total){
            return $this->mt_total = $mt_total;
        }

        public function set_dat_remise($dat_remise){
            return $this->dat_remise = $dat_remise;
        }

        public function set_nr_ordre($nr_ordre){
            return $this->nr_ordre = $nr_ordre;
        }
        
        public function set_id_periode($id_periode){
            return $this->id_periode = $id_periode;
        }
        
        public function set_id_utilisateur($id_utilisateur){
            return $this->id_utilisateur = $id_utilisateur;
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