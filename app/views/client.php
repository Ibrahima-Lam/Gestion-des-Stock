<h1 class="heading">Les Clients</h1>

<?php
$title = "Clients";
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
            <option value="idClient">ID</option>
            <option value="nomClient">Nom</option>
            <option value="adresseClient">Adresse</option>
        </select>
    </div>

    <button id="add" class="btn infos shadow"> Ajouter un Client</button>
</div>
<table class="table strip">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client) : ?>
            <tr>
                <td><?= $client->idClient ?></td>
                <td><?= $client->nomClient ?></td>
                <td><?= $client->adresseClient ?></td>
                <td><?= $client->telClient ?></td>
                <td><?= $client->emailClient ?></td>
                <td class="action" data-id="<?= $client->idClient ?>">
                    <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
                    <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
                    <button class="btn add" title="Ajouter une commande au  client"><img src="icons/plus.svg"></button>
                    <button class="btn liste" title="liste des commandes du client"><img src="icons/list-task.svg"></button>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<template id="row">
    <tr>
        <td class="id"></td>
        <td class="nom"></td>
        <td class="adresse"></td>
        <td class="tel"></td>
        <td class="email"></td>
        <td class="action">
            <button class="btn edit" title="Editer"><img src="icons/pencil.svg"></button>
            <button class="btn delete" title="Supprimer"><img src="icons/trash.svg"></button>
            <button class="btn add" title="Ajouter une commande au client"><img src="icons/plus.svg"></button>
            <button class="btn liste" title="liste des  commandes du client"><img src="icons/list-task.svg"></button>

        </td>
    </tr>
</template>

<dialog class='dialog' id="dialog">
    <h2 class="h">Formulaire des Clients</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form">
            <input type="hidden" name="id" class="id">
            <input type="hidden" name="edit" class="edit">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" class="nom" name="nom" id="name" placeholder="Entrer le nom">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" class="adresse" name="adresse" id="adresse" placeholder="Entrer le prix">
            </div>
            <div class="form-group">
                <label for="tel">Téléphone :</label>
                <input type="tel" name="tel" placeholder="Entrer le Numero" class="tel">
            </div>
            <div class="form-group">
                <label for="name">Email :</label>
                <input type="email" name="email" placeholder="Entrer l'Email" class="email">

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
    <h2 class="h">Liste des Commandes du client</h2>
    <div class="dialog-body">
        <table class="table striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Delai</th>
                    <th>Client</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <p class="message h"></p>
    </div>
    <div class="right"><button class="btn danger" id="ferme">fermer</button></div>
</dialog>


<template id="liste-row">
    <tr>
        <td class="id"></td>
        <td class="date"></td>
        <td class="delai"></td>
        <td class="client"></td>
        <td class="action">
            <!--             <button class="btn add" title="Ajouter un article à cette commande"><img src="icons/plus.svg"></button>
 --> <button class="btn liste" title="liste des article pour cette commande"><img src="icons/list-task.svg"></button>

        </td>
    </tr>
</template>

<dialog class="dialog" id="liste2">
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
    <div class="right"><button class="btn danger" id="ferme2">Fermer</button></div>
</dialog>

<template id="liste-row2">
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


<dialog class='dialog' id="dialog2">
    <h2 class="h">Formulaire des Commandes</h2>
    <div class="dialog-body">
        <form action="" class="form" id="form2">
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
                    <option value=""></option>
                </select>
                <div class="form-group">
                    <button class="btn default" type="reset">Annuler</button>
                    <button class="btn success" type="submit">Enrégistrer</button>
                </div>
            </div>
        </form>
    </div>
    <div class="right"><button class="btn danger" id="close2">Fermer</button></div>
</dialog>

<script>
    const add = document.getElementById('add');
    const close = document.getElementById('close');
    const close2 = document.getElementById('close2');
    const ferme = document.getElementById('ferme');
    const ferme2 = document.getElementById('ferme2');
    const dialog = document.getElementById('dialog');
    const dialog2 = document.getElementById('dialog2');
    const liste = document.getElementById('liste');
    const liste2 = document.getElementById('liste2');
    const form = document.getElementById('form');
    const form2 = document.getElementById('form2');
    const tbody = document.querySelector('tbody');
    let data = []
    let alldata = []
    let node = null
    const paramettre = {
        trie: "asc",
        triant: "idClient",
        val: null,

    }

    const bc = new BroadcastChannel("client")
    bc.onmessage = async function(e) {
        await fetchData("?p=api/client/find", getAllData)
        await changeTbody()
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
            idClient,
            nomClient,
            adresseClient,
            telClient,
            emailClient,

        } = data
        tr.querySelector(".id").innerText = idClient
        tr.querySelector(".nom").innerText = nomClient
        tr.querySelector(".adresse").innerText = adresseClient
        tr.querySelector(".tel").innerText = telClient
        tr.querySelector(".email").innerText = emailClient
        tr.querySelector(".action").dataset.id = idClient
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

    async function changeTbody() {
        tbody.innerHTML = ""
        const {
            trie,
            triant,
            val
        } = paramettre
        if (alldata.length === 0) await fetchData("?p=api/client/find", getAllData)
        let elements = alldata

        if (val) elements = elements.filter(elmt => {
            return elmt.idClient.toString().includes(val) ||
                elmt.nomClient.toUpperCase().includes(val.toUpperCase()) ||
                elmt.adresseClient.toUpperCase().includes(val.toUpperCase()) ||
                elmt.telClient.toUpperCase().includes(val.toUpperCase()) ||
                elmt.emailClient.toUpperCase().includes(val.toUpperCase())
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
        await fetchData("?p=api/client/find", getAllData)
        Actionlistener()

    }

    add.addEventListener('click', function(e) {
        form.querySelector(".edit").value = null
        form.querySelector(".id").value = null
        form.querySelector(".nom").value = null
        form.querySelector(".adresse").value = null
        form.querySelector(".tel").value = null
        form.querySelector(".email").value = null
        dialog.showModal()
    })

    close.addEventListener('click', function(e) {
        dialog.close()
    })

    close2.addEventListener('click', function(e) {
        dialog2.close()
    })

    ferme.addEventListener('click', function(e) {
        liste.close()
    })

    ferme2.addEventListener('click', function(e) {
        liste2.close()
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
            adresse: {
                value: adresse
            },
            tel: {
                value: tel
            },
            email: {
                value: email
            },
        } = this

        let dt = {
            edit: edit,
            id: id,
            nom: nom,
            adresse: adresse,
            tel: tel,
            email: email,
        }
        dt = JSON.stringify(dt)
        if (edit) {
            if (!confirm("Voulez vous modifier cet élément?")) {
                dialog.close()
                return
            }
        }

        const url = edit ? `?p=api/client/edit/${id}&data=${dt}` : `?p=api/client/insert&data=${dt}`
        await fetchData(url, getData)
        dialog.close()

        if (!(data.idClient ?? null)) return
        const tr = constructRow(data)
        if (edit) {
            tbody.replaceChild(tr, node)
        } else {
            tbody.append(tr)
        }
        bc.postMessage("submit")
        await fetchData("?p=api/client/find", getAllData)
        Actionlistener()
    })

    form2.addEventListener('submit', async function(e) {
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
        const url = `?p=api/commande/insert&data=${dt}`
        await fetchData(url, getData)
        dialog2.close()
        if (data.idClient ?? null) {
            const id = data.idClient
            showListe(id)
        }
    })

    function Actionlistener() {
        const deletes = document.querySelectorAll('.delete')
        deletes.forEach(elmt => {
            elmt.addEventListener('click', async function(e) {
                const id = this.parentNode.dataset.id
                if (confirm("voulez supprimer cet élément")) {
                    await fetchData(`?p=api/client/delete/${id}`, getData)
                    const tr = this.parentNode.parentNode
                    tr.classList.add("removed")
                    setTimeout(() => {
                        if (data.res ?? null) tr.remove()
                    }, 500);
                    bc.postMessage("delete")
                }
            })
        });

        const edits = document.querySelectorAll('.edit')
        edits.forEach(edit => {
            edit.addEventListener('click', async function(e) {
                const id = this.parentNode.dataset.id
                node = this.parentNode.parentNode

                if (alldata.length === 0) await fetchData("?p=api/client/find", getAllData)
                const data = alldata.filter(elmt => {
                    return elmt.idClient == id
                })
                const {
                    nomClient,
                    adresseClient,
                    telClient,
                    emailClient,

                } = data[0]
                form.querySelector(".edit").value = true
                form.querySelector(".id").value = id
                form.querySelector(".nom").value = nomClient
                form.querySelector(".adresse").value = adresseClient
                form.querySelector(".tel").value = telClient
                form.querySelector(".email").value = emailClient

                dialog.showModal()
            })
        });

        const adds = tbody.querySelectorAll('.add')
        adds.forEach(element => {
            element.addEventListener('click', async function(e) {
                form2.reset()
                const id = this.parentNode.dataset.id
                await fetchData(`?p=api/client/find/${id}`, getData)
                const select = form2.querySelector(".client")
                const opt = select.querySelector("option")
                opt.value = id
                opt.innerText = data.nomClient

                dialog2.showModal()
            })
        });




        const show = tbody.querySelectorAll('.liste')
        show.forEach(add => {
            add.addEventListener('click', async function(e) {
                const id = this.parentNode.dataset.id
                showListe(id)
            })
        });

    }
    async function showListe(id) {
        const url = `?p=api/commande/match/${id}`
        await fetchData(url, getData)
        const tbodylist = liste.querySelector("tbody")
        tbodylist.innerHTML = ""
        if (data.length === 0 || !(data.res ?? true)) {
            alert("Pas de Commande disponible pour ce Client!")
            return
        }
        data.forEach(element => {
            const listeRow = document.getElementById('liste-row').content.cloneNode(true);
            const {
                idCommande,
                dateCommande,
                delaiCommande,
                nomClient
            } = element
            listeRow.querySelector(".id").innerText = idCommande
            listeRow.querySelector(".date").innerText = dateCommande
            listeRow.querySelector(".delai").innerText = delaiCommande
            listeRow.querySelector(".client").innerText = nomClient
            listeRow.querySelector(".action").dataset.id = idCommande
            tbodylist.append(listeRow)

        });
        liste.showModal()
        const listes = tbodylist.querySelectorAll(".liste")
        listes.forEach(element => {
            element.addEventListener('click', function(e) {
                const id = this.parentNode.dataset.id
                affiche(id)
            })
        });
    }
    async function affiche(id) {
        await fetchData(`?p=api/vente/match/${id}`, getData)

        const tb = liste2.querySelector("tbody")
        const p = liste2.querySelector("p")
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
            liste2.querySelector(".totaux").innerText = total
        } else p.innerText = "Pas d'article dans cette commande"
        liste2.showModal()
    }

    function constructListRow(data) {
        const row = document.getElementById('liste-row2');
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
    Actionlistener()
</script>