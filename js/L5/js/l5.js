// function declaration type 1 - named function
function myFunction() {
    console.log('myFunction');
}

// function declaration type 2 - anonymous function
const myFunction2 = function () {
    console.log('myFunction2');
}

// function declaration type 3 - arrow function
const myFunction3 = () => {
    console.log('myFunction3');
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

console.log(people);

// add person to array
people.push(newPerson);
people.push(otherPerson);
console.log(people);


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

    newRow = ` <tr>
        <td>${person.surName}</td>
        <td>${person.name}</td>
    </tr>`;

    const tableBody = table.getElementsByTagName('tbody');
    tableBody[0].innerHTML += newRow;

}

// changeTitle();
const changeTitle = (newTitle) => {
    const title = document.querySelector('#title_id');
    title.innerHTML = newTitle;
}