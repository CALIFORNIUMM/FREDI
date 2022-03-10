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

// Verification de l'email fourni et du mot de passe 
if (!isset($_GET['mail']) || !isset($_GET['mdp'])) {
    $json = array(
        "message" => "KO : erreur mail et/ou mot de passe"
    );
    envoi_json($json);
} elseif (isset($_GET['mail']) && isset($_GET['mdp'])) {

    $DAO = new DAO();

    $mail = $_GET['mail'];
    $mdp = $_GET['mdp'];

    //Verification de l'email
    $user_exist = new UserDAO();
    $user_exist = $user_exist->isExistMail($mail);

    //verification si mail existant / message erreur si l'utilisateur est inconnu
    If ($user_exist == FALSE) {
        $erreur = array("message" => "KO : erreur utilisateur inconnu");
        envoi_json($erreur);
    } else {
        $verif_mdp = new JsonDAO();
        $verif = $verif_mdp->verif_mdp($mail);
        
        //verification du hashashage 
        $mdp_resultat = ($mdp == $verif['mdp']);
        // message d'erreur si le mdp est faux 
        if ($mdp_resultat == false) {
            $erreur = array("message" => "KO : erreur utilisateur inconnu");
            envoi_json($erreur);
        } else {

            //utilisateur ---------------------------------------
            $get_user = new JsonDAO();
            $get_user = $get_user->get_user_mail($mail);

            //periode ---------------------------------
            $periodeDAO = new PeriodeDAO();
            $periode = $periodeDAO->findLibEnCours();

            //lignes ---------------------------------------
            $ligneDAO = new LigneDAO();
            $lignes = $ligneDAO->findAllByIdUser($get_user->get_id_utilisateur(), $periode->get_id_periode());

            //  
            if (count($lignes) == 0) {
                $json = array(
                    "message" => "KO : pas de note"
                );
                envoi_json($json);
            } else {
                $tableau_util = array(
                    'email' => $get_user->get_mail(),
                    'nom' => $get_user->get_nom(),
                    'prenom' => $get_user->get_prenom(),
                    'role' => $get_user->get_role()
                );
                
                if($periode->get_est_active() == 1){
                    $statut = "active";
                }else{
                    $statut = "inactive";
                }
                $tableau_periode = array(
                    'annee/libelle' => $periode->get_lib_periode(),
                    'montant_km' => $periode->get_mt_km(),
                    'statut' => $statut
                );



                $tableau_lignes = array();
                $motifDAO = new MotifDAO();
                foreach ($lignes as $ligne) {
                    $ligne_array = array(
                        "id" => $ligne->get_id_ligne(),
                        "date" => $ligne->get_dat_ligne(),
                        "libelle" => $ligne->get_lib_trajet(),
                        "cout_peage" => $ligne->get_mt_peage(),
                        "cout_repas" => $ligne->get_mt_repas(),
                        "cout_hebergement" => $ligne->get_mt_hebergement(),
                        "nb_km" => $ligne->get_nb_km(),
                        "cout_km" => $ligne->get_mt_km(),
                        "total_ligne" => $ligne->get_mt_total(),
                        "motif" => $motifDAO->find($ligne->get_id_motif())->get_lib_motif()
                    );
                    $tableau_lignes[] = $ligne_array;
                }
              // on regroupe les tableaux pour faire un json final     
                $json_final = array(
                    "message" => "Message « OK : note générée »",
                    "utilisateur" => $tableau_util,
                    "periode" => $tableau_periode,
                    "lignes" => $tableau_lignes
                );

                envoi_json($json_final);
            }
        }
    }
}
