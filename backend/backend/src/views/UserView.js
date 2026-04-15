/**
 * UserView — View v MVC.
 *
 * Zodpovedá za formátovanie a odosielanie HTTP odpovedí.
 * Controller nikdy nevolá res.json() priamo — deleguje to sem.
 * Citlivé polia (napr. passwordHash) nie sú nikdy vystavené.
 */
export class UserView {

    /**
     * Zobrazí zoznam používateľov.
     *
     * @param {import('express').Response} res
     * @param {import('../entities/User.js').User[]} users
     */
    static list(res, users) {
        res.json(users.map(UserView.#format));
    }

    /**
     * Zobrazí jedného používateľa.
     *
     * @param {import('express').Response} res
     * @param {import('../entities/User.js').User} user
     */
    static single(res, user) {
        res.json(UserView.#format(user));
    }

    /**
     * Zobrazí novo vytvoreného používateľa (HTTP 201).
     *
     * @param {import('express').Response} res
     * @param {import('../entities/User.js').User} user
     */
    static created(res, user) {
        res.status(201).json(UserView.#format(user));
    }

    /**
     * Zobrazí odpoveď 204 No Content (po vymazaní).
     *
     * @param {import('express').Response} res
     */
    static deleted(res) {
        res.status(204).send();
    }

    /**
     * Zobrazí odpoveď 404 Not Found.
     *
     * @param {import('express').Response} res
     */
    static notFound(res) {
        res.status(404).json({ message: 'Používateľ nebol nájdený.' });
    }

    /**
     * Zobrazí odpoveď 422 Unprocessable Entity s chybami validácie.
     *
     * @param {import('express').Response} res
     * @param {string[]} errors
     */
    static validationError(res, errors) {
        res.status(422).json({ errors });
    }

    // -------------------------------------------------------------------------
    // Privátne pomocné metódy
    // -------------------------------------------------------------------------

    /**
     * Vytvorí verejnú JSON reprezentáciu User entity.
     * Toto je jediné miesto, ktoré rozhoduje, čo klient uvidí.
     *
     * @param {import('../entities/User.js').User} user
     * @returns {object}
     */
    static #format(user) {
        return {
            id:        user.id,
            name:      user.name,
            email:     user.email,
            isActive:  user.isActive,
            createdAt: user.createdAt,
        };
    }
}
