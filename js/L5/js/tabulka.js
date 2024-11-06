// deklarácia premennej people
let people;
console.log(people);

// inicializácia premennej ako poľa objektov s jedným prvkom
people = [
    {
        name: 'Peter',
        surName: 'Fazuľka'
    }
];
console.log(people);

// pridanie ďalšieho objektu do poľa
people.push({
    name: 'Jožko',
    surName: 'Mrkvicka'
});
console.log(people);


let newline;
// deklarácia a súčasne inicializácia premennej tableElement
let tableElement = document.getElementById('peopleTable');
let tableBody = tableElement.getElementsByTagName('tbody')[0];

console.log(tableElement);
console.log(tableBody);


people.forEach(person => {
    // príklad template string
    newline = `<tr><td>${person.name}</td><td>${person.surName}</td></tr>`;
    console.log(newline);
    tableBody.innerHTML += newline;
});