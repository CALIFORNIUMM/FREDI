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
    $connexion = "SELECT count(*) FROM utilisateur WHERE mail = '" . $mail . "';";
    $temp_req = $DAO->pdo->prepare($connexion);
    $temp_req = $DAO->execute();
    $connexion1 = $temp_req->fetch(PDO::FETCH_ASSOC);

    //verification si mail existant / message erreur si l'utilisateur est inconnu
    If ($connexion1[0] == 0) {
        $erreur = array("message" => "KO : erreur utilisateur inconnu");
        envoi_json($erreur);
    } else {

        
        $connexion2 = "SELECT mail, mdp FROM utilisateur WHERE mail = '" . $mail . "';"; //Recuperation de l'utilisateur
        $temp_req = $DAO->pdo->prepare($connexion2);
        $temp_req = $DAO->execute();
        $resultat_connexion_2 = $temp_req->fetch();

        //verification du hashashage 
        $mdp_resultat = password_verify($mdp, $resultat_connexion_2[1]);

        // message d'erreur si le mdp est faux 
        if ($mdp_resultat == false) {
            $erreur = array("message" => "KO : erreur utilisateur inconnu");
            envoi_json($erreur);
        } else {

            //utilisateur ---------------------------------------
            $req_1 = "SELECT mail, nom, prenom, role FROM utilisateur WHERE mail = '" . $mail . "';";
            $temp_req = $DAO->pdo->prepare($req_1);
            $temp_req = $DAO->execute();
            $info_util = $temp_req->fetch();

            $tableau_util = array(
                "mail" => $info_util[0],
                "nom" => $info_util[1],
                "prenom" => $info_util[2],
                "role" => $info_util[3]
            );

            //periode ---------------------------------
            $req_1 = "SELECT lib_periode, mt_km FROM periode WHERE est_active = 1";
            $temp_req = $DAO->pdo->prepare($req_1);
            $temp_req = $DAO->execute();
            $info_periode = $temp_req->fetch();

            $tableau_periode = array(
                "annee" => $info_periode[0],
                "montant" => $info_periode[1],
                "statut" => "activé"
            );

            //lignes ---------------------------------------
            $req_1 = "SELECT id_ligne, dat_ligne, lib_trajet, nb_km, mt_km, mt_peage, mt_repas, mt_hebergement, mt_total, lib_motif 
            FROM ligne, motif 
            WHERE mail = '" . $mail . "' 
            AND lib_periode = '" . $info_periode[0] . "' 
            AND ligne.id_motif = motif.id_motif";

            $temp_req = $DAO->pdo->prepare($req_1);
            $temp_req = $DAO->execute($req_1);
            $info_lignes = $temp_req->fetchAll();

            //  
            if (count($info_lignes) == 0) {
                $json = array(
                    "message" => "KO : pas de note"
                );
                envoi_json($json);
            } else {
                $tableau_lignes = array();
                foreach ($info_lignes as $ligne) {
                    $ligne_array = array(
                        "id" => $ligne[0],
                        "date" => $ligne[1],
                        "libelle" => $ligne[2],
                        "cout_peage" => $ligne[3],
                        "cout_repas" => $ligne[4],
                        "cout_hebergement" => $ligne[5],
                        "nb_km" => $ligne[6],
                        "cout_km" => $ligne[7],
                        "total_ligne" => $ligne[8],
                        "motif" => $ligne[9]
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
