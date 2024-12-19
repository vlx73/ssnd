/*
* callbacks
*/
const getRemoteData = function (sourceURL) {

    return new Promise((resolve, reject) => {
        const request = new XMLHttpRequest();

        request.addEventListener('readystatechange', () => {
            //console.log('REQUEST', request.readyState, request.status, request)
            if (request.readyState == 4 && request.status == 200) {
                //console.log(request.getAllResponseHeaders());
                let responseData = JSON.parse(request.responseText);

                // volanie callback funkcie
                resolve(responseData);

            } else if (request.readyState == 4) {
                reject('Status NOK');
                //    console.log('IN PROGRESS');
            }
        });

        request.open('GET', sourceURL);
        request.send();
    });


}

getRemoteData('https://jsonplaceholder.typicode.com/users')
    .then(responseData => {
        list = document.querySelector('#users');
        responseData.forEach(element => {
            newLi = `<li>User: <h2>${element.address.street}</h2><ul id="user-${element.id}"></ul></li>`
            list.innerHTML += (newLi);
        });

        return getRemoteData('https://jsonplaceholder.typicode.com/albums');
    }).then(responseData => {
        responseData.forEach(element => {
            newLi = `<li>Album: <h3>${element.title}</h3><ul id="album-${element.id}"></ul></li>`
            userListId = '#user-' + element.userId;
            document.querySelector(userListId).innerHTML += (newLi);
        });

        return getRemoteData('https://jsonplaceholder.typicode.com/photos');
    }).then(responseData => {
        responseData.forEach(element => {
            newLi = `<li>${element.title}<img src="${element.thumbnailUrl}" /></li>`;
            albumlistId = '#album-' + element.albumId;
            document.querySelector(albumlistId).innerHTML += (newLi);
        });
    })
    .catch((error) => {
        console.log(error);
    });
