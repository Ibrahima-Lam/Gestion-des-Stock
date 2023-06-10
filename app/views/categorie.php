<h1 class="heading">Les Categories</h1>
<?php
$title = "Catégorie";
$categories = $categories ?? [];
?>
<table class="table strip">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $value) : ?>
            <tr>
                <td><?= $value->idCategorie ?></td>

                <td><?= $value->nomCategorie ?></td>
                <td class="action" data-id="<?= $value->idCategorie ?>">
                    <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
                    <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>