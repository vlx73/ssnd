import bcrypt from 'bcrypt';
import pool   from '../config/database.js';
import { User } from '../entities/User.js';

const BCRYPT_ROUNDS = 12;

/**
 * UserService — Model v MVC.
 *
 * Zodpovedá za všetku biznis logiku a prístup k databáze pre používateľov.
 * Mapuje surové riadky z databázy na User entity pred ich vrátením.
 */
export class UserService {

    /**
     * Vráti všetkých používateľov.
     *
     * @returns {Promise<User[]>}
     */
    async findAll() {
        const { rows } = await pool.query(
            'SELECT id, email, name, is_active, created_at, updated_at FROM users ORDER BY id'
        );
        return rows.map(row => this.#toEntity(row));
    }

    /**
     * Nájde jedného používateľa podľa primárneho kľúča.
     *
     * @param {number} id
     * @returns {Promise<User|null>}
     */
    async findById(id) {
        const { rows } = await pool.query(
            'SELECT id, email, name, is_active, created_at, updated_at FROM users WHERE id = $1',
            [id]
        );
        return rows.length ? this.#toEntity(rows[0]) : null;
    }

    /**
     * Vytvorí nového používateľa.
     * Pred uložením zahashuje heslo v čistom texte.
     *
     * @param {{ name: string, email: string, password: string }} data
     * @returns {Promise<User>}
     */
    async create(data) {
        const passwordHash = await bcrypt.hash(data.password, BCRYPT_ROUNDS);

        const { rows } = await pool.query(
            `INSERT INTO users (name, email, password_hash)
             VALUES ($1, $2, $3)
             RETURNING id, email, name, is_active, created_at, updated_at`,
            [data.name, data.email, passwordHash]
        );
        return this.#toEntity(rows[0]);
    }

    /**
     * Vymaže používateľa podľa primárneho kľúča.
     *
     * @param {number} id
     * @returns {Promise<boolean>} true ak bol riadok vymazaný
     */
    async deleteById(id) {
        const { rowCount } = await pool.query(
            'DELETE FROM users WHERE id = $1',
            [id]
        );
        return rowCount > 0;
    }

    // -------------------------------------------------------------------------
    // Privátne pomocné metódy
    // -------------------------------------------------------------------------

    /**
     * Namapuje surový PostgreSQL riadok na User entitu.
     *
     * @param {object} row
     * @returns {User}
     */
    #toEntity(row) {
        return new User({
            id:           row.id,
            email:        row.email,
            name:         row.name,
            passwordHash: row.password_hash,
            isActive:     row.is_active,
            createdAt:    row.created_at,
            updatedAt:    row.updated_at,
        });
    }
}
