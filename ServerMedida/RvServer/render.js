'use strict'

module.exports = function sendViewMiddleware(req, res, next) {
    res.sendView = function(view) {
        return res.sendFile(__dirname +'/'+view);
    }
    next();
}
