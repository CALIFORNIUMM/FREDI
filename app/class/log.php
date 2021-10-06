<?php
    class Log{
        private $date;
        private $message;
        private $filename;

        public function __construct(){
            $this->date = new DateTime('now',new DateTimeZone('Europe/Paris')); // Récupère la date de notre fuseau horaire
            $this->date = $this->date->format("Y-m-d H:i:s.u");
            $this->filename = ROOT . DIRECTORY_SEPARATOR . '/logs/log.txt';
        }


        function logConnexion($page, $pseudo, $password){
            $this->message = $this->date . ";" . $this->get_ip() . ";" . $page . ";" . $pseudo . ";" . $password . ";" .PHP_EOL;
            file_put_contents($this->filename, $this->message, FILE_APPEND);
        }

        function get_ip()
        {
            $ip = $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER["HTTP_CF_CONNECTING_IP"]
            ?? $_SERVER['HTTP_X_FORWARDED']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_FORWARDED']
            ?? $_SERVER['HTTP_FORWARDED_FOR']
            ?? $_SERVER['REMOTE_ADDR']
            ?? '0.0.0.0';
            return $ip;
        }

        function set_filename($filename){
            $this->filename = ROOT . DIRECTORY_SEPARATOR . '/logs/' . $filename;
        }

        function sendMail($subject, $message, $pseudo, $mail, $password){
            $this->message = "Date : " .$this->date . PHP_EOL . "To : " . $mail . PHP_EOL . "Subject : " . $subject . PHP_EOL . "Message : " . $message . PHP_EOL . "Pseudo : " . $pseudo . PHP_EOL . "Mot de passe : " . $password . PHP_EOL;
            file_put_contents($this->filename, $this->message, FILE_APPEND);
        }
    }
?>