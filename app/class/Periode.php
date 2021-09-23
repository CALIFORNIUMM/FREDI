<?php
    class Periode {
        private $id_periode;
        private $lib_periode;
        private $est_active;
        private $mt_km;

        function __construct(Array $periode){
            $this->fill($periode);        
        }
        // Functions GET
        public function get_id_periode(){
            return $this->id_periode;
        }
        
        public function get_lib_periode(){
            return $this->lib_periode;
        }

        public function get_est_active(){
            return $this->est_active;
        }

        public function get_mt_km(){
            return $this->mt_km;
        }

        //Function SET
        public function set_id_periode($id_periode){
            $this->id_periode = $id_periode;
        }

        public function set_lib_periode($lib_periode){
            return $this->lib_periode = $lib_periode;
        }

        public function set_est_active($est_active){
            return $this->est_active = $est_active;
        }

        public function set_mt_km($mt_km){
            return $this->mt_km = $mt_km;
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