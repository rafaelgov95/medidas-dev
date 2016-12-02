const mg = require('mongoose');
const Medidas = mg.model('medidas');
const name = require('./../filds/fild-name.js');
const lastName = require('./../filds/fild-corrida.js');
const created_at = require('./../quarks/quarks-create-now.js');
module.exports = new mg.Schema({
    name,
    lastName,
    cpf: String,
    telefones: { numero: String },
    medidas: { type: mg.Schema.ObjectId, ref: "Medidas" },
    shipped,
    created_at,
})