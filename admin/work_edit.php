    <?php
    include '../lib/includes.php';
    // si les champs id et name sont rempli on enregistre ou on modifier les données de la BD
    if (isset($_POST['name']) && $_POST['slug']){
        //chekCsrf();
        $slug = $_POST['slug'];
        if(preg_match('/^[a-z\-0-9]+$/', $slug)){
            $name = $db->quote($_POST['name']);
            $slug = $db->quote($_POST['slug']);
            $category_id = $db->quote($_POST['category_id']);
            $content = $db->quote($_POST['content']);

            //var_dump($content);
           // echo 'blabla';

            // l'enrigestrement dans la base de données
            if (isset($_GET['id'])){
                //modifier
                $id = $id = $db->quote($_GET['id']);
                $db->query("UPDATE works SET name = $name, slug = $slug, content = $content, category_id = $category_id WHERE id = $id");
            }else{
                //enregistrer
                $db->query("INSERT INTO works SET name = $name, slug=$slug, content = $content, category_id = $category_id ");
            }
            //setFlash('la réalisation a bien été ajouter ');
            header('Location: work.php');
            die();
        }else {
            setFlash("le slug n'est pas valide ", "erreur");
        }
    }

    if (isset($_GET['id'])){
        $id = $db->quote($_GET['id']);
        $select = $db->query("SELECT * FROM works WHERE id=$id");
        if ($select->rowCount()==0){
            setFlash(" il n'y a pas de réalisation avec cet ID !", "danger");
            header('Location: work.php');
            die();
        }
        // stocker les données dans $_POST
        $_POST = $select->fetch();
    }

    // selectionner les catégories
    $select = $db->query('SELECT id, name FROM categories ORDER BY name ASC');
    $categories = $select->fetchAll();
    // créer un tableau
    $categories_liste = array();
    foreach ($categories as $categorie){
        $categories_liste[$categorie['id']] = $categorie['name'];
    }


    include '../partials/admin_header.php';
    ?>

        <h1> Editer une réalisation </h1>

        <form action="#" method="post">
            <div class="form-group">
                <label for="name" > Nom de la réalisation</label>
                <?php echo input('name') ?>
            </div>
            <div class="form-group">
                <label for="slug" > URL de la réalisation </label>
                <?php echo input('slug') ?>
            </div>
            <div class="form-group">
                <label for="content" > Contenue de la réalisation </label>
                <?php echo textarea('content') ?>
            </div>
            <div class="form-group">
                <label for="category_id" > Catégorie </label>
                <?php echo select('category_id', $categories_liste) ?>
            </div>
            <button type="submit" class="btn btn-default"> Enregistrer </button>
        </form>

    <?php include '../partials/footer.php'; ?>
    <?php include '../lib/debug.php'; ?>

