const { default: axios } = require('axios');

require('./bootstrap');

require('alpinejs');



// import Echo from 'laravel-echo';

// window.io = require('socket.io-client');

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host : window.location.hostname +":6001"
// });


// window.Echo.join('online') 
//     .here((users) => {
//         // console.log(users);
//         console.log("hello");
//     })
//     .joining((user) => {
//         console.log(user.name);
        
//     })
//     .leaving((user) => {
//         console.log(user.name);
//     })
//     .error((error) => {
//         console.error(error);
//     });  



// $("#message_form").submit(function(e){
// e.preventDefault(); 
// });
// // }
//     $('#message_Input').keypress((e)=>{
        
//         if (e.key == "Enter") {
//             e.preventDefault();
//             let user = $('#username').html();

//             let data ={
//                     '_token' : $('meta[name=csrf-token]').attr('content'),
//                     username: user ,
//                     message: $('#message_Input').val()
//                 };

//             $.ajax({
//               type: "get",
//               url: '/larvTest/chat-app/public/sent-message',
//               data: data,
//             });

//             $("#message_Input").val('');
//           }
//     });
