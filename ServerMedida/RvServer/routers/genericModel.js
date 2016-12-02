'use strict'
module.exports = (schema, banco) => {
    const Actions = require('./actions')(require('./../modules/schema/' + schema), banco) // Actions fica nossas implementacoes
    console.log(require('./../modules/schema/' + schema))
    const Routes = require('./routes')(Actions) // Nossas Rotas
    const RouterExpress = require('express').Router() //Drive de rotas Do Express.Router()
    const RoutesExpress = require('./routesExpress')(Routes, RouterExpress) // Junto com nossas rotas e o drive buscamos no forEach a rota correta
    return RoutesExpress; //retorna a rota selecionada para o Router.use
}