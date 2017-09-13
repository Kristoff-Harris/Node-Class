var net = require('net');

// Listen for commands from the client
var server = net.createServer(
    function(socket){
        console.log("Client connection...");

        socket.on('end', function(){
           console.log('Client Disconnected...');
        });

        // process data from client
        socket.on('data', function(data){
            dataArray = data.toString().split(' ');

            if(dataArray[0] == 'lookupByLastName' && dataArray[1] != undefined){
             console.log("Recieved: ", dataArray[0], dataArray[1]);
            }

            else if(dataArray[0] == 'addEmployee' && dataArray[1] != undefined && dataArray[2] != undefined){
                console.log("Recieved: ", dataArray[0], dataArray[1], dataArray[2]);
            }

            else if(dataArray[0] == 'lookupByLastName' && dataArray != undefined){
                console.log("Recieved: ", dataArray[0], dataArray[1])
            }
            else {
                socket.write("Unknown Command");
            }

        });

        socket.write("Hello from server");
    });

server.listen(3000, function() {
    console.log("Listening for connections ")
});


// Use JSON.stringify to send results back to the client

