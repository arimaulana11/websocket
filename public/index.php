<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socket.IO Chat Example</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <ul class="pages">
    <li class="chat page">
      <div class="chatArea">
        <ul class="messages"></ul>
      </div>
      <input class="inputMessage" placeholder="Type here..."/>
    </li>
    <li class="login page">
      <div class="form">
        <h3 class="title">What's your nickname?</h3>
        <input class="usernameInput" type="text" maxlength="14" />
		<button type="button" name="button" id="btn-me">Klick me</button>
      </div>
    </li>
  </ul>
  

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="socket.io-1.4.5.js"></script>
  <script type="text/javascript">
    //var socket = io.connect('http://188.166.243.177:8850');
  var socket = io.connect('http://localhost:8850');
    socket.emit('SEND_ONLINE', {
      user_id:12,
    })

    socket.on('ALL_ONLINE', function (data) {
      console.log(data);
    });
    var data = {
      type : "chat",
      data : {
        description : "Lorem ipsum dolor sit amet, consectetur adipisicing elit"
      }
    }
    $('#btn-me').click(function(){
      console.log("test")
        socket.emit('chat', data);
      socket.emit('SEND_ONLINE', {
        sender:12,
        to:13,
        user_id:12,
        type: "messages",
        status: 'pending',
        messages : 'test'
      })
    })
  </script>
</body>
</html>
