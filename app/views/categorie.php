<h1 class="heading">Les Catégories</h1>
<?php
$title = "Catégorie";
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
            <option value="idCategorie">ID</option>
            <option value="nomCategorie">Nom</option>
        </select>
    </div>
    <button id="add" class="btn infos shadow">Ajouter une Catégorie</button>
</div>
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
                    <button class="btn add" title="Ajouter un article à cette catégorie"><img src="icons/plus.svg"></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<template id="row">
    <tr>
        <td class="id"></td>
        <td class="nom"></td>
        <td class="action">
            <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
            <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
            <button class="btn add" title="Ajouter un article à cette catégorie"><img src="icons/plus.svg"></button>

        </td>
    </tr>
</template>


<dialog class='dialog' id="dialog">
    <h2 class="h">Formulaire des Catégories</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form">
            <input type="hidden" name="id" class="id">
            <input type="hidden" name="edit" class="edit">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" class="nom" name="nom" id="name" placeholder="Entrer le nom">
            </div>

            <div class="form-group">
                <button class="btn default" type="reset">Annuler</button>
                <button class="btn success" type="submit">Enrégistrer</button>
            </div>
        </form>
    </div>
    <div class="right"><button class="btn danger" id="close">fermer</button></div>
</dialog>

<dialog class='dialog' id="article">
    <h2 class="h">Formulaire des articles</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form2">
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
                    <option id="target" value=""></option>
                </select>
                <div class="form-group">
                    <button class="btn default" type="reset">Annuler</button>
                    <button class="btn success" type="submit">Enrégistrer</button>
                </div>
            </div>
        </form>
    </div>
    <div class="right"><button class="btn danger" id="ferme">Fermer</button></div>
</dialog>
<dialog id="article2" class="dialog">
    <div class="dialog-body">
        <h2 class="h">L'article</h2>
        <dl>
            <dd><strong>ID :</strong><span class="id"></span></dd>
            <dd><strong>Nom :</strong><span class="nom"></span></dd>
            <dd><strong>Prix :</strong><span class="prix"></span></dd>
            <dd><strong>Déscription :</strong><span class="description"></span></dd>
            <dd><strong>Catégorie :</strong><span class="categorie"></span></dd>
        </dl>
    </div>
    <div class="right"><button class="btn danger" id="ferme2">Fermer</button></div>
</dialog>
<script>
    const add = document.getElementById('add');
    const close = document.getElementById('close');
    const ferme = document.getElementById('ferme');
    const ferme2 = document.getElementById('ferme2');
    const form = document.getElementById('form');
    const form2 = document.getElementById('form2');
    const article = document.getElementById('article')
    const article2 = document.getElementById('article2')
    const target = document.getElementById('target')

    const tbody = document.querySelector('tbody')
    let data = []
    let alldata = []
    let node = null

    const paramettre = {
        trie: "asc",
        triant: "idCategorie",
        val: null
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
            idCategorie,
            nomCategorie
        } = data
        tr.querySelector(".id").innerText = idCategorie
        tr.querySelector(".nom").innerText = nomCategorie
        tr.querySelector(".action").dataset.id = idCategorie
        return tr
    }

    async function changeTbody() {
        tbody.innerHTML = ""
        const {
            trie,
            triant,
            val
        } = paramettre
        if (alldata.length === 0) await fetchData("?p=api/categorie/find", getAllData)
        let elements = alldata


        if (val) elements = elements.filter(elmt => {
            return elmt.idCategorie.toString().includes(val) ||
                elmt.nomCategorie.toUpperCase().includes(val.toUpperCase())
        })
        
        elements = elements.sort((a, b) => {
            let t = a[triant] < b[triant] ? -1 : 1
            if(typeof a==="string" && typeof b==="string") t=a[triant].toUpperCase() < b[triant].toUpperCase() ? -1 : 1
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

        dialog.showModal()
    })

    close.addEventListener('click', function(e) {
        dialog.close()

    })

    ferme.addEventListener('click', function(e) {
        article.close()

    })
    ferme2.addEventListener('click', function(e) {
        article2.close()

    })

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

        } = this

        let dt = {
            edit: edit,
            id: id,
            nom: nom,

        }
        dt = JSON.stringify(dt)
        if (edit) {
            if (!confirm("Voulez vous modifier cet élément?")) {
                dialog.close()
                return
            }
        }
        const url = edit ? `?p=api/categorie/edit/${id}&data=${dt}` : `?p=api/categorie/insert&data=${dt}`
        await fetchData(url, getData)
        dialog.close()

        if (!(data.idCategorie ?? null)) return
        const tr = constructRow(data)
        if (edit) {
            tbody.replaceChild(tr, node)
        } else {
            tbody.append(tr)
        }

        await fetchData("?p=api/categorie/find", getAllData)
        Actionlistener()
    })

    form2.addEventListener('submit', async function(e) {
        e.preventDefault()
        const {
            id: id = null,
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

            id: id,
            nom: nom,
            prix: prix,
            description: description,
            categorie: categorie,
        }
        dt = JSON.stringify(dt)

        const url = `?p=api/article/insert&data=${dt}`
        await fetchData(url, getData)
        article.close()

        if (!(data.idArticle ?? null)) return

        article2.querySelector(".id").innerText = data.idArticle
        article2.querySelector(".nom").innerText = data.nomArticle
        article2.querySelector(".prix").innerText = data.prix_vente
        article2.querySelector(".description").innerText = data.description
        article2.querySelector(".categorie").innerText = data.nomCategorie
        article2.showModal()
    })

    function Actionlistener() {
        const deletes = document.querySelectorAll('.delete')
        deletes.forEach(elmt => {
            elmt.addEventListener('click', async function(e) {
                const id = this.parentNode.dataset.id
                if (confirm("voulez supprimer cet élément")) {
                    await fetchData(`?p=api/Categorie/delete/${id}`, getData)
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

                if (alldata.length === 0) await fetchData("?p=api/categorie/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idCategorie == id
                })
                const {
                    nomCategorie,

                } = data[0]
                form.querySelector(".edit").value = true
                form.querySelector(".id").value = id
                form.querySelector(".nom").value = nomCategorie

                dialog.showModal()
            })
        });

        const adds = tbody.querySelectorAll('.add')
        adds.forEach(add => {
            add.addEventListener('click', async function(e) {
                form2.querySelector(".nom").value = null
                form2.querySelector(".prix").value = null
                form2.querySelector(".description").value = null
                const id = this.parentNode.dataset.id
                if (alldata.length === 0) await fetchData("?p=api/categorie/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idCategorie == id
                })
                target.value = id
                target.innerText = data[0].nomCategorie
                article.showModal()
            })
        });
    }

    Actionlistener()
</script>