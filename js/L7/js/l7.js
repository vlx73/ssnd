// document.addEventListener('readystatechange', (event) => {
//     console.log('readystatechange event',event);
//     console.log(event.target.readyState);

//     if(event.target.readyState === 'complete'){
//         initApp();
//     }
// })

// const initApp = () => {
// const div = document.querySelector('div');

// div.addEventListener('click',(e) => {
//     console.log(e);
//     e.target.textContent === 'clicked' ?
//     e.target.textContent = 'title' :
//     e.target.textContent = 'clicked';
// });
// }

const addButton = document.querySelector('#add');
const newItem = document.querySelector('input');
const ul = document.querySelector('ul');

console.log(newItem.value);



/*
 * version 1 remove li element when clicked this runs only for created li elements
 */
// const items = document.querySelectorAll('li');
// items.forEach((item) => {
//     console.log(item.innerText);
//     item.addEventListener('click',(event)=> {
//         console.log(event.target.innerText);
//         item.remove();
//     })
// })


/*
 * add li element when addButton clicked take input from input field
 */
addButton.addEventListener('click',(event)=>{
    const li = document.createElement('li');
    console.log(newItem.value);

    li.innerText = newItem.value;
    ul.append(li);
});

/*
 * event bubbling demonstration
 * version 2 remove li element when clicked which takes also newli created li elements
 */
ul.addEventListener('click', (event) => {
console.log(event.target.innerText);
        event.target.remove();
});




