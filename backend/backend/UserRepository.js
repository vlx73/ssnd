import {pool} from './db.js';
import bcrypt from 'bcrypt';

export class UserRepository {
    async findAll() {
        const result = await pool.query('SELECT name, email, is_active, created_at, updated_at ' +
            'FROM users ORDER BY id');
        return result.rows;
    }

    async delUser(id) {
        const result = await pool.query('DELETE FROM users WHERE id = $1', [id]);
        return result.rowCount > 0;
    }

    async addUser({name, email, password}) {
        if (!name || !email || !password) {
            throw new Error('name, email and password are required');
        }

        const passwordHash = await bcrypt.hash(password, 12);

        const result = await pool.query(
            `INSERT INTO users (name, email, password_hash)
             VALUES ($1, $2, $3) RETURNING id, name, email, is_active, created_at, updated_at`,
            [name, email, passwordHash]
        );

        return result.rows[0];
    }

    async getUserById(id) {
        const result = await pool.query('SELECT * FROM users WHERE id = $1', [id]);
        return result.rows[0];
    }
}
