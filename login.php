<?php
$auth=0 ;
 include 'lib/includes.php';
/**
 * Traitement du formulaire
 */

    // si le champ username et mot de passe est remplie on va à la base de données
    if (isset ($_POST['username']) && $_POST['password']) {

        $username= $db->quote($_POST['username']) ;
        $password = sha1($_POST['password']);
        //$sql = "SELECT * FROM users WHERE username=$username AND password = $password";
        $select = $db->query("SELECT * FROM users WHERE username=$username AND password = '$password'");

        // vérifier si l'utilisateur existe dans la base de données
        if ($select->rowCount() > 0){
            // on enregistre la ligne de la base de donnée dans le tableau $_SESSION
            $_SESSION['Auth'] = $select->fetch();
            // affiche le message de l'authetification
            setFlash('vous etes maintenant connecté ! ');
            //on redirige l'admin vers la page admin/index.php
            header ('Location:'.WEBROOT.'admin/index.php');
            die();
        };
    }

/**
 * L'inclusion du header
 */
include 'partials/header.php';
?>
<form action="#" method="post">
    <div class="form-group">
        <label for="username" > Nom d'utilisateur </label>
        <?php echo input('username') ?>
    </div>
    <div class="form-group">
        <label for = password> Password </label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-default"> Se connecter</button>
</form>


<?php include ('partials/footer.php');?>
<?php include ('lib/debug.php');?>

