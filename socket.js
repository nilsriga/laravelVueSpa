var server = require('http').Server();
var io = require('socket.io')(server);


var Redis = require('ioredis');
var redisNewMessage = new Redis();
var redisUserEntered = new Redis();

redisNewMessage.subscribe('post-channel');
redisUserEntered.subscribe('user-entered-chat-channel');

redisNewMessage.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ":" + message.event, message.data);
})

redisUserEntered.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ":" + message.event, message.data);
})

// redisNewMessage.on('message', function (channel, message) {
//     message = JSON.parse(message);
//     // console.log(channel, message)
//     // console.log(messageContent.event, message.data);
//     io.emit(channel + ':' + message.event, message.data);
// });

server.listen(3000);