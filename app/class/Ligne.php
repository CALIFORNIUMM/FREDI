<?php
    class Ligne {
        private $id_ligne;
        private $dat_ligne;
        private $lib_trajet;
        private $nb_km;
        private $mt_km;
        private $mt_peage;
        private $mt_repas;
        private $mt_hebergement;
        private $mt_total;
        private $id_motif;
        private $id_note;

        function __construct(Array $ligne){
            $this->fill($ligne);        
        }
        // Functions GET
        public function get_id_ligne(){
            return $this->id_ligne;
        }
        
        public function get_dat_ligne(){
            return $this->dat_ligne;
        }

        public function lib_trajet(){
            return $this->lib_trajet;
        }

        public function get_nb_km(){
            return $this->nb_km;
        }

        public function get_mt_km(){
            return $this->mt_km;
        }
        
        public function get_mt_peage(){
            return $this->mt_peage;
        }

        public function get_mt_repas(){
            return $this->mt_repas;
        }

        public function get_mt_hebergement(){
            return $this->mt_hebergement;
        }

        public function get_mt_total(){
            return $this->mt_total;
        }

        public function get_id_motif(){
            return $this->id_motif;
        }

        public function get_id_note(){
            return $this->id_note;
        }

        //Function SET
        public function set_id_ligne($id_ligne){
            $this->id_ligne = $id_ligne;
        }

        public function set_dat_ligne($dat_ligne){
            return $this->dat_ligne = $dat_ligne;
        }

        public function set_lib_trajet($lib_trajet){
            return $this->lib_trajet = $lib_trajet;
        }

        public function set_nb_km($nb_km){
            return $this->nb_km = $nb_km;
        }

        public function set_mt_km($mt_km){
            return $this->mt_km = $mt_km;
        }
        
        public function set_mt_peage($mt_peage){
            return $this->mt_peage = $mt_peage;
        }

        public function set_mt_repas($mt_repas){
            return $this->mt_repas = $mt_repas;
        }

        public function set_mt_hebergement($mt_hebergement){
            return $this->mt_hebergement = $mt_hebergement;
        }

        public function set_mt_total($mt_total){
            return $this->mt_total = $mt_total;
        }

        public function set_id_motif($id_motif){
            return $this->id_motif = $id_motif;
        }

        public function set_id_note($id_note){
            return $this->id_note = $id_note;
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