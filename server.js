// const express = require("express");


// const app = express();

// const server = require('http').createServer(app);

// const io = require("socket.io")(server, {
//     cors: { origin: "*" }
// });


// let onlusers=[]

// io.on("connection" , (socket) =>{
//     console.log("connecting");

//     let currentUser ="";
//     socket.on("online", (user) =>{
//         currentUser = user;
//         if( ! onlusers.includes(user) ) {
//             onlusers.push(user);
//         }

//         console.log(onlusers);
//         io.sockets.emit("onlineUser" , onlusers);
//     });

     
//     socket.on("sendChatToServer", ([message, user])=>{
//          console.log("msg "+ message +" user " + user)   
//          io.sockets.emit("sendChatToClient" , message)
//         socket.broadcast.emit("sendChatToClient",[message, user])
//         });

//     socket.on("disconnect" , (socket) =>{
//         onlusers = onlusers.filter(item => item !== currentUser);
//         console.log(onlusers);
//         io.sockets.emit("OfflineUser" , onlusers);

//         console.log('disconnected')
        
//     });

// });


// server.listen(3000,
//     ()=>{
//         console.log("server is running" );
//     });

    