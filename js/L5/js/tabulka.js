let people;
console.log(people);

people = [
    {
        name: 'Peter',
        surName: 'Fazuľka'
    }
];
console.log(people);

people.push({
    name: 'Jožko',
    surName: 'Mrkvicka'
});
console.log(people);

let newline;

let tableElement = document.getElementById('peopleTable');
let tableBody = tableElement.getElementsByTagName('tbody')[0];

console.log(tableElement);
console.log(tableBody);

// template string example
people.forEach(person => {
    newline = `<tr><td>${person.name}</td><td>${person.surName}</td></tr>`;
    console.log(newline);
    tableBody.innerHTML += newline;
});