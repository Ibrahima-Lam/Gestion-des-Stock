<h1 class="heading">Les Articles</h1>
<?php
$title = "Articles";
$result = $result ?? [];
$categories = $categories ?? [];

?>
<div class="right-wrap">
    <input type="search" name="search" id="search" class="search" placeholder="Recherche...">
    <div class="row sort">
        <div class="flex-evenly">
            <label for="asc">&#8681;: </label>
            <input type="radio" id="asc" value="asc" class="trie" name="trie" checked>
        </div>
        <div class="flex-evenly">
            <label for="desc">&#8679;: </label>
            <input type="radio" id="desc" value="desc" class="trie" name="trie">
        </div>
    </div>
    <div class="row sort">
        Trie :
        <select name="" id="triant">
            <option value="idArticle">ID</option>
            <option value="nomArticle">Nom</option>
            <option value="prix_vente">Prix</option>
            <option value="idCategorie">Catégorie</option>
        </select>
    </div>
    <div class="row sort">
        Filtre :
        <select id="filtre" class="categorie">
            <option value="">Tout</option>
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?= $categorie->idCategorie ?>"><?= $categorie->nomCategorie ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button id="add" class="btn infos shadow"> Ajouter un Article</button>
</div>
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

<template id="row">
    <tr>
        <td class="id"></td>
        <td class="nom"></td>
        <td class="prix"></td>
        <td class="description"></td>
        <td class="categorie"></td>
        <td class="action">
            <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
            <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
        </td>
    </tr>
</template>

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
                <textarea name="description" placeholder="Entrer la Déscription" class="description" cols="25" rows="1"></textarea>
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
    const tbody = document.querySelector('tbody');
    let data = []
    let alldata = []
    let node = null
    const paramettre = {
        trie: "asc",
        triant: "idArticle",
        val: null,
        filtre: null
    }

    function getData(val) {
        data = val
    }

    function getAllData(val) {
        alldata = val
    }

    function constructRow(data) {
        const row = document.getElementById('row');
        const tr = row.content.cloneNode(true)
        const {
            idArticle,
            nomArticle,
            prix_vente,
            description,
            idCategorie,
            nomCategorie
        } = data
        tr.querySelector(".id").innerText = idArticle
        tr.querySelector(".nom").innerText = nomArticle
        tr.querySelector(".description").innerText = description
        tr.querySelector(".prix").innerText = prix_vente
        tr.querySelector(".categorie").innerText = nomCategorie
        tr.querySelector(".action").dataset.id = idArticle
        return tr
    }

    const tries = document.querySelectorAll('.trie')
    tries.forEach(element => {
        element.addEventListener('change', async function(e) {
            paramettre.trie = this.value
            await changeTbody()
        })
    });

    const search = document.getElementById('search');
    search.addEventListener('input', async function(e) {
        paramettre.val = this.value
        await changeTbody()
    })

    const triant = document.getElementById('triant');
    triant.addEventListener('change', async function(e) {
        paramettre.triant = this.value
        await changeTbody()
    })
    const filtre = document.getElementById('filtre');
    filtre.addEventListener('change', async function(e) {
        paramettre.filtre = this.value
        await changeTbody()
    })
    async function changeTbody() {
        tbody.innerHTML = ""
        const {
            trie,
            triant,
            val,
            filtre
        } = paramettre
        if (alldata.length === 0) await fetchData("?p=api/article/find", getAllData)
        let elements = alldata

        if (filtre) elements = elements.filter(element => {
            return element.idCategorie == filtre
        })

        if (val) elements = elements.filter(elmt => {
            return elmt.idArticle.toString().includes(val) ||
                elmt.nomArticle.toUpperCase().includes(val.toUpperCase()) ||
                elmt.description.toUpperCase().includes(val.toUpperCase()) ||
                elmt.nomCategorie.toUpperCase().includes(val.toUpperCase())
        })
        elements = elements.map(element => {
            element.prix_vente = +element.prix_vente
            return element
        })

        elements = elements.sort((a, b) => {
            const t = a[triant] < b[triant] ? -1 : 1
            return trie === "asc" ? t : -t
        })

        elements.forEach(element => {
            const tr = constructRow(element)
            tbody.append(tr)
        });

        Actionlistener()

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
        if (edit) {
            if (!confirm("Voulez vous modifier cet élément?")) {
                dialog.close()
                return
            }
        }

        const url = edit ? `?p=api/article/edit/${id}&data=${dt}` : `?p=api/article/insert&data=${dt}`
        await fetchData(url, getData)
        dialog.close()

        if (!(data.idArticle ?? null)) return
        const tr = constructRow(data)
        if (edit) {
            tbody.replaceChild(tr, node)
        } else {
            tbody.append(tr)
        }

        await fetchData("?p=api/article/find", getAllData)
        Actionlistener()
    })

    function Actionlistener() {
        const deletes = document.querySelectorAll('.delete')
        deletes.forEach(elmt => {
            elmt.addEventListener('click', async function(e) {
                const id = this.parentNode.dataset.id
                if (confirm("voulez supprimer cet élément")) {
                    await fetchData(`?p=api/article/delete/${id}`, getData)
                    const tr = this.parentNode.parentNode
                    tr.classList.add("removed")
                    setTimeout(() => {
                        if (data.res ?? null) tr.remove()
                    }, 500);
                }
            })
        });

        const edits = document.querySelectorAll('.edit')
        edits.forEach(edit => {
            edit.addEventListener('click', async function(e) {
                const id = this.parentNode.dataset.id
                node = this.parentNode.parentNode
                // await fetchData(`?p=api/article/find/${id}`, getData)
                if (alldata.length === 0) await fetchData("?p=api/article/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idArticle == id
                })
                const {
                    nomArticle,
                    prix_vente,
                    description,
                    idCategorie
                } = data[0]
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
    }

    Actionlistener()
</script>