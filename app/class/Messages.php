<?php
    class Messages {
        public $messages = array();
        public $type;

        public function __construct(){
            if($_SESSION['messages'] != NULL){
                $this->fill($_SESSION['messages']);
            }
            return $this;
        }

        public function get_messages(){
            return $this->messages;
        }

        public function set_messages($messages){
            $this->messages = $messages;
            return $this;
        }

        public function get_type(){
            return $this->type;
        }

        public function set_type($type){
            $this->type = $type;
            return $this;
        }

        public function add_messages($message){
            $this->messages[] = $message;
            return $this;
        }

        public function remove_messages(){
            $this->messages = array();
            return $this;
        }

        public function is_empty(){
            if(empty($this->messages)){
                return TRUE;
            }
            return FALSE;
        }

        public function put(){
            $_SESSION['messages'] = $this;
        }

        public function kill(){
            $_SESSION['messages'] = NULL;
        }

        public function afficher(){
            if (count($this->messages) > 0) {
                echo "<ul>";
                foreach ($this->messages as $message) {
                    echo "<li class=\"".$this->type."\" >" . $message . "</li>";
                }
                echo "</ul>";
            }
            return $this;
        }

        //Function de fill sur les setter
        public function fill(Messages $tableau){
            foreach($tableau as $key => $valeur){
                $methode = 'set_'.$key;
                if(method_exists($this, $methode)){
                    $this->$methode($valeur);
                }
            }
        }
    }
?>