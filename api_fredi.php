<?php
//use :

include 'app/sql.php';


//phase de test pour savoir ce que l'on recois 
$insert_get = isset($_GET['insert_get']) ? $_GET['insert_get'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';





$result = array('status' => 0, 'msg' => _('Une erreur est survenue.'));

// utiliser pour la cron tab et lancer inactive à la main


if ($action != '') {

    switch ($action) {

        case 'login': /* detecte la connexion */

            $result = array('status' => 0, 'msg' => _('session')); /* Statut 0 = session lancer */
            // $insert_get = isset($_GET['login']) ? $_GET['login'] : '';
            $pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
            $password = isset($_GET['password']) ? $_GET['password'] : '';
            $insert_get = urldecode($insert_get); /* recupere les valeurs pseudo et password */


            //   $pseudo = 'd.dutertre';
            //   $password = 'Azertyuiop1234.';
            //On rentre la requête sql dans une variable
            //Lecture du pseudo dans la BDD 
            try {
                $sql = "SELECT * FROM utilisateur WHERE pseudo=:pseudo";
                $sth = $dbh->prepare($sql);
                $sth->execute(array(
                    ':pseudo' => $pseudo
                ));
                $user = $sth->fetch(PDO::FETCH_ASSOC);
            } //Gestion des erreurs
            catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            if ($user == '') {
                $result = array('status' => 2, 'msg' => _('mauvais pseudo'));
                break;
            }

            $result['user'] = $user;

            //Si pseudo et mdp correct alors connecté password_verify compare le mdp saisi avec le mdp crypté dans la BDD
            //    if ($pseudo == $user['pseudo'] && password_verify($password, $user['mdp'])) {
            //détruit la variable mdp
            if (password_verify($password, $result['user']['mdp'])) {
                try {
                    $sth = $dbh->prepare('select id_utilisateur from utilisateur where pseudo=:pseudo ');
                    $sth->execute(array(":pseudo" => $pseudo));
                    $id_utilisateur = $sth->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                }
                //   print_r($id_utilisateur);
                $result['id_utilisateur'] = $id_utilisateur;


                try {
                    $sth = $dbh->prepare('select id_note ,id_periode from note where id_utilisateur =:id_utilisateur');
                    $sth->execute(array(":id_utilisateur" =>  $result['id_utilisateur'][0]['id_utilisateur']));
                    $id_note = $sth->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                }
                $i = 0;
                
                try {
                    $sth = $dbh->prepare('select * from ligne where id_note=:id_note');
                    $sth->execute(array(":id_note" =>  $id_note[0]['id_note']));
                    $id_ligne = $sth->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                }
                $lignes = count($id_ligne);
                //  print_r($id_note);
                
                foreach ($id_ligne as $ligne) {


                    //     print_r($notes);





                    try {
                        $sth = $dbh->prepare('select * from periode where id_periode =:id_periode ');
                        $sth->execute(array(":id_periode" =>  $id_note[0]['id_periode']));
                        $periode = $sth->fetch(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                    }

                    //  print_r($ligne);

                    try {
                        $sth = $dbh->prepare('select lib_motif from motif where id_motif =:id_motif ');
                        $sth->execute(array(":id_motif" => $ligne['id_motif']));
                        $motif = $sth->fetch(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
                    }
                    $periode['lib_periode'];


                    $result['periode'] = $periode;
                    $result['ligne'][$i] = $ligne;
                    $result['ligne'][$i] += $result['periode'];
                    $result['ligne'][$i] += $motif;
                    $i++;
                }
            } else {
                $result = array('status' => 2, 'msg' => _('mauvais mot de passe'));
                break;
            }
            //    print_r($id_note);



            //   } else { // Message d'erreur lorsque les identifiants sont incorrects
            //           $_SESSION['messages'] = array("Account" => ["red", "Ces identifiants sont incorrects"]);
            //   header("Location: connexion.php");
            //      }

            /*
*/
            break;

        default:
            break;
    }
}
echo json_encode($result);