/**
 * UserFilter — očistí surový vstup z požiadavky pred validáciou.
 *
 * Odstraňuje medzery, normalizuje veľkosť písmen a vynecháva neočakávané polia.
 * Controller volá filter ako prvý, pred zavolaním Validatora.
 */
export class UserFilter {

    /**
     * Filtruje surové telo POST požiadavky pre vytvorenie používateľa.
     *
     * @param {object} body  surové req.body
     * @returns {{ name: string, email: string, password: string }}
     */
    static forCreate(body) {
        return {
            name:     String(body.name     ?? '').trim(),
            email:    String(body.email    ?? '').trim().toLowerCase(),
            password: String(body.password ?? ''),
        };
    }
}
