<h1 class="heading">Les Ventes</h1>

<?php
$title = "Ventes";
$ventes = $ventes ?? [];
$articles = $articles ?? [];

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
            <option value="idCommande">Commande</option>
            <option value="nomArticle">Article</option>
            <option value="prix_vente">Prix</option>
            <option value="dateCommande">Date</option>
            <option value="quantite">Quantité</option>
            <option value="nomClient">Client</option>
            <option value="AdresseClient">Adresse Client</option>
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
            <th>Article</th>
            <th>Prix</th>
            <th>Quantite</th>
            <th>Date</th>
            <th>Client</th>
            <th>Adresse Client</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ventes as $value) : ?>
            <tr>
                <td><?= $value->nomArticle ?></td>
                <td><?= $value->prix_vente ?></td>
                <td><?= $value->quantite ?></td>
                <td><?= $value->dateCommande ?></td>
                <td><?= $value->nomClient ?></td>
                <td><?= $value->adresseClient ?></td>
                <td class="action" data-idCommande="<?= $value->idCommande ?>" data-idArticle="<?= $value->idArticle ?>">
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
        <td class="client"></td>
        <td class="adresse"></td>
        <td class="action">
            <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
            <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
        </td>
    </tr>
</template>

<dialog class='dialog' id="dialog">
    <h2 class="h">Formulaire des ventes</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form">

            <input type="hidden" name="edit" class="edit">


            <div class="form-group">
                <label for="name">Article :</label>
                <select name="commande" class="commande">
                    <?php foreach ($commandes as $commande) : ?>
                        <option value="<?= $commande->idCommande ?>">
                            <?= $commande->dateCommande ?> /
                            <?= $commande->nomClient ?>

                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" id="quantite" class="quantite" placeholder="Entrer la quantité">
            </div>
            <div class="form-group">
                <label for="name">Catégorie :</label>
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
        <h2 class="h">L'article</h2>
        <dl>
            <dd><strong>Id :</strong><span class="idarticle"></span></dd>
            <dd><strong>Nom :</strong><span class="nomarticle"></span></dd>
            <dd><strong>Prix :</strong><span class="prix_vente"></span></dd>
            <dd><strong>Déscription :</strong><span class="description"></span></dd>
            <dd><strong>id Catégorie :</strong><span class="idcategorie"></span></dd>
            <dd><strong>Catégorie :</strong><span class="nomcategorie"></span></dd>
            <dd><strong>idCommande :</strong><span class="idcommande"></span></dd>
            <dd><strong>date :</strong><span class="datecommande"></span></dd>
            <dd><strong>delai :</strong><span class="delaicommande"></span></dd>
            <dd><strong>quantite :</strong><span class="quantite"></span></dd>
            <dd><strong>idClient :</strong><span class="idclient"></span></dd>
            <dd><strong>nomClient :</strong><span class="nomclient"></span></dd>
            <dd><strong>adresseClient :</strong><span class="adresseclient"></span></dd>
            <dd><strong>telClient :</strong><span class="telclient"></span></dd>
            <dd><strong>emailClient :</strong><span class="emailclient"></span></dd>
            <dd><strong>prix Total :</strong><span class="total"></span></dd>
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
            idCommande,
            prix_vente,
            quantite,
            dateCommande,
            nomClient,
            adresseClient
        } = data
        tr.querySelector(".article").innerText = nomArticle
        tr.querySelector(".prix").innerText = prix_vente
        tr.querySelector(".quantite").innerText = quantite
        tr.querySelector(".date").innerText = dateCommande
        tr.querySelector(".client").innerText = nomClient
        tr.querySelector(".adresse").innerText = adresseClient
        tr.querySelector(".action").dataset.idarticle = idArticle
        tr.querySelector(".action").dataset.idcommande = idCommande
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
        if (alldata.length === 0) await fetchData("?p=api/vente/find", getAllData)
        let elements = alldata

        /* if (filtre) elements = elements.filter(element => {
            return element.idCategorie == filtre
        }) */

        if (val) elements = elements.filter(elmt => {
            return elmt.nomArticle.toUpperCase().includes(val.toUpperCase()) ||
                elmt.dateCommande.toUpperCase().includes(val.toUpperCase()) ||
                elmt.nomClient.toUpperCase().includes(val.toUpperCase()) ||
                elmt.adresseClient.toUpperCase().includes(val.toUpperCase())
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
        form.querySelector(".quantite").value = null
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
            commande: {
                value: commande
            }

        } = this

        let dt = {
            edit: edit,
            idA: article,
            idC: commande,
            quantite: quantite,
        }
        dt = JSON.stringify(dt)
        if (edit) {
            if (!confirm("Voulez vous modifier cet élément?")) {
                dialog.close()
                return
            }
        }

        const url = edit ? `?p=api/vente/edit&data=${dt}` : `?p=api/vente/insert&data=${dt}`
        await fetchData(url, getData)
        dialog.close()


        if (!(data.idArticle ?? null)) return
        const tr = constructRow(data)
        if (edit) {
            tbody.replaceChild(tr, node)
        } else {
            tbody.append(tr)
        }

        await fetchData("?p=api/vente/find", getAllData)
        Actionlistener()
    })

    function Actionlistener() {
        const deletes = document.querySelectorAll('.delete')
        deletes.forEach(elmt => {
            elmt.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()

                const idc = this.parentNode.dataset.idcommande
                const ida = this.parentNode.dataset.idarticle
                let dt = {
                    idA: ida,
                    idC: idc
                }
                dt = JSON.stringify(dt)

                if (confirm("voulez supprimer cet élément")) {
                    await fetchData(`?p=api/vente/delete&data=${dt}`, getData)
                    let trs = tbody.querySelectorAll("tr")
                    let nodes = []
                    trs.forEach(elmt => {
                        let id1 = elmt.querySelector(".action").dataset.idarticle == ida ? true : false
                        let id2 = elmt.querySelector(".action").dataset.idcommande == idc ? true : false
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
                const idc = this.parentNode.dataset.idcommande
                const ida = this.parentNode.dataset.idarticle
                node = this.parentNode.parentNode

                if (alldata.length === 0) await fetchData("?p=api/vente/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idArticle == ida && elmt.idCommande == idc
                })

                const {
                    idArticle,
                    idCommande,
                    quantite
                } = data[0]

                form.querySelector(".edit").value = true
                form.querySelector(".quantite").value = quantite
                const select = form.querySelector(".commande")
                const options = select.querySelectorAll('option')
                options.forEach(option => {
                    if (option.value == idCommande) option.selected = true
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
                if (alldata.length === 0) await fetchData("?p=api/vente/find", getAllData)
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
                    idCommande,
                    dateCommande,
                    delaiCommande,
                    quantite,
                    idClient,
                    nomClient,
                    adresseClient,
                    telClient,
                    emailClient
                } = data[0]

                produit.querySelector(".idarticle").innerText = idArticle
                produit.querySelector(".nomarticle").innerText = nomArticle
                produit.querySelector(".prix_vente").innerText = prix_vente
                produit.querySelector(".description").innerText = description
                produit.querySelector(".idcategorie").innerText = idCategorie
                produit.querySelector(".nomcategorie").innerText = nomCategorie
                produit.querySelector(".idcommande").innerText = idCommande
                produit.querySelector(".delaicommande").innerText = delaiCommande
                produit.querySelector(".quantite").innerText = quantite
                produit.querySelector(".idclient").innerText = idClient
                produit.querySelector(".nomclient").innerText = nomClient
                produit.querySelector(".adresseclient").innerText = adresseClient
                produit.querySelector(".telclient").innerText = telClient
                produit.querySelector(".emailclient").innerText = emailClient
                produit.querySelector(".total").innerText = prix_vente * quantite
                produit.showModal()
            })
        });
    }

    Actionlistener()
</script>