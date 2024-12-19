fetch('https://jsonplaceholder.typicode.com/users')
    .then(response => {
        // dostali sme data ale ešte sú vo formáte RESPONSE
        console.log('Resolved: ', response);

        // musíme si ošetreni HTTP status
        console.log('HTTP response status: '.response.status);

        // prevedieme response na JSON čo je opäť asynchrónna operácia
        if (response.status === 200) {
            return response.json();
        } else {
            // ak je status iný ako 200, tak vyvoláme chybu
            throw new Error('Unable to fetch data');
        }
    })
    .then(data => {
        console.log(data);

        // už máme vyčistené data a môžeme ich vyrenderovať
        const ul = document.querySelector('ul');
        data.forEach(user => {
            let li = document.createElement('li');
            li.textContent = user.name;
            ul.appendChild(li);
        })
    })
    .catch(errorData => {
        // iba ak je nemožné spraviť request - DNS, network, ...
        console.log('Rejected: ', errorData);
    })
