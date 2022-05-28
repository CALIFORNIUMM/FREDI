<?php
    $title = "Admin Edit rôle";
    include('header.php');
    
    //Charger un utilisateur
    $id_utilisateur = isset($_GET['id']) ? $_GET['id'] : NULL;
    $role = isset($_POST['role']) ? $_POST['role'] : NULL;
    $messages = New Messages("error");
    $roles = array(
        '0' => 'Adhérent',
        '1' => 'Contrôleur',
        '2' => 'Administrateur'
    );
    if($id_utilisateur == NULL){
        $messages->add_messages("L'id de l'utilisateur est null");
    }
    
    $userDAO = new UserDAO();
    if($userDAO->isExistId($id_utilisateur) == FALSE){
        $messages->add_messages("L'id de l'utilisateur n'existe pas");
    }

    if($messages->is_empty() == TRUE){
        $user = new UserDAO();
        $user = $user->find($id_utilisateur);
        if(isset($role)){
            $userDAO = new UserDAO();
            $userDAO = $userDAO->updateRole($id_utilisateur, $role);
            header('Location: utilisateur_liste.php');
        }
    }

?>
    <h1>Admin</h1>
    <?php
    if($messages->is_empty() == TRUE){
        echo "<h2>Modifier le rôle de : ".$user->get_nom()." ".$user->get_prenom()."</h2>";
    }?>
    
    <ul>
        <li><a href="admin.php">Charger</a> les tables</li>
        <li><a href="utilisateur_liste.php">Liste</a> des utilisateurs</li>
    </ul>

    <?php 
    if($messages->is_empty() == FALSE){
        $messages->afficher();
    }else{?>
    <form action="" method="POST">
        <label for="role">Role de l'utilisateur</label><br>
        <select name="role" id="role">
        <?php
            foreach($roles as $key => $role){
                $selected = "";
                if($user->get_role() == $key){
                    $selected = "selected";
                }
                echo "<option value=\"".$key."\" ".$selected.">".$role."</option>";
            }
        ?>
        </select><br><br>
        <input type="submit" value="Modifier" name="submit">

    </form>
    <?php } ?>
<?php include('footer.php'); ?>
