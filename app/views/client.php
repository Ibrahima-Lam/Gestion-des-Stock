<h1 class="heading">Les Clients</h1>

<?php
$title = "Clients";
$clients = $clients ?? [];

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
        triant: "idClient",
        val: null,

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
        form.querySelector(".adresse").value = null
        form.querySelector(".tel").value = null
        form.querySelector(".email").value = null
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

        await fetchData("?p=api/client/find", getAllData)
        Actionlistener()
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
    }

    Actionlistener()
</script>