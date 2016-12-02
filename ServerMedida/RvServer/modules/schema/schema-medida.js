'use strict'
const mg = require('mongoose');
// const Users = mg.model('users');
const ofic = require('./../filds/fild-ofic.js');
const note = require('./../filds/fild-note.js');
// const users = require('./schema-usuario');
const shipped = require('./../filds/fild-shipped.js');
const created_at = require('./../quarks/quarks-create-now.js');
module.exports = new mg.Schema({
    ofic,
    note,
    // users: { type: mg.Schema.ObjectId, ref: "Users" },
    shipped,
    created_at,
})