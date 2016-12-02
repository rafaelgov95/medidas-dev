'use strict'

module.exports = function(Schema, BancoBD) {
    const mongodb = require('mongoose');
    return mongodb.model(BancoBD, Schema);
}



// module.exports = () => {
//     const vetor = {};
//     const mongodb = require('mongoose');
//     vetor.modelUser = mongodb.model(BancoBD, SchemaMedida);
//     vetor.modelMedida =
// }