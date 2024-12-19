/**
 * v ideálnom synchronnom svete by sme mohli získať dáta z nejakej vzdialenej lokácie
 * @param sourceUrl
 */
function getRemoteData(sourceUrl) {
    let respoonse = fetch(sourceUrl);
    let data = respoonse.json();

    return data;
}

/**
 * v reálnom svete môžeme asynchrónnosť posunúť do funkcie
 */
// async function getRemoteData(sourceUrl) {
//     let response = await fetch(sourceUrl);
//     let data = await response.json();
//
//     return data;
// }
//
//
// getRemoteData('https://jsonplaceholder.typicode.com/users')
//     .then(data => {
//         // dostali sme data tak ich môžeme vyrenderovať
//         const ul = document.querySelector('ul');
//         data.forEach(user => {
//             let li = document.createElement('li');
//             li.textContent = user.name;
//             ul.appendChild(li);
//         })
//     })
//     .catch(error => {
//         console.log(error);
//     });