
fetch('https://jsonplaceholder.typicode.com/users')
    .then(response => {
        // dostali sme data ale ešte sú vo formáte RESPONSE
        console.log('Resolved: ', response);

        // prevedieme response na JSON čo je opäť asynchrónna operácia
        return response.json();
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
