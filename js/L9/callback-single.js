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
 * Volanie funkcie getRemoteData s callbackom - načítanie userov a ošetrenie chybového stavu
 */
getRemoteData('https://jsonplaceholder.typicode.com/users', (error, responseData) => {

    if (error) {
        console.log(data);
    } else {
        const ul = document.querySelector('#users');

        responseData.forEach(element => {
            let newLi = `<li>User: <h2>${element.address.street}</h2><ul id="user-${element.id}"></ul></li>`
            ul.innerHTML += (newLi);
        });
    }
});
