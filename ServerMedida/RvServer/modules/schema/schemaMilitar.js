const mg = require('mongoose')
const name = require('./../filds/fild-name.js');
const lastName =require('./../filds/fild-lastName.js');
const matricula  =require('./../filds/fild-matricula.js');
const nomeDeGuerra  = require('./../filds/fild-nomeDeGuerra.js');
const age = require('./../filds/fild-age.js');
const sexo =require('./../filds/fild-sexo.js');
const patente = require('./../filds/fild-patente.js');
const staffs =require('./schemaStaff.js');
const created_at =require('./../quarks/quarks-create-now.js');

module.exports = new mg.Schema({
	name,	
	lastName,
	matricula,
	nomeDeGuerra,
	age,
	sexo,
	patente,
	staffs,
	created_at,
} )
