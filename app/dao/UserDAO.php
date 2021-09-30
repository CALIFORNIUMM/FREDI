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
            // Retourne l'objet métier
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
            // Retourne un tableau d'objets "salarié"
            return $user;
        } // function findAll()

        public function newUser(User $user){
            $sql="INSERT INTO utilisateur(pseudo, mdp, mail, nom, prenom, role) VALUES (:pseudo, :mdp, :mail, :nom, :prenom, 1)";
            $request=$this->dbh->prepare($sql);
            $request->execute(array(
                ":pseudo" => $user->get_pseudo(),
                ":mdp" => $user->get_mdp(),
                ":mail" => $user->get_mail(),
                ":nom" => $user->get_nom(),
                ":prenom" => $user->get_prenom(),
            ));
        }
    
        public function isExistPseudo($pseudo){
            $sql="SELECT count(*) as nb FROM utilisateur WHERE pseudo = :pseudo";
            $request=$this->dbh->prepare($sql);
            $request->execute(array(
                ":pseudo" => $pseudo
            ));
            $response = $request->fetch();
            if($response['nb'] == 0){
                return False;
            }else{
                return True;
            };
        }
    
        public function isExistMail($mail){
            $sql="SELECT count(*) as nb FROM utilisateur WHERE mail = :mail";
            $request=$this->dbh->prepare($sql);
            $request->execute(array(
                ":mail" => $mail
            ));
            $response = $request->fetch();
            if($response['nb'] == 0){
                return False;
            }else{
                return True;
            };
        }
    
        function connexionUser($pseudo){
            $sql="SELECT id_utilisateur, mdp FROM utilisateur WHERE pseudo = :pseudo";
            $request=$this->dbh->prepare($sql);
            $request->execute(array(
                ":pseudo" => $pseudo
            ));
            $response = $request->fetch();
            return $response;
        }



    }
?>