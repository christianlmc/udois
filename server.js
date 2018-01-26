var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);


http.listen(3000, function(){
	console.log('listening on *:3000');
});

io.on('connection', function(socket){
	var sala;
	console.log('a user connected');
	socket.on('disconnect', function(){
		console.log('user disconnected');
	});
	socket.on('chat message', function(msg){
		io.to(sala).emit('chat message', msg);
		// console.log(msg);
	});
	socket.on('seen messages', function(datetime){
		io.to(sala).emit('seen messages', datetime);
		// console.log(datetime);
		// console.log(sala);
	});
	socket.on('joining', function(url){
		sala = url;
		// console.log(url)
		socket.join(url);
	});
});

