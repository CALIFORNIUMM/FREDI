<?php
    class User {
        private $id_utilisateur;
        private $pseudo;
        private $mdp;
        private $mail;
        private $nom;
        private $prenom;
        private $role;

        function __construct(Array $user=NULL){
            if($user != NULL){
                $this->fill($user); 
            }
        }
        // Functions GET
        public function get_id_utilisateur(){
            return $this->id_utilisateur;
        }
        
        public function get_pseudo(){
            return $this->pseudo;
        }

        public function get_mdp(){
            return $this->mdp;
        }

        public function get_mail(){
            return $this->mail;
        }

        public function get_nom(){
            return $this->nom;
        }
        
        public function get_prenom(){
            return $this->prenom;
        }

        public function get_role(){
            return $this->role;
        }

        //Function SET
        public function set_id_utilisateur($id_utilisateur){
            $this->id_utilisateur = $id_utilisateur;
        }

        public function set_pseudo($pseudo){
            return $this->pseudo = $pseudo;
        }

        public function set_mdp($mdp){
            return $this->mdp = $mdp;
        }

        public function set_mail($mail){
            return $this->mail = $mail;
        }

        public function set_nom($nom){
            return $this->nom = $nom;
        }
        
        public function set_prenom($prenom){
            return $this->prenom = $prenom;
        }

        public function set_role($role){
            return $this->role = $role;
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