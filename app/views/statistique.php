<h1 class="heading">Les Statistiques</h1>
<?php
$title = "Statistiques";
$statistiques = $statistiques ?? [];
$articles = $articles ?? [];

?>
<br>
<h2 class="h">Les Clients et Les Commandes</h2>
<table class="table striped">
    <thead>
        <th>Client</th>
        <th>Adresse</th>
        <th>Date de Commande</th>
        <th>Nombre d'article</th>
        <th>Nombre Total d'article</th>
        <th>Prix Total</th>
    </thead>
    <tbody>
        <?php foreach ($statistiques as $stat) : ?>
            <tr>
                <td><?= $stat->nomClient ?></td>
                <td><?= $stat->adresseClient ?></td>
                <td><?= $stat->dateCommande ?></td>
                <td><?= $stat->nombre ?></td>
                <td><?= $stat->total ?></td>
                <td><?= $stat->prix ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>

<h2 class="h">Les Articles</h2>
<table class="table striped">
    <thead>
        <th>Article</th>
        <th>Description</th>
        <th>Catégorie</th>
        <th>Nombre de Commande</th>
        <th>Nombre fois Commandé</th>
        <th>Prix Total</th>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?= $article->nomArticle ?></td>
                <td><?= $article->description ?></td>
                <td><?= $article->nomCategorie ?></td>
                <td><?= $article->total ?></td>
                <td><?= $article->nombre ?></td>
                <td><?= $article->prix ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>