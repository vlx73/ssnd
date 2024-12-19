/**
 * Funkcia na získanie dát z vzdialeného zdroja použitím Promise
 *
 * @param sourceURL
 * @param callback
 * @returns {Promise<unknown>}
 */
const getRemoteData = function (sourceURL, callback) {

    return new Promise((resolveFunction, rejectFunction) => {
        const request = new XMLHttpRequest();

        request.addEventListener('readystatechange', () => {

            if (request.readyState === 4 && request.status === 200) {
                let responseData = JSON.parse(request.responseText);

                // callback pre stav OK
                resolveFunction(responseData);
            } else if (request.readyState === 4) {

                // callback pre stav NOT OK
                rejectFunction('Nieč nezahralo ako sme čakali');
            }
        });

        request.open('GET', sourceURL);
        request.send();
    });
}

/**
 * Získanie dát o používateľoch
 */
getRemoteData('https://jsonplaceholder.typicode.com/users')
    .then(responseData => {
        const usersUl = document.querySelector('#users');

        responseData.forEach(user => {
            newLi = `<li>User: <h2>${user.address.street}</h2><ul id="user-${user.id}"></ul></li>`
            usersUl.innerHTML += (newLi);
        });
    })
    .catch(error => {
        console.log(error);
    });


/**
 * Takto to vyzeralo predtým
 */
// getRemoteData('https://jsonplaceholder.typicode.com/users', (error, responseData) => {
//
//     if (error) {
//         console.log(data);
//     } else {
//         const ul = document.querySelector('#users');
//
//         responseData.forEach(element => {
//             let newLi = `<li>User: <h2>${element.address.street}</h2><ul id="user-${element.id}"></ul></li>`
//             ul.innerHTML += (newLi);
//         });
//     }
// });