/*
 Dátové typy
 */
let x = 4;
let y = 5;
let meno = "Janko";

// vykoná aritmetický súčet s číslami x a y obidve premenné sú interpretované ako number
console.log(x + y);

// vykoná spojenie reťazcov "meno" a "x" obidve premenné sú interpretované ako string
console.log(meno + " " + x);

/*
 Rozsah platnosti premenných
 */

let global = "global scope";

function scopes_demo() {
    let message = "local scope";

    if (true) {

        let message = "block level scope";

        console.log(`inner scope: ${message}`);
        console.log('global scope within block: ' + global);
    }

    console.log(`outer scope: ${message}`);
    console.log('global scope within function: ' + global);
}

console.log('global scope: ' + global);
scopes_demo();

/*
 riadenie toku programu
 */

// vykoná blok kódu ak je splnená podmienka porovnania s výsledkom tru
if (x > y) {
    console.log("x je väčšie ako y");
}

// vykoná blok kódu opakovane pokiaľ je splnená podmienka porovnania s výsledkom true minimálne 0 krát
while (x > 0) {
    console.log("x je " + x);
    x--;
}

// vykoná blok kódu opakovane pokiaľ je splnená podmienka porovnania s výsledkom true minimálne raz
do {
    console.log("x je " + x);
    x++;
} while (x <= 5);

// vykoná blok kódu opakovane pokiaľ je splnený testovací výraz a pri každom cykle sa vykoná iteračný výraz
// for([inicializácia]; [testovací výraz]; [iteračný výraz]) {
for (let i = 0; i < 5; i++) {
    console.log("i je " + i);
}