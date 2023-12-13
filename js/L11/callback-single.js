/*
* callbacks
*/
const getRemoteData = function (sourceURL, callback) {
    const request = new XMLHttpRequest();

    request.addEventListener('readystatechange', () => {
        // console.log('REQUEST', request.readyState, request.status, request)
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.getAllResponseHeaders());
            let responseData = JSON.parse(request.responseText);

            // volanie callback funkcie
            callback(undefined, responseData);

        } else if (request.readyState == 4) {
            callback('Status NOK', undefined);
            //    console.log('IN PROGRESS');
        }
    });

    request.open('GET', sourceURL);
    request.send();
}


getRemoteData('https://jsonplaceholder.typicode.com/users', (error, responseData) => {

    if (error) {
        console.log(error);
    } else {
        //  console.log('RESPONSE', responseData);
        list = document.querySelector('#users');
        console.log(list);

        responseData.forEach(element => {
            newLi = `<li>User: <h2>${element.address.street}</h2><ul id="user-${element.id}"></ul></li>`
            //console.log(newLi);
            list.innerHTML += (newLi);
        });

        getRemoteData('https://jsonplaceholder.typicode.com/albums', (error, responseData) => {
            if (error) {
                console.log(error);
            } else {
                //console.log('RESPONSE', responseData);

                responseData.forEach(element => {
                    console.log(element);

                    newLi = `<li>Album: <h3>${element.title}</h3><ul id="album-${element.id}"></ul></li>`
//                    console.log(newLi);

                    userListId = '#user-' + element.userId;
                   console.log(userListId);

                    document.querySelector(userListId).innerHTML += (newLi);
                });
            }
            });

                getRemoteData('https://jsonplaceholder.typicode.com/photos', (error, responseData) => {

                    if (error) {
                        console.log(error);
                    } else {
                      //  console.log('RESPONSE', responseData);

                        responseData.forEach(element => {
                            newLi = `<li>${element.title}<img src="${element.thumbnailUrl}" /></li>`;
                            // console.log(newLi);

                            albumlistId = '#album-' + element.albumId;
                          //  console.log(albumlistId);

                            document.querySelector(albumlistId).innerHTML += (newLi);
                        });
                    }
                });
    }
});
