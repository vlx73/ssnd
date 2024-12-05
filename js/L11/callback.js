/*
* callbacks
*/
const getRemoteData = function (endpoint, callback) {
   // console.log('endpoint: ', endpoint);
    const request = new XMLHttpRequest();

    request.addEventListener('readystatechange', () => {
        // console.log('REQUEST', request.readyState, request.status, request)
        if (request.readyState === 4 && request.status === 200) {
            console.log('Odpoveď OK: ', request);
            let responseData = JSON.parse(request.responseText);
//            console.log(responseData);

            // // volanie callback funkcie
            callback(undefined, responseData);

        } else if (request.readyState === 4) {
            console.log('Odpoveď: ', request);

            callback('Status NOK', undefined);
            //    console.log('IN PROGRESS');
        }
    });

    request.open('GET', endpoint);
    request.send();
}

getRemoteData('https://jsonplaceholder.typicode.com/users', (error, responseData) => {

    console.log(error,responseData);
    if (error) {
        console.log(error);
    } else {
        list = document.querySelector('#users');

        // render user data
        responseData.forEach(element => {
            newLi = `<li>User: <h2>${element.address.street}</h2><ul id="user-${element.id}"></ul></li>`
            list.innerHTML += (newLi);
        });

        // get albums
        getRemoteData('https://jsonplaceholder.typicode.com/albums', (error, responseData) => {
            if (error) {
                console.log(error);
            } else {
                // render album data
                responseData.forEach(element => {
                    newLi = `<li>Album: <h3>${element.title}</h3><ul id="album-${element.id}"></ul></li>`

                    userListId = '#user-' + element.userId;
                    document.querySelector(userListId).innerHTML += (newLi);
                });
            }
        });

        // get photos
        getRemoteData('https://jsonplaceholder.typicode.com/photos', (error, responseData) => {

            if (error) {
                console.log(error);
            } else {
                // render photo data
                responseData.forEach(element => {
                    newLi = `<li>${element.title}<img src="${element.thumbnailUrl}" /></li>`;
                    albumlistId = '#album-' + element.albumId;

                    document.querySelector(albumlistId).innerHTML += (newLi);
                });
            }
        });
    }
});
