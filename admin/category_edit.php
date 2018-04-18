    <?php
    include '../lib/includes.php';

    // si tous les champs sont remplit on ajouter à la base de donneés ou on modifier
    if (isset($_POST['name']) && $_POST['slug']){
        //chekCsrf();
        $slug = $_POST['slug'];
        if(preg_match('/^[a-z\-0-9]+$/', $slug)){
            $name = $db->quote($_POST['name']);
            $slug = $db->quote($_POST['slug']);
            // l'enrigestrement dans la base de données
            if (isset($_GET['id'])){
                //modifier
                $id = $id = $db->quote($_GET['id']);
                $db->query("UPDATE categories SET name = $name, slug=$slug WHERE id = $id");
            }else{
                //enregistrer
                $db->query("INSERT INTO categories SET name = $name, slug=$slug");
            }
            setFlash('la categorie a bien été ajouter ');
            header('Location:category.php');
            die();
        }else {
            setFlash("le slug n'est pas valide ", "erreur");
        }

    }
    // afficher une catégorie par un ID
    if (isset($_GET['id'])){
        $id = $db->quote($_GET['id']);
        $select = $db->query("SELECT * FROM categories WHERE id=$id");
        if ($select->rowCount()==0){
            setFlash(" il n'y a pas de catégorie avec cet ID !", "danger");
            header('Location:category.php');
            die();
        }
        $_POST = $select->fetch();
    }

    include '../partials/admin_header.php';
    ?>

        <h1> Editer une catégorie </h1>

        <form action="#" method="post">
            <div class="form-group">
                <label for="name" > Nom de la catégorie</label>
                <?php echo input('name') ?>
            </div>
            <div class="form-group">
                <label for="slug" > URL de la catégorie </label>
                <?php echo input('slug') ?>
            </div>
            <button type="submit" class="btn btn-default"> Enregistrer </button>
        </form>

    <?php include '../partials/footer.php'; ?>

