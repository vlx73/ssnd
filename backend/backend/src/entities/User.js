/**
 * User entita — odráža stĺpce tabuľky `users`.
 * Jednoduchá dátová trieda bez akejkoľvek biznis logiky.
 */
export class User {
    /** @type {number} */
    id;

    /** @type {string} */
    email;

    /** @type {string} */
    name;

    /** @type {string} */
    passwordHash;

    /** @type {boolean} */
    isActive;

    /** @type {Date} */
    createdAt;

    /** @type {Date} */
    updatedAt;

    constructor({ id, email, name, passwordHash, isActive, createdAt, updatedAt }) {
        this.id           = id;
        this.email        = email;
        this.name         = name;
        this.passwordHash = passwordHash;
        this.isActive     = isActive;
        this.createdAt    = createdAt;
        this.updatedAt    = updatedAt;
    }
}
