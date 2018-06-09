// Setup basic express server
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var allClients = {};

io.on('connection', (socket) => {
  console.log("connected me ",socket.id);

    //checking login user
    socket.on('disconnect', function() {
     var dataClear = {};
     for (const i in allClients) {
       if (allClients.hasOwnProperty(i)) {
         const val = allClients[i];
         delete val[socket.id];
         dataClear[i] = val;
       }
     }
     allClients = dataClear;
     socket.emit('ALL_ONLINE', allClients)
  });

  // checking login
  socket.on('SEND_ONLINE', function(data){
    if(allClients[data.user_id]){
      allClients[data.user_id][socket.id] = {
        socket: socket.id,
      }
    }else{
      allClients[data.user_id] = {};
      allClients[data.user_id][socket.id] = {
        socket: socket.id,
      }
    }
    console.log("allClients => ",allClients)
    socket.emit('ALL_ONLINE', allClients)
  })

  socket.on('SEND_MESSAGE', function(data){
      io.emit('RECEIVE_MESSAGE', data);
  })
});

http.listen(8850, function(){
  console.log("Listening on *:8850")
})

