<h1 class="heading">Les commandes</h1>

<?php
$title = "Commandes";
$commandes = $commandes ?? [];
$clients = $clients ?? [];
$articles = $articles ?? [];

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
            <option value="idCommande">ID</option>
            <option value="dateCommande">date</option>
            <option value="delaiCommande">Delai</option>
            <option value="idClient">Client</option>
        </select>
    </div>
    <div class="row sort">
        Filtre :
        <select id="filtre" class="client">
            <option value="">Tout</option>
            <?php foreach ($clients as $client) : ?>
                <option value="<?= $client->idClient ?>"><?= $client->nomClient ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button id="add" class="btn infos shadow"> Ajouter une Commande</button>
</div>
<table class="table strip">
    <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Delai</th>
            <th>Client</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande) : ?>
            <tr>
                <td><?= $commande->idCommande ?></td>
                <td><?= $commande->dateCommande ?></td>
                <td><?= $commande->delaiCommande ?></td>
                <td><?= $commande->nomClient ?></td>
                <td class="action" data-id="<?= $commande->idCommande ?>">
                    <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
                    <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
                    <button class="btn add" title="Ajouter un article à cette commande"><img src="icons/plus.svg"></button>
                    <button class="btn liste" title="liste des article pour cette commande"><img src="icons/list-task.svg"></button>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<template id="row">
    <tr>
        <td class="id"></td>
        <td class="date"></td>
        <td class="delai"></td>
        <td class="client"></td>
        <td class="action">
            <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
            <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
            <button class="btn add" title="Ajouter un article à cette commande"><img src="icons/plus.svg"></button>
            <button class="btn liste" title="liste des article pour cette commande"><img src="icons/list-task.svg"></button>

        </td>
    </tr>
</template>

<dialog class='dialog' id="dialog">
    <h2 class="h">Formulaire des Commandes</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form">
            <input type="hidden" name="id" class="id">
            <input type="hidden" name="edit" class="edit">
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" class="date" name="date" id="date">
            </div>
            <div class="form-group">
                <label for="prix">Délai :</label>
                <input type="number" class="delai" name="delai" id="delai" placeholder="Entrer le délai">
            </div>

            <div class="form-group">
                <label for="name">Client :</label>
                <select name="client" class="client">
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?= $client->idClient ?>"><?= $client->nomClient ?></option>
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

<dialog class="dialog" id="liste">
    <h2 class="h">Liste des Article de La Commande</h2>
    <div class="dialog-body">
        <table class="table striped">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Prix</th>
                    <th>Quantite</th>
                    <th>Prix Total</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Adresse Client</th>

                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <p class="message h"></p>
        <div class="h"><strong>Prix Total de la commande :<span class="totaux"></span></strong></div>
    </div>
    <div class="right"><button class="btn danger" id="ferme">fermer</button></div>
</dialog>
<template id="liste-row">
    <tr>
        <td class="article"></td>
        <td class="prix"></td>
        <td class="quantite"></td>
        <td class="total"></td>
        <td class="date"></td>
        <td class="client"></td>
        <td class="adresse"></td>

    </tr>
</template>
<dialog class='dialog' id="form2">
    <h2 class="h">Formulaire des ventes</h2>
    <div class="dialog-body">
        <form action="" class="form" id="frm">

            <input type="hidden" name="edit" class="edit">


            <div class="form-group">
                <label for="name">Catégorie :</label>
                <select name="commande" class="commande">
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" name="quantite" id="quantite" class="quantite" placeholder="Entrer la quantité">
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
    <div class="right"><button class="btn danger" id="ferme2">fermer</button></div>
</dialog>
<script>
    const add = document.getElementById('add');
    const close = document.getElementById('close');
    const ferme = document.getElementById('ferme');
    const ferme2 = document.getElementById('ferme2');
    const dialog = document.getElementById('dialog');
    const liste = document.getElementById('liste');
    const form = document.getElementById('form');
    const form2 = document.getElementById('form2');
    const frm = document.getElementById('frm');
    const tbody = document.querySelector('tbody');
    let data = []
    let alldata = []
    let node = null
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
            idCommande,
            dateCommande,
            delaiCommande,
            idClient,
            nomClient
        } = data
        tr.querySelector(".id").innerText = idCommande
        tr.querySelector(".date").innerText = dateCommande
        tr.querySelector(".delai").innerText = delaiCommande
        tr.querySelector(".client").innerText = nomClient
        tr.querySelector(".action").dataset.id = idCommande
        return tr
    }

    function constructListRow(data) {
        const row = document.getElementById('liste-row');
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
        /*  tr.querySelector(".action").dataset.idarticle = idArticle
         tr.querySelector(".action").dataset.idcommande = idCommande */
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
        if (alldata.length === 0) await fetchData("?p=api/commande/find", getAllData)
        let elements = alldata

        if (filtre) elements = elements.filter(element => {
            return element.idClient == filtre
        })

        if (val) elements = elements.filter(elmt => {
            return elmt.idCommande.toString().includes(val) ||
                elmt.dateCommande.toUpperCase().includes(val.toUpperCase()) ||
                elmt.nomClient.toUpperCase().includes(val.toUpperCase())
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

        Actionlistener()

    }

    add.addEventListener('click', function(e) {
        form.querySelector(".edit").value = null
        form.querySelector(".id").value = null
        form.querySelector(".date").value = null
        form.querySelector(".delai").value = null
        dialog.showModal()
    })

    close.addEventListener('click', function(e) {
        dialog.close()
    })
    ferme.addEventListener('click', function(e) {
        liste.close()
    })
    ferme2.addEventListener('click', function(e) {
        form2.close()
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
            date: {
                value: date
            },
            delai: {
                value: delai
            },
            client: {
                value: client
            },
        } = this

        let dt = {
            edit: edit,
            id: id,
            date: date,
            delai: delai,
            client: client,
        }
        dt = JSON.stringify(dt)
        if (edit) {
            if (!confirm("Voulez vous modifier cet élément?")) {
                dialog.close()
                return
            }
        }

        const url = edit ? `?p=api/commande/edit/${id}&data=${dt}` : `?p=api/commande/insert&data=${dt}`
        await fetchData(url, getData)
        dialog.close()

        if (!(data.idCommande ?? null)) return
        const tr = constructRow(data)
        if (edit) {
            tbody.replaceChild(tr, node)
        } else {
            tbody.append(tr)
        }

        await fetchData("?p=api/commande/find", getAllData)
        Actionlistener()
    })

    frm.addEventListener('submit', async function(e) {
        e.preventDefault()
        const {

            article: {
                value: article
            },
            quantite: {
                value: quantite
            },
            commande: {
                value: commande
            }

        } = this

        let dt = {
            edit: null,
            idA: article,
            idC: commande,
            quantite: quantite,
        }
        dt = JSON.stringify(dt)

        const url = `?p=api/vente/insert&data=${dt}`
        await fetchData(url, getData)

        form2.close()
        if ((data.idCommande ?? null)) affiche(data.idCommande)
    })

    function Actionlistener() {
        const deletes = document.querySelectorAll('.delete')
        deletes.forEach(elmt => {
            elmt.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()
                const id = this.parentNode.dataset.id
                if (confirm("voulez supprimer cet élément")) {
                    await fetchData(`?p=api/commande/delete/${id}`, getData)
                    if (data.res ?? null) {
                        const tr = this.parentNode.parentNode
                        tr.classList.add("removed")
                        setTimeout(() => {
                            tr.remove()
                        }, 500);
                    }
                }
            })
        });

        const edits = document.querySelectorAll('.edit')
        edits.forEach(edit => {
            edit.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()
                const id = this.parentNode.dataset.id
                node = this.parentNode.parentNode
                if (alldata.length === 0) await fetchData("?p=api/commande/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idCommande == id
                })
                const {
                    dateCommande,
                    delaiCommande,
                    idClient
                } = data[0]
                form.querySelector(".edit").value = true
                form.querySelector(".id").value = id
                form.querySelector(".date").value = dateCommande
                form.querySelector(".delai").value = delaiCommande
                const select = form.querySelector(".client")
                const options = select.querySelectorAll('option')
                options.forEach(option => {
                    if (option.value == idClient) option.selected = true
                });
                dialog.showModal()
            })
        });

        const adds = tbody.querySelectorAll('.add')
        adds.forEach(add => {
            add.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()
                const select = form2.querySelector(".commande")
                const option = select.querySelector("option")
                const id = this.parentNode.dataset.id
                if (alldata.length === 0) await fetchData("?p=api/commande/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idCommande == id
                })
                const {
                    dateCommande,
                    nomClient
                } = data[0]
                option.value = id
                option.innerText = `${dateCommande} / ${nomClient}`
                form2.showModal()
            })
        });

        const listes = tbody.querySelectorAll('.liste')
        listes.forEach(element => {
            element.addEventListener('click', async function(e) {
                e.stopImmediatePropagation()
                const id = this.parentNode.dataset.id
                affiche(id)
            })
        });
    }

    async function affiche(id) {
        await fetchData(`?p=api/vente/match/${id}`, getData)

        const tb = liste.querySelector("tbody")
        const p = liste.querySelector("p")
        tb.innerHTML = ""
        p.innerHTML = ""
        let total = 0
        if (data.length !== 0 && (data.res ?? true)) {
            data.forEach(element => {
                const tr = constructListRow(element)
                tb.append(tr)
            });
            total = data.reduce((a, b) => {
                return a + (+b.prix_vente) * b.quantite
            }, 0)
            liste.querySelector(".totaux").innerText = total
        } else p.innerText = "Pas d'article dans cette commande"
        liste.showModal()
    }
    Actionlistener()
</script>