var fs = require('fs');
var path = require('path');

function resolveURL(url) {
    var isWin = !!process.platform.match(/^win/);
    if (!isWin) return url;
    return url.replace(/\//g, '\\');
}
/*
var options = {

    key: fs.readFileSync(path.join(__dirname, resolveURL('fake-keys/domain-key.pem'))),
    cert: fs.readFileSync(path.join(__dirname, resolveURL('fake-keys/domain-crt.pem'))),
        ca: fs.readFileSync(path.join(__dirname, resolveURL('fake-keys/domain-ca.pem')))
};
*/
var HashMap = require('hashmap');

var socket = require('socket.io');
var express = require('express');
var http = require('http');
var app = express();
app.use(express.static(__dirname));
app.use(function(req, res, next) {
        res.header("Access-Control-Allow-Origin", "*");
        res.header("Access-Control-Allow-Headers", "X-Requested-With");
        res.header("Access-Control-Allow-Headers", "Content-Type");
        res.header("Access-Control-Allow-Methods", "PUT, GET, POST, DELETE, OPTIONS");
        next();
    });
var server = http.createServer(app);

var io = socket.listen(server,{log:false, origins:'*:*'});

server.listen(8111);
/*
var mysql = require('mysql');
var pool  = mysql.createPool({
  connectionLimit : 100,
  host            : 'example.org',
  user            : 'bob',
  password        : 'secret',
  database        : 'my_db'
});

pool.query('SELECT 1 + 1 AS solution', function (error, results, fields) {
  if (error) throw error;
  console.log('The solution is: ', results[0].solution);
});
*/
var users = new HashMap();

//map.set("username","socketid");
//map.get("username");
//map.delete("username");
console.log("program started");
io.sockets.on('connection', function (socket) {
    console.log(socket.id);

    socket.on('login', function (data) {

        users.set(data, socket.id);

        io.sockets.emit('online', data);

        console.log('User - ' + data + ' ' + socket.id + ' logged in!');
    });
	// User message transfer.
    socket.on('message', function (data) {

        console.log(data);

        var currentuser = data.from;
        var otheruser = data.to;
        var otheruserid = users.get(otheruser);

        //console.log(otheruserid);
        if (users.has(currentuser) && users.has(otheruser)) {
                        console.log('came inside message');
            socket.to(otheruserid).emit('message', data);
        }
                else{
                        users.forEach(function(value, key) {
                                console.log(key + " : " + value);
                        });
                        socket.to(data.to).emit('message', data);
                        console.log(currentuser + '' + otheruser);
                }
    });

    // User Disconnect from Server
    socket.on('disconnect', function (data) {

        //console.log(data);
        var userid = users.search(socket.id);

        //console.log(userid);

        // Remove the user from users List
        if (userid) {
            users.delete(userid);

            console.log('User - ' + userid + ' logged out!');
            io.sockets.emit('offline', userid);
        }
    });

});
    

	