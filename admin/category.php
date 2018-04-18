<?php
    include '../lib/includes.php';
    include '../partials/admin_header.php';



    /**
     *Verification de supression
     */

    if (isset($_GET['delete']))
    {
        $id = $db->quote($_GET['delete']);
        //var_dump($_GET);
        $db->query("DELETE FROM categories WHERE id = $id");
        //var_dump($db->query("DELETE FROM categories WHERE id = $id"));
        setFlash('la catégorie est supprimer ');
        header('Location:category.php');
        die();
    }
    $select = $db->query("SELECT * FROM categories");
    $categories = $select->fetchAll();


?>

    <h1> Liste des categories </h1>
    <p><a href="category_edit.php" class="btn btn-success"> Ajouter une nouvelle catégorie </a></p>
    <table class ="tablet table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id']?></td>
                    <td><?= $category['name']?></td>
                    <td>
                        <a href="category_edit.php?id=<?= $category['id']?>" class ="btn btn-default"> Edit</a>
                        <a href="?delete=<?= $category['id']?>&<?php echo csrf();?>"class="btn btn-error" onclick="return confirm('Voulez vous supprimer ! ')"> Supprimer</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>


    </table>




<?php
    include '../partials/footer.php';
?>
