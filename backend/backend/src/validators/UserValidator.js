const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

/**
 * UserValidator — overí, či filtrovaný vstup spĺňa biznis pravidlá.
 *
 * Každá metóda vracia pole chybových správ.
 * Prázdne pole znamená, že vstup je platný.
 * Controller volá validator po filtri.
 */
export class UserValidator {

    /**
     * Validuje dáta pre vytvorenie používateľa.
     *
     * @param {{ name: string, email: string, password: string }} data
     * @returns {string[]} zoznam chybových správ, prázdny ak je vstup platný
     */
    static forCreate(data) {
        const errors = [];

        if (!data.name) {
            errors.push('Meno je povinné.');
        }

        if (!data.email) {
            errors.push('Email je povinný.');
        } else if (!EMAIL_REGEX.test(data.email)) {
            errors.push('Email musí byť platná emailová adresa.');
        }

        if (!data.password) {
            errors.push('Heslo je povinné.');
        } else if (data.password.length < 8) {
            errors.push('Heslo musí mať aspoň 8 znakov.');
        }

        return errors;
    }
}
