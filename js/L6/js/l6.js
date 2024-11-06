// ukážka query selectora
let para = document.querySelectorAll('body > div > p:nth-child(1)');
console.log(para);

// ukážka atribútu innerHTML objektu div element
let other = document.querySelector('div');
console.log(other.innerHTML);

// zmeníme obsah elementu div
other.innerHTML += '<h2>YEAP</hw>';
console.log(other.innerHTML);

// ukážka práce s atribútom style objektu elementu


para.style.color = 'green';
para.classList.add('active');
console.log(para.classList);

para.classList.remove('error');
console.log(para.classList);

para.classList.toggle('error');
console.log(para.classList);

para.classList.toggle('error');
console.log(para.classList);


// changeTitle();
const changeTitle = (newTitle) => {
    const title = document.querySelector('#title_id');
    title.innerHTML = newTitle;
}

let table = document.querySelector('#peopleTable');
console.log(table);

let tableLines = table.querySelectorAll('tr');
console.log(tableLines);


document.querySelector("button").addEventListener(
    "click",
    function () {
        alert("Button was clicked!");
    }
);


document.querySelector("button").addEventListener(
    "click",
    event => alert("Button was clicked!")
);