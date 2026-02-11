/**
 * Funkcia pre ziskanie vzdialenych dat
 * @param sourceURL
 * @param callback - funkcia ktorá sa zavolá po zmene stavu requestu - jej prvý parameter je boolean stav, druhý je response data
 */
const getRemoteData = function (sourceURL, callback) {
    const request = new XMLHttpRequest();

    request.addEventListener('readystatechange', () => {
        if (request.readyState === 4 && request.status === 200) {
            let responseData = JSON.parse(request.responseText);

            // volanie callback funkcie
            callback(false, responseData);
        } else if (request.readyState === 4) {
            callback(true, 'Status NOK');
            //    console.log('IN PROGRESS');
        }
    });

    request.open('GET', sourceURL);
    request.send();
}

/**
 * Volanie funkcie getRemoteData s callbackom - a postupné vnáranie callbackov
 */

// level 1 - get users
getRemoteData('https://jsonplaceholder.typicode.com/users', (error, responseData) => {

    if (error) {
        console.log(responseData);
    } else {
        const usersUl = document.querySelector('#users');

        // render user data
        responseData.forEach(user => {
            let newLi = `<li>User: <h2>${user.address.street}</h2><ul id="user-${user.id}"></ul></li>`
            usersUl.innerHTML += (newLi);
        });

        // level 2 - get albums
        getRemoteData('https://jsonplaceholder.typicode.com/albums', (error, responseData) => {
            if (error) {
                console.log(responseData);
            } else {
                // render album data
                responseData.forEach(album => {
                    let newLi = `<li>Album: <h3>${album.title}</h3><ul id="album-${album.id}"></ul></li>`
                    let userListId = '#user-' + album.userId;

                    document.querySelector(userListId).innerHTML += (newLi);
                });

                // level 3 - get photos
                getRemoteData('https://jsonplaceholder.typicode.com/photos', (error, responseData) => {

                    if (error) {
                        console.log(responseData);
                    } else {
                        // render photo data
                        responseData.forEach(photo => {
                            let newLi = `<li>${photo.title}<img src="${photo.thumbnailUrl}" /></li>`;
                            let albumlistId = '#album-' + photo.albumId;
                            document.querySelector(albumlistId).innerHTML += (newLi);
                        });
                    }
                });
            }
        });
    }
});
