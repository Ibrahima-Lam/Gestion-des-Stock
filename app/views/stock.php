<h1 class="heading">Les Stocks</h1>


<?php
$title = "Stocks";
$stocks = $stocks ?? [];
$articles = $articles ?? [];

$fournisseurs = $fournisseurs ?? [];

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
            <option value="nomArticle">Article</option>
            <option value="nomCategorie">Catégorie</option>
            <option value="dateProposer">Date</option>
            <option value="quantiteProposer">Quantité</option>
            <option value="nomFournisseur">Fournisseur</option>
            <option value="AdresseFournisseur">Adresse Fournisseur</option>
        </select>
    </div>
    <div class="row sort">
        Filtre :
        <select id="filtre" class="categorie">
            <option value="">Tout</option>
            <?php foreach ($fournisseurs as $fournisseur) : ?>
                <option value="<?= $fournisseur->idFournisseur ?>"><?= $fournisseur->nomFournisseur ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button id="add" class="btn infos shadow"> Ajouter un Stock</button>
</div>
<table class="table strip">
    <thead>
        <tr>
            <th>Article</th>
            <th>Prix</th>
            <th>Quantite</th>
            <th>Date</th>
            <th>Fournisseur</th>
            <th>Adresse Fournisseur</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stocks as $value) : ?>
            <tr>
                <td><?= $value->nomArticle ?></td>
                <td><?= $value->prix_vente ?></td>
                <td><?= $value->quantiteProposer ?></td>
                <td><?= $value->dateProposer ?></td>
                <td><?= $value->nomFournisseur ?></td>
                <td><?= $value->adresseFournisseur ?></td>
                <td class="action" data-idFournisseur="<?= $value->idFournisseur ?>" data-idArticle="<?= $value->idArticle ?>">
                    <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
                    <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<template id="row">
    <tr>
        <td class="article"></td>
        <td class="prix"></td>
        <td class="quantite"></td>
        <td class="date"></td>
        <td class="fournisseur"></td>
        <td class="adresse"></td>
        <td class="action">
            <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
            <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
        </td>
    </tr>
</template>

<dialog class='dialog' id="dialog">
    <h2 class="h">Formulaire des stocks</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form">

            <input type="hidden" name="edit" class="edit">


            <div class="form-group">
                <label for="name">Fournisseur :</label>
                <select name="fournisseur" class="fournisseur">
                    <?php foreach ($fournisseurs as $fournisseur) : ?>
                        <option value="<?= $fournisseur->idFournisseur ?>">
                            <?= $fournisseur->nomFournisseur ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité :</label>
                <input type="number" name="quantite" id="quantite" class="quantite" placeholder="Entrer la quantité">
            </div>
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" name="date" id="date" class="date" value="">
            </div>
            <div class="form-group">
                <label for="name">Article :</label>
                <select name="article" class="article">
                    <?php foreach ($articles as $article) : ?>
                        <option value="<?= $article->idArticle ?>"><?= $article->nomArticle ?></option>
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
<dialog id="produit" class="dialog">
    <div class="dialog-body">
        <h2 class="h">Le Stock</h2>
        <dl>
            <dd><strong>Id :</strong><span class="idarticle"></span></dd>
            <dd><strong>Nom :</strong><span class="nomarticle"></span></dd>
            <dd><strong>Prix :</strong><span class="prix_vente"></span></dd>
            <dd><strong>Déscription :</strong><span class="description"></span></dd>
            <dd><strong>id Catégorie :</strong><span class="idcategorie"></span></dd>
            <dd><strong>Catégorie :</strong><span class="nomcategorie"></span></dd>
            <dd><strong>date :</strong><span class="dateproposer"></span></dd>
            <dd><strong>quantite :</strong><span class="quantiteproposer"></span></dd>
            <dd><strong>Prix total :</strong><span class="total"></span></dd>
            <dd><strong>idFournisseur :</strong><span class="idfournisseur"></span></dd>
            <dd><strong>nomFournisseur :</strong><span class="nomfournisseur"></span></dd>
            <dd><strong>adresseFournisseur :</strong><span class="adressefournisseur"></span></dd>
            <dd><strong>telFournisseur :</strong><span class="telfournisseur"></span></dd>
        </dl>
    </div>
    <div class="right"><button class="btn danger" id="ferme">Fermer</button></div>
</dialog>
<script>
    const add = document.getElementById('add');
    const close = document.getElementById('close');
    const ferme = document.getElementById('ferme');
    const dialog = document.getElementById('dialog');
    const produit = document.getElementById('produit');
    const form = document.getElementById('form');
    const tbody = document.querySelector('tbody');
    let data = []
    let alldata = []
    let node = null
    let nodes = []
    const paramettre = {
        trie: "asc",
        triant: "idCommande",
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
            nomArticle,
            idArticle,
            prix_vente,
            quantiteProposer,
            dateProposer,
            idFournisseur,
            nomFournisseur,
            adresseFournisseur
        } = data
        tr.querySelector(".article").innerText = nomArticle
        tr.querySelector(".prix").innerText = prix_vente
        tr.querySelector(".quantite").innerText = quantiteProposer
        tr.querySelector(".date").innerText = dateProposer
        tr.querySelector(".fournisseur").innerText = nomFournisseur
        tr.querySelector(".adresse").innerText = adresseFournisseur
        tr.querySelector(".action").dataset.idarticle = idArticle
        tr.querySelector(".action").dataset.idfournisseur = idFournisseur
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
        if (alldata.length === 0) await fetchData("?p=api/stock/find", getAllData)
        let elements = alldata

        if (filtre) elements = elements.filter(element => {
            return element.idFournisseur == filtre
        })

        if (val) elements = elements.filter(elmt => {
            return elmt.nomArticle.toUpperCase().includes(val.toUpperCase()) ||
                elmt.nomFournisseur.toUpperCase().includes(val.toUpperCase()) ||
                elmt.adresseFournisseur.toUpperCase().includes(val.toUpperCase())
        })

        elements = elements.sort((a, b) => {
            let t = a[triant] < b[triant] ? -1 : 1
            if (typeof a === "string" && typeof b === "string") t = a[triant].toUpperCase() < b[triant].toUpperCase() ? -1 : 1
            return trie === "asc" ? t : -t
        })

        elements.forEach(element => {
            const tr = constructRow(element)
            tbody.append(tr)
        });
        await fetchData("?p=api/stock/find", getAllData)
        Actionlistener()

    }

    add.addEventListener('click', function(e) {
        form.querySelector(".edit").value = null
        form.querySelector(".quantite").value = null
        form.querySelector(".date").value = null
        dialog.showModal()
    })

    close.addEventListener('click', function(e) {
        dialog.close()
    })
    ferme.addEventListener('click', function(e) {
        produit.close()
    })


    form.addEventListener('submit', async function(e) {
        e.preventDefault()
        const {
            edit: {
                value: edit = null
            },
            article: {
                value: article = null
            },
            quantite: {
                value: quantite
            },
            date: {
                value: date
            },
            fournisseur: {
                value: fournisseur
            }

        } = this
        console.log(quantite);
        let dt = {
            edit: edit,
            idA: article,
            idF: fournisseur,
            quantite: quantite,
            date: date,
        }
        dt = JSON.stringify(dt)
        if (edit) {
            if (!confirm("Voulez vous modifier cet élément?")) {
                dialog.close()
                return
            }
        }

        const url = edit ? `?p=api/stock/edit&data=${dt}` : `?p=api/stock/insert&data=${dt}`
        await fetchData(url, getData)
        dialog.close()


        if (!(data.idArticle ?? null)) return
        const tr = constructRow(data)
        if (edit) {
            tbody.replaceChild(tr, node)
        } else {
            tbody.append(tr)
        }

        await fetchData("?p=api/stock/find", getAllData)
        Actionlistener()
    })

    function Actionlistener() {
        const deletes = document.querySelectorAll('.delete')
        deletes.forEach(elmt => {
            elmt.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()

                const idf = this.parentNode.dataset.idfournisseur
                const ida = this.parentNode.dataset.idarticle
                let dt = {
                    idF: idf,
                    idA: ida
                }
                dt = JSON.stringify(dt)

                if (confirm("voulez supprimer cet élément")) {
                    await fetchData(`?p=api/stock/delete&data=${dt}`, getData)
                    let trs = tbody.querySelectorAll("tr")
                    let nodes = []
                    trs.forEach(elmt => {
                        let id1 = elmt.querySelector(".action").dataset.idarticle == ida ? true : false
                        let id2 = elmt.querySelector(".action").dataset.idfournisseur == idf ? true : false
                        if (id1 && id2) nodes.push(elmt)
                    })
                    nodes.forEach(element => {
                        element.classList.add("removed")
                        setTimeout(() => {
                            if (data.res ?? null) element.remove()
                        }, 500);
                    });
                    nodes = []
                }
            })
        });

        const edits = document.querySelectorAll('.edit')
        edits.forEach(edit => {
            edit.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()
                const ida = this.parentNode.dataset.idarticle
                const idf = this.parentNode.dataset.idfournisseur
                node = this.parentNode.parentNode

                if (alldata.length === 0) await fetchData("?p=api/stock/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idArticle == ida && elmt.idFournisseur == idf
                })

                const {
                    idArticle,
                    idFournisseur,
                    quantiteProposer,
                    dateProposer,
                } = data[0]

                form.querySelector(".edit").value = true
                form.querySelector(".quantite").value = quantiteProposer
                form.querySelector(".date").value = dateProposer
                const select = form.querySelector(".fournisseur")
                const options = select.querySelectorAll('option')
                options.forEach(option => {
                    if (option.value == idFournisseur) option.selected = true
                });

                const select2 = form.querySelector(".article")
                const options2 = select2.querySelectorAll('option')
                options2.forEach(option => {
                    if (option.value == idArticle) option.selected = true
                });
                dialog.showModal()
            })
        });

        const trs = tbody.querySelectorAll('tr')
        trs.forEach(tr => {
            tr.addEventListener('click', async function(e) {
                const idc = tr.querySelector(".action").dataset.idcommande
                const ida = tr.querySelector(".action").dataset.idarticle
                if (alldata.length === 0) await fetchData("?p=api/stock/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idArticle == ida && elmt.idCommande == idc
                })
                console.log(data)
                const {
                    idArticle,
                    nomArticle,
                    prix_vente,
                    description,
                    idCategorie,
                    nomCategorie,
                    dateProposer,
                    quantiteProposer,
                    idFournisseur,
                    nomFournisseur,
                    adresseFournisseur,
                    telFournisseur
                } = data[0]

                produit.querySelector(".idarticle").innerText = idArticle
                produit.querySelector(".nomarticle").innerText = nomArticle
                produit.querySelector(".prix_vente").innerText = prix_vente
                produit.querySelector(".description").innerText = description
                produit.querySelector(".idcategorie").innerText = idCategorie
                produit.querySelector(".nomcategorie").innerText = nomCategorie
                produit.querySelector(".dateproposer").innerText = dateProposer
                produit.querySelector(".quantiteproposer").innerText = quantiteProposer
                produit.querySelector(".idfournisseur").innerText = idFournisseur
                produit.querySelector(".nomfournisseur").innerText = nomFournisseur
                produit.querySelector(".adressefournisseur").innerText = adresseFournisseur
                produit.querySelector(".telfournisseur").innerText = telFournisseur
                produit.querySelector(".total").innerText = prix_vente * quantiteProposer
                produit.showModal()
            })
        });
    }

    Actionlistener()
</script>