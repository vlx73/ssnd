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

getRemoteData('https://jsonplaceholder.typicode.com/users')
    .then(responseData => {
        const userUl = document.querySelector('#users');

        // responseData je pole objektov user
        responseData.forEach(user => {
            let newLi = `<li>User: <h2>${user.address.street}</h2><ul id="user-${user.id}"></ul></li>`
            userUl.innerHTML += (newLi);
        });

        // po načítaní userov načítame ďalšie dáta - albumy - vracia mi to opäť Promise
        return getRemoteData('https://jsonplaceholder.typicode.com/albums');
    })
    .then(responseData => {

        // responseData je pole objektov album
        responseData.forEach(album => {
            let newLi = `<li>Album: <h3>${album.title}</h3><ul id="album-${album.id}"></ul></li>`
            let userListId = '#user-' + album.userId;
            document.querySelector(userListId).innerHTML += (newLi);
        });

        // po načítaní albumov načítame ďalšie dáta - fotky - vracia mi to opäť Promise
        return getRemoteData('https://jsonplaceholder.typicode.com/photos');
    })
    .then(responseData => {

        // responseData je pole objektov photo
        responseData.forEach(photo => {
            let newLi = `<li>${photo.title}<img src="${photo.thumbnailUrl}" /></li>`;
            let albumlistId = '#album-' + photo.albumId;
            document.querySelector(albumlistId).innerHTML += (newLi);
        });
    })
    .catch((error) => {
        console.log(error);
    });

/**
 * Takto to vyzeralo predtým
 */
// getRemoteData('https://jsonplaceholder.typicode.com/users', (error, responseData) => {
//
//     if (error) {
//         console.log(responseData);
//     } else {
//         const usersUl = document.querySelector('#users');
//
//         // render user data
//         responseData.forEach(user => {
//             let newLi = `<li>User: <h2>${user.address.street}</h2><ul id="user-${user.id}"></ul></li>`
//             usersUl.innerHTML += (newLi);
//         });
//
//         // level 2 - get albums
//         getRemoteData('https://jsonplaceholder.typicode.com/albums', (error, responseData) => {
//             if (error) {
//                 console.log(responseData);
//             } else {
//                 // render album data
//                 responseData.forEach(album => {
//                     let newLi = `<li>Album: <h3>${album.title}</h3><ul id="album-${album.id}"></ul></li>`
//                     let userListId = '#user-' + album.userId;
//
//                     document.querySelector(userListId).innerHTML += (newLi);
//                 });
//
//                 // level 3 - get photos
//                 getRemoteData('https://jsonplaceholder.typicode.com/photos', (error, responseData) => {
//
//                     if (error) {
//                         console.log(responseData);
//                     } else {
//                         // render photo data
//                         responseData.forEach(photo => {
//                             let newLi = `<li>${photo.title}<img src="${photo.thumbnailUrl}" /></li>`;
//                             let albumlistId = '#album-' + photo.albumId;
//                             document.querySelector(albumlistId).innerHTML += (newLi);
//                         });
//                     }
//                 });
//             }
//         });
//     }
// });