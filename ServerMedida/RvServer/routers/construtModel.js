'use strict'

module.exports = function(Schema,BancoBD) {
	const mongodb = require('mongoose');
	return mongodb.model(BancoBD,Schema);
}