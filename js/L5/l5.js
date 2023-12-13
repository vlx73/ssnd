let firstName = 'Janko';

let template = `Moje meno je ${firstName}`;

console.log(firstName);
console.log(template);

// object
let newPerson = {
    'name': 'Peter',
    'surName': 'Fazuľka'
} 

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


// callable function
people.forEach(
    person => {
        addPersonbB(person);
    }
    );


  function addPersonbB(otherPerson){
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