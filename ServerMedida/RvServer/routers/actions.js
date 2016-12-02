'use strict'

module.exports = (Schema, Banco) => {

    const model = require('./mongoModel')(Schema, Banco) // envia dados para o generic omitindo mongoose
    const callback = (err, data, res) => {
        if (err) return console.log('erro', err)
        return res.json(data);

    }
    const Actions = {}

    Actions.listar = (req, res) => {
        const query = req.query;
        model.find(query, (err, data) => {
            callback(err, data, res)
        });
    }

    Actions.buscar = (req, res) => {
        const query = req.query;
        model.findOne(query, (err, data) => {
            callback(err, data, res)
        });
    }

    Actions.save = (req, res) => {
        const body = req.body;
        const modelo = new model(body);
        modelo.save((err, data) => {
            callback(err, data, res)
        });
    }
    Actions.remove = (req, res) => {
        const body = req.body
        model.remove(body, (err, data) => {
            callback(err, data, res)
        });
    }
    Actions.update = (req, res) => {
        const body = req.body
        const query = req.query
        model.update(query, body, (err, data) => {
            callback(err, data, res)
        });
    }
    return Actions;
}