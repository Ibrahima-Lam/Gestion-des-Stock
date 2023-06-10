<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Gestion des Stocks" ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icons/shop.svg" type="image/x-icon">
    <script src="js/script.js" defer></script>
</head>

<body>
    <div class="side-bar">
        <h2>Gestion des Stocks</h2>
        <hr>
        <ul>
            <li><a href="?p=app"><img src="icons/house-fill.svg"> Accueil</a></li>
            <li><a href="?p=vente"><img src="icons/check-all.svg"> Ventes</a></li>
            <li><a href="?p=article"><img src="icons/bookmark.svg"> Articles</a></li>
            <li><a href="?p=categorie"><img src="icons/card-list.svg"> Catégories</a></li>
            <li><a href="?p=Client"><img src="icons/person-circle.svg"> Clients</a></li>
            <li><a href="?p=fournisseur"><img src="icons/people-fill.svg"> Fournisseurs</a></li>
            <li><a href="?p=stock"><img src="icons/shop.svg"> Stocks</a></li>
            <li><a href="?p=commande"><img src="icons/book-fill.svg"> Commandes</a></li>
            <li><a href="?p=statistique"><img src="icons/table.svg"> Statistiques</a></li>
        </ul>
    </div>
    <div class="container">
        <?= $content ?? null ?>
    </div>
</body>

</html>