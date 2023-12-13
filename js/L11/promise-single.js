/*
* callbacks
*/
const getRemoteData = function (sourceURL, callback) {

    return new Promise((resolve, reject) => {

        const request = new XMLHttpRequest();
        request.addEventListener('readystatechange', () => {
            // console.log('REQUEST', request.readyState, request.status, request)
            if (request.readyState == 4 && request.status == 200) {
                console.log(request.getAllResponseHeaders());
                let responseData = JSON.parse(request.responseText);

                // volanie všetko je v cajku
                resolve(responseData);
            } else if (request.readyState == 4) {
                reject('Nieč nezahralo ako sme čakali');
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
            //console.log(newLi);
            list.innerHTML += (newLi);
        });

        return getRemoteData('https://jsonplaceholder.typicode.com/albums');
    })
    .then(responseData => {
        responseData.forEach(element => {
            newLi = `<li>Album: <h2>${element.title}</h2><ul id="album-${element.id}"></ul></li>`
            userid = '#user-' + element.userId;
            document.querySelector(userid).innerHTML += (newLi);
        });

        return getRemoteData('https://jsonplaceholder.typicode.com/photos');
    }).then(responseData => {
            responseData.forEach(element => {
                newLi = `<li>Photo: <h2>${element.title}</h2><img src="${element.thumbnailUrl}" /></li>`
                albumid = '#album-' + element.albumId;
                console.log(albumid);
                document.querySelector(albumid).innerHTML += (newLi);
            });
        })
    .catch(error => {
        console.log(error);
    });



