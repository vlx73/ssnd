// deklarácie funkcie 1 - named function - pomenovaná funkcia
function myFunction(param1, param2) {
    console.log('myFunction');
    console.log(param1 + param2);

    return param1 + param2;
}

myFunction(1, 2);

// deklarácie funkcie 2 - anonymous function - nepomenovaná funkcia
const myFunction2 = function (param1, param2) {
    console.log('myFunction2');
    console.log(param1 - param2);

    return param1 - param2;
}

// volanie funkcie
myFunction2(5, 3);

// deklarácie funkcie 3 - arrow function - funkcia so šípkou
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

// príklad použitia call back funkcie deklarovanej ako nepomenovaná funkcia
let myArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

myArray.forEach(function (prvokPola) {
    console.log(prvokPola ** 2);
});


// template string example
let firstName = 'Janko';
let templateString = `Moje meno je ${firstName}`;

console.log(firstName);
console.log(templateString);
