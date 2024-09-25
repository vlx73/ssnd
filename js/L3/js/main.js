const ulElement = document.getElementsByTagName('ul');
console.log(ulElement);

const ulNode = document.querySelector('ul');
console.log(ulNode);

// načítame node identifikovaný id
const secondLi = document.querySelector('#li2');
console.log(secondLi);

// načítame rodiča
const parentUl = secondLi.parentNode;
console.log(parentUl);

// načítame nasledujúceho súrodenca
const nextLi = secondLi.nextElementSibling;
console.log(nextLi);

// načítame predchádzajúceho súrodenca
const previousLi = secondLi.previousElementSibling;
console.log(previousLi);