<?php
    class UserDAO extends dao 
    {
        function __construct()
        {
            parent::__construct();
        }
        function find($id_utilisateur) {
            $sql = "SELECT * FROM utilisateur WHERE id_utilisateur= :id_utilisateur";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(":id_utilisateur" => $id_utilisateur));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $user=null;
            if($row) {
                
                $user = new User($row);
            }
            // Retourne l'objet
            return $user;
        } // function find()

        function findAll() {
            $sql = "SELECT * FROM utilisateur";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $user = array();
            foreach ($rows as $row) {
                $user[] = new User($row);
            }
            // Retourne un tableau d'objets
            return $user;
        } // function findAll()

        public function newUser(User $user){
            $sql = "INSERT INTO utilisateur(pseudo, mdp, mail, nom, prenom, role) VALUES (:pseudo, :mdp, :mail, :nom, :prenom, :role)";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ":pseudo" => $user->get_pseudo(),
                    ":mdp" => $user->get_mdp(),
                    ":mail" => $user->get_mail(),
                    ":nom" => $user->get_nom(),
                    ":prenom" => $user->get_prenom(),
                    ":role" => $user->get_role()
                ));
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
        }
    
        public function isExistPseudo($pseudo){
            $sql = "SELECT count(*) as nb FROM utilisateur WHERE pseudo = :pseudo";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ":pseudo" => $pseudo
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $nb=null;
            if($row) {
                if($row['nb'] == 0){
                    $nb = FALSE;
                }else{
                    $nb = TRUE;
                }
            }
            // Retourne un tableau d'objets
            return $nb;
        }
    
        public function isExistMail($mail){
            $sql = "SELECT count(*) as nb FROM utilisateur WHERE mail = :mail";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ":mail" => $mail
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $nb=null;
            if($row) {
                if($row['nb'] == 0){
                    $nb = FALSE;
                }else{
                    $nb = TRUE;
                }
            }
            // Retourne un tableau d'objets
            return $nb;
        }
    
        function connexionUser($pseudo){
            $sql = "SELECT id_utilisateur, mdp FROM utilisateur WHERE pseudo = :pseudo";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ":pseudo" => $pseudo
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            $infos=null;
            if($row) {
                $infos = $row;
            }
            // Retourne un tableau d'objets
            return $infos;
        }

    }
?>