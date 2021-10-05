<?php
    class Messages {
        private $messages = array();
        private $type;

        public function __construct($type){
            $this->type = $type;
        }

        public function get_messages(){
            return $this->messages;
        }

        public function set_messages($messages){
            $this->messages = $messages;
        }

        public function add_messages($message){
            $this->messages[] = $message;
        }

        public function remove_messages(){
            $this->messages = array();
        }

        public function is_empty(){
            if(empty($this->messages)){
                return TRUE;
            }
            return FALSE;
        }

        public function afficher(){
            if (count($this->messages) > 0) {
                echo "<ul>";
                foreach ($this->messages as $message) {
                    echo "<li class=\"".$this->type."\" >" . $message . "</li>";
                }
                echo "</ul>";
            }
        }
    }
?>