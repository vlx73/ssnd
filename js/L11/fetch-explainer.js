
fetch('https://jsonplaceholder.typicode.com/users')
    .then(response => {
        console.log('Resolved: ', response);
        return response.json();
    })
    .then(data => {
        console.log(data);
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
