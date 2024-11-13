/*
 * version 1 remove li element when clicked this runs only for created li elements
 */
const liItems = document.querySelectorAll('li');
liItems.forEach(item => {
    console.log(item.innerText);
    item.addEventListener('click', event => {
        console.log(event.target.innerText);
        item.remove();
    })
})

/*
 * add li element when addButton clicked take input from input field
 */
const addButton = document.querySelector('#add');
const newItem = document.querySelector('input');

addButton.addEventListener('click', (event) => {
    // vytvoríme nový li element bez jeho umiestnenia v DOM
    const li = document.createElement('li');
    console.log(newItem.value);

    // pridáme text do li elementu
    li.innerText = newItem.value;

    // umiestnime li element do zoznamu ul na koniec
    ul.append(li);

    // vyprádnime input field
    newItem.value = '';
});

/*
 * event bubbling demonstration
 * version 2 remove li element when clicked which takes also newli created li elements
 */
// const ul = document.querySelector('ul');
//
// ul.addEventListener('click', event => {
//     console.log(event.target.innerText);
//     event.target.remove();
// });

/**
 * switch input type between text and password
 */
let swichElement = document.querySelector('#switch');
let passwordInput = document.querySelector('#loginPassword');

swichElement.addEventListener('click', event => {

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});

passwordInput.addEventListener('input', event => {
    console.log(event.target.value);

    // check password length and toggle class
    if (event.target.value.length > 8) {
        event.target.classList.add('valid');
        event.target.classList.remove('invalid');
    } else {
        event.target.classList.remove('valid');
        event.target.classList.add('invalid');
    }
});