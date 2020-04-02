const express = require("express");
const routes = require('./routes');
const cors = require('cors');
const { errors } = require('celebrate');

const app = express();
app.use(cors());
app.use(express.json());
app.use(routes);

app.use(errors());

/**Rota / Recurso */
/**
 * Métodos HTTP:
 * GET: Buscar uma informação do backend
 * POST: Criar uma informação no backend
 * PUT: Alterar uma informação no backend
 * DELETE: Deletar uma informação no backend
 * 
 */

/**
 * Tipos de parâmentros:
 * Query Params: Parâmetros nomeados enviados na rota após "?" (Filtros, paginação)
 * Route  Params: Parâmetros utilizados para identificar recursos
 * Request Body:  Corpo da requisição, utilizado para criar ou alterar recursos
 * 
 */

module.exports = app;