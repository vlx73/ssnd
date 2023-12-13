


const getUsers = function (callback) {
    const request = new XMLHttpRequest();

    request.addEventListener('readystatechange', () => {
        console.log('REQUEST',request.readyState, request.status,request)
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.getAllResponseHeaders());
            let responseData = JSON.parse(request.responseText);
            callback(responseData);
        } else {
            console.log('IN PROGRESS');
        }
    });

    request.open('GET', 'https://cdn.exodusreport.video/podcast/episodes/ER_002.mp3');
    request.send();
}


getUsers((responseData) => {
    console.log('RESPONSE', responseData);
    list = document.querySelector('ul');
    console.log(list);

    responseData.forEach(element => {
        newLi = `<li>${element.address.street}</li>`
        console.log(newLi);
        list.innerHTML += (newLi);
    });
});
