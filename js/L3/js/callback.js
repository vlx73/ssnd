function spracujMeno(meno, callback) {
    const text = `Ahoj, ${meno}!`;

    // zavoláme callback s výsledkom
    callback(text);
}

// volanie spracujMeno s callbackom
spracujMeno("Eva", function(vysledok) {
    console.log(vysledok);
});