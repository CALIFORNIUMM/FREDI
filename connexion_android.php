<?php
    /**
     * Note de frais de la période active en JSON
     */
    require_once "init.php";
    function envoi_json($erreur) {
        $json = json_encode($erreur, JSON_PRETTY_PRINT);
        header("Content-type: application/json; charset=utf-8");
        echo $json;
    }
    //initialisation des variables
    $user = isset($_GET['user']) ? $_GET['user'] : NULL;
    $password = isset($_GET['password']) ? $_GET['password'] : NULL;
    $message=[];
    //création du json 
    $result = array('status' => 0, 'msg' => _('Une erreur est survenue.'));

    //DAO user
    $userDAO = new UserDAO();

    //mesasges d'erreurs
    if(empty($user) && empty($password)){
        
    }
    if(empty(trim($user))){
        $message[]=array("username"=>"username vide");
    }

    if(empty(trim($password))){
        $message[]=array("password"=>"mot de passe vide");
    }

    if($userDAO->isExistPseudo($user) == FALSE){
        $message[]=array("usernameExist"=>"l'utilisateur n'existe pas");
    }else{
        $utilisateur = $userDAO->connexionUser($user);
        if(!password_verify($password, $utilisateur['mdp'])){
            $message[]=array("signin"=>"identifiant incorrect");
        }
    }

    if(empty($message)){
        $result = array('status' => 0, 'msg' => _('session'));
        $utilisateur = $userDAO->find($utilisateur['id_utilisateur']);
        $noteDAO = new noteDAO();
        $note = $noteDAO->findByUser($utilisateur->get_id_utilisateur());
        $motifDAO = new motifDAO();

        $periodeDAO = new PeriodeDAO();
        $periode = $periodeDAO->findLibEnCours();

        $user_info=array(
            "id_utilisateur" => $utilisateur->get_id_utilisateur(),
            "pseudo" => $utilisateur->get_pseudo() ,
            "mdp" => $utilisateur->get_mdp() ,
            "mail" => $utilisateur->get_mail() ,
            "nom" => $utilisateur->get_nom() ,
            "prenom" => $utilisateur->get_prenom() ,
            "role" => $utilisateur->get_role()
        );
        $result['user'] = $user_info;
        
        $id_utilisateur=array(
            "id_utilisateur" => $utilisateur->get_id_utilisateur()
        );
        $result['id_utilisateur'] = array($id_utilisateur);
        
        $result['id_note'] = $note->get_id_note();

        $periode_info=array(
            "id_periode" => $periode->get_id_periode(),
            "lib_periode" => $periode->get_lib_periode() ,
            "est_active" => $periode->get_est_active() ,
            "mt_km" => $periode->get_mt_km()
        );

        $result['periode'] = $periode_info;
        
        $lignes_info=array();
        
        foreach($note->get_lignes() as $ligne){
            $lignes_info[]=array(
                "id" => $ligne->get_id_ligne(),
                "dat_ligne" => $ligne->get_dat_ligne() ,
                "lib_trajet" => $ligne->get_lib_trajet() ,
                "nb_km" => $ligne->get_nb_km(),
                "mt_km" => $ligne->get_mt_km(),
                "mt_peage" => $ligne->get_mt_peage(),
                "mt_repas" => $ligne->get_mt_repas(),
                "mt_hebergement" => $ligne->get_mt_hebergement(),
                "mt_total" => $ligne->get_mt_total(),
                "id_motif" => $ligne->get_id_ligne(),
                "id_note" => $note->get_id_note(),
                "id_periode" => $periode->get_id_periode(),
                "lib_periode" => $periode->get_lib_periode(),
                "est_active" => $periode->get_est_active(),
                "lib_motif" => utf8_encode($motifDAO->find($ligne->get_id_motif())->get_lib_motif()),
                
            );
        }
        $result['ligne'] = $lignes_info;

        echo envoi_json($result);
    }else{
        echo envoi_json($result);
    }

?>