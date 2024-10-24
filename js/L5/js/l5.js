let myArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

myArray.forEach(function (prvokPola) {
    console.log(prvokPola ** 2);
});


// function declaration type 1 - named function
function myFunction(param1, param2) {
    console.log('myFunction');
    console.log(param1 + param2);

    return param1 + param2;
}

myFunction(1, 2);

// function declaration type 2 - anonymous function
const myFunction2 = function (param1, param2) {
    console.log('myFunction2');
    console.log(param1 - param2);

    return param1 - param2;
}

myFunction2(5, 3);

// function declaration type 3 - arrow function
const myFunction3 = (param1, param2) => {
    console.log('myFunction3');
    console.log(param1 * param2);

    return param1 * param2;
}

// example arrow function with one parameter and one line of code
const myFunctionX = param1 => console.log('myFunctionX');

const myFunction5 = param1 => {
    console.log('myFunction5');
}

// calling of callback function
function myFunction4(callback) {
    console.log('myFunction4');
    callback();
}

// calling of functions
myFunction();
myFunction2();
myFunction3();
myFunction4(myFunction);

// template string example
let firstName = 'Janko';
let templateString = `Moje meno je ${firstName}`;

console.log(firstName);
console.log(templateString);

// object declaration 1 - literal
let newPerson = {
    'name': 'Peter',
    'surName': 'Fazuľka'
}

// object declaration 2 - constructor
let otherPerson = new Object();
otherPerson.name = 'Janko';
otherPerson.surName = 'Hraško';


console.log(newPerson);
console.log(newPerson.surName);
console.log(otherPerson);

// array of object 1 item
let people = [{
    'name': 'Jožko',
    'surName': 'Mrkvička'
}];
console.log('People 1:', people);

// add person to array
people.push(newPerson);
people.push(otherPerson);
console.log('People 2:', people);


// callable function for adding person to table
people.forEach(
    person => {
        addPersonbB(person);
    }
);

function addPersonbB(otherPerson) {
    const table = document.getElementById("peopleTable");

    console.log(table);
    console.log(table.rows.length);

    let newRow = `<tr>
        <td>${otherPerson.surName}</td>
        <td>${otherPerson.name}</td>
    </tr>`;

    const tableBody = table.getElementsByTagName('tbody');
    tableBody[0].innerHTML += newRow;

}

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
