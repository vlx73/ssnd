import pg from 'pg';

const { Pool } = pg;

const pool = new Pool({
    host:     process.env.POSTGRES_HOST,
    port:     parseInt(process.env.POSTGRES_PORT ?? '5432'),
    database: process.env.POSTGRES_DB,
    user:     process.env.POSTGRES_USER,
    password: process.env.POSTGRES_PASSWORD,
});

export default pool;