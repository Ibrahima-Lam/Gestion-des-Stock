<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Mon site" ?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>

<body>
    <div class="side-bar">
        <h2>Gestion des Stocks</h2>
        <hr>
        <ul>
            <li><a href="#"><img src="icons/house-fill.svg"> Accueil</a></li>
            <li><a href="#"><img src="icons/check-all.svg"> Ventes</a></li>
            <li><a href="#"><img src="icons/bookmark.svg"> Produits</a></li>
            <li><a href="#"><img src="icons/card-list.svg"> Catégories</a></li>
            <li><a href="#"><img src="icons/person-circle.svg"> Clients</a></li>
            <li><a href="#"><img src="icons/people-fill.svg"> Fournisseurs</a></li>
            <li><a href="#"><img src="icons/shop.svg"> Stocks</a></li>
            <li><a href="#"><img src="icons/book-fill.svg"> Commandes</a></li>
            <li><a href="#"><img src="icons/table.svg"> Statistiques</a></li>
        </ul>
    </div>
    <div class="container">
        <?= $content ?? null ?>
    </div>
</body>

</html>