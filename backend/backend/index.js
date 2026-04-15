import express from 'express';
import process  from 'node:process';
import apiRoutes from './src/routes/index.js';

const app  = express();
const PORT = process.env.PORT ? Number(process.env.PORT) : 8080;

// --- Spracovanie JSON tela požiadavky ---
app.use(express.json());

// --- Registrácia API route ---
app.use('/api', apiRoutes);

// --- Obsluha 404 ---
app.use((_req, res) => {
    res.status(404).json({ message: 'Nenájdené' });
});

// --- Globálny handler chýb ---
app.use((err, _req, res, _next) => {
    console.error(err);
    res.status(500).json({ message: 'Interná chyba servera' });
});

// --- Spustenie servera ---
app.listen(PORT, '0.0.0.0', () => {
    console.log(`[backend] počúva na porte ${PORT}`);
});
