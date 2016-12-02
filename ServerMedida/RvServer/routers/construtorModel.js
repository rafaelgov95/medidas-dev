'use strict'
module.exports = (schema, banco) => {
    const Actions = require('./actions')(require('./../modules/schema/' + schema), banco) // Actions fica nossas implementacoes
    console.log(require('./../modules/schema/' + schema));
    const Routes = require('./routes')(Actions) // Nossas Rotas e enviada para um onde e passado a rota do Rit
    const DriveRouterExpress = require('express').Router() //Drive de rotas Do Express.Router()
    const RoutesExpress = require('./routesExpress')(Routes, DriveRouterExpress) // Junto com nossas rotas e o drive buscamos no forEach a rota correta
    return RoutesExpress; //retorna a rota selecionada para o Router.use
}