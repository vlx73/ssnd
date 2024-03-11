
fetch('https://jsonplaceholder.typicode.com/users')
    .then(response => {
        console.log('Resolved: ', response);
        return response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(errorData => {
        // iba ak je nemožné spraviť request - DNS, network, ...
        console.log('Rejected: ', errorData);
    })
