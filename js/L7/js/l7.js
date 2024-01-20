/*
 * version 1 remove li element when clicked this runs only for created li elements
 */
// const liItems = document.querySelectorAll('li');
// liItems.forEach( item => {
//     console.log(item.innerText);
//     item.addEventListener('click',event=> {
//         console.log(event.target.innerText);
//         item.remove();
//     })
// })


/*
 * add li element when addButton clicked take input from input field
 */
const addButton = document.querySelector('#add');
const newItem = document.querySelector('input');

addButton.addEventListener('click',(event)=>{
    const li = document.createElement('li');
    console.log(newItem.value);

    li.innerText = newItem.value;
    ul.append(li);
    newItem.value = '';
});

/*
 * event bubbling demonstration
 * version 2 remove li element when clicked which takes also newli created li elements
 */
const ul = document.querySelector('ul');

ul.addEventListener('click', event => {
    console.log(event.target.innerText);
    event.target.remove();
});