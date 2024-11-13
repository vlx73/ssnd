/*
 * demo for XMLHttpRequest
 */
const getUsers = function (callback) {
    const request = new XMLHttpRequest();

    request.addEventListener('readystatechange', () => {
        console.log('REQUEST readySate: ' + request.readyState + ' http status: ' + request.status, request);

        if (request.readyState === 4 && request.status === 200) {
            console.log('Serialized data (JSON): ', request.responseText);
            let responseData = JSON.parse(request.responseText);
            callback(responseData);
        } else {
            console.log('Not done yet');
        }
    });

    request.open('GET', 'https://jsonplaceholder.typicode.com/users');
    request.send();
}

/*
 * Volanie funkcie getUsers s callbackom
 */

// listener for load button
const loadButton = document.querySelector('#load');
loadButton.addEventListener('click', event => {
    getUsers(responseData => {
        console.log('RESPONSE data: ', responseData);

        list = document.querySelector('ul');

        // add new li to list
        responseData.forEach(element => {
            newLi = `<li>${element.address.street}</li>`
            console.log(newLi);
            list.innerHTML += (newLi);
        });
    });
});

