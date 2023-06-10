<h1 class="heading">Les Article</h1>
<?php

$result = $result ?? [];
$categories = $categories ?? [];

?>
<div class="right"><button id="add" class="btn infos"> Ajouter un Article</button></div>
<table class="table strip">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Déscription</th>
            <th>Catégorie</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $value) : ?>
            <tr>
                <td><?= $value->idArticle ?></td>
                <td><?= $value->nomArticle ?></td>
                <td><?= $value->prix_vente ?></td>
                <td><?= $value->description ?></td>
                <td><?= $value->nomCategorie ?></td>
                <td class="action" data-id="<?= $value->idArticle ?>">
                    <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
                    <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<dialog class='dialog' id="dialog">
    <h2 class="h">Formulaire des articles</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form">
            <input type="hidden" name="id" class="id">
            <input type="hidden" name="edit" class="edit">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" class="nom" name="nom" id="name" placeholder="Entrer le nom">
            </div>
            <div class="form-group">
                <label for="prix">Prix :</label>
                <input type="number" class="prix" name="prix" id="prix" placeholder="Entrer le prix">
            </div>
            <div class="form-group">
                <label for="description">Déscription :</label>
                <textarea name="description" class="description" cols="25" rows="1"></textarea>
            </div>
            <div class="form-group">
                <label for="name">Catégorie :</label>
                <select name="categorie" class="categorie">
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie->idCategorie ?>"><?= $categorie->nomCategorie ?></option>
                    <?php endforeach ?>
                </select>
                <div class="form-group">
                    <button class="btn default" type="reset">Annuler</button>
                    <button class="btn success" type="submit">Enrégistrer</button>
                </div>
            </div>
        </form>
    </div>
    <div class="right"><button class="btn danger" id="close">fermer</button></div>
</dialog>
<script>
    const add = document.getElementById('add');
    const close = document.getElementById('close');
    const dialog = document.getElementById('dialog');
    const form = document.getElementById('form');
    let data = []

    function getData(val) {
        data = val
    }


    add.addEventListener('click', function(e) {
        form.querySelector(".edit").value = null
        form.querySelector(".id").value = null
        form.querySelector(".nom").value = null
        form.querySelector(".prix").value = null
        form.querySelector(".description").value = null
        dialog.showModal()
    })

    close.addEventListener('click', function(e) {
        dialog.close()
    })
    form.addEventListener('submit', async function(e) {
        e.preventDefault()
        const {
            edit: {
                value: edit = null
            },
            id: {
                value: id = null
            },
            nom: {
                value: nom
            },
            prix: {
                value: prix
            },
            description: {
                value: description
            },
            categorie: {
                value: categorie
            },
        } = this

        let dt = {
            edit: edit,
            id: id,
            nom: nom,
            prix: prix,
            description: description,
            categorie: categorie,
        }
        dt = JSON.stringify(dt)
        alert(dt)
        const url = edit ? `?p=api/article/edit/${id}&data=${dt}` : `?p=api/article/insert&data=${dt}`
        await fetchData(url, getData)
        console.log(data);
        dialog.close()

    })

    const deletes = document.querySelectorAll('.delete')
    deletes.forEach(elmt => {
        elmt.addEventListener('click', async function(e) {
            const id = this.parentNode.dataset.id
            await fetchData(`?p=api/article/delete/${id}`, getData)
            console.log(data);
        })
    });

    const edits = document.querySelectorAll('.edit')
    edits.forEach(edit => {
        edit.addEventListener('click', async function(e) {
            const id = this.parentNode.dataset.id
            await fetchData(`?p=api/article/find/${id}`, getData)
            const {
                nomArticle,
                prix_vente,
                description,
                idCategorie
            } = data
            form.querySelector(".edit").value = true
            form.querySelector(".id").value = id
            form.querySelector(".nom").value = nomArticle
            form.querySelector(".prix").value = prix_vente
            form.querySelector(".description").value = description
            const select = form.querySelector(".categorie")
            const options = select.querySelectorAll('option')
            options.forEach(option => {
                if (option.value == idCategorie) option.selected = true
            });
            dialog.showModal()
        })
    });
</script>