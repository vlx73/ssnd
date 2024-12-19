/**
 * declare function that reads data from a server and calls a callback function with the data
 */
function getUsers(callback) {
    const request = new XMLHttpRequest();

    // listener for request state change event is generated multiple times
    request.addEventListener('readystatechange', () => {
        console.log('REQUEST readySate: ' + request.readyState + ' http status: ' + request.status, request);

        // check if request is done and status is OK done means readyState 4
        if (request.readyState === 4 && request.status === 200) {
            console.log('Serialized data (JSON): ', request.responseText);
            let responseData = JSON.parse(request.responseText);
            callback(responseData);
        } else {
            // request is not done yet
            console.log('Not done yet');
        }
    });

    // configure request GET and the URL
    request.open('GET', 'https://jsonplaceholder.typicode.com/users');

    // send request
    request.send();
}

/**
 * rendering user data to html
 */
function RenderUser(responseData) {
    // select list element
    const list = document.querySelector('ul');

    // add new li to list using template string
    responseData.forEach(element => {
        newLi = `<li>${element.address.street}</li>`
        console.log(newLi);
        list.innerHTML += (newLi);
    });
}


/**
 * Demonstrate the use of the getUsers function
 */

// listener for load button
const loadButton = document.querySelector('#load');
loadButton.addEventListener('click', event => {
    getUsers(RenderUser);
});

