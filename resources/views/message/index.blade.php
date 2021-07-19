@extends('layouts.layout')
@section('style')
<!-- This example requires Tailwind CSS v2.0+ -->

<style>
  /* Chat containers */
  .container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
  }

  /* Darker chat container */
  .darker {
    border-color: #ccc;
    background-color: #ddd;
  }

  /* Clear floats */
  .container::after {
    content: "";
    clear: both;
    display: table;
  }

  /* Style images */
  .container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
  }

  /* Style the right image */
  .container img.right {
    float: right;
    margin-left: 20px;
    margin-right: 0;
  }

  /* Style time text */
  .time-right {
    float: right;
    color: #aaa;
  }

  /* Style time text */
  .time-left {
    float: left;
    color: #999;
  }

  .green_icon {
    background-color: #4cd137;
    /* left: 30px; */
    /* top: 140px; */
    height: 10px;
    width: 10px;
    border-radius: 50%;
    display: block;
  }
</style>
@endsection

@section('content')

<div class="container" id="chat">


  <div>Online User 
    <div id="onlineUser">  </div>
  </div>

  @foreach ($messages as $message)

  <div class="container">

    @if ( Auth::user()->id !== $message->user_id)
    <p><b>{{$message->user->name}}</b> say</p>
    <p>{{$message->body}}</p>
    <span class="time-left">{{ date_format( ($message->created_at) , "h:i a") }}</span>
    @else
    <p class="text-right"><b>{{$message->user->name}}</b> say</p>
    <p class="text-right">{{$message->body}}</p>
    <span class="time-right"> {{ date_format( ($message->created_at) , "h:i a")}} </span>
    @endif

  </div>

  @endforeach



</div>
{{Auth::user()->name}} ::
<input type="text" class="chat-input bg-white darker" id="chatInput">
{{-- {{ route('message') }} --}}
@endsection


@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.socket.io/4.1.2/socket.io.min.js"
  integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>

@auth

<script>
  $(function () {
          let ip_adress= "127.0.0.1";
          let socket_port = "3000";
          let socket =io(ip_adress +':'+ socket_port);
          // var chatInput =$("#chatInput");
          
          // socket.on("connection");

          let Onluser= '{{Auth::user()->name}}';
          socket.emit("online" , (Onluser));
          
          socket.on("onlineUser" , ( users )=>{
              $("#onlineUser").html("");
              users.forEach(user => {
                $("#onlineUser").append(
                  `<div> <i class="green_icon "> </i> ${user} </div>`
                  );   
            });
          });

          socket.on("OfflineUser" , ( users )=>{
              $("#onlineUser").html("");
              users.forEach(user => {
                $("#onlineUser").append(
                  `<div> <i class="green_icon "> </i> ${user} </div>`
                  );   
            });
          });


          
          $('#chatInput').keyup(function (e) {
                    if(e.key=="Enter"){
                      let msg=$(this).val();
                      let user= '{{Auth::user()->name}}';
                      socket.emit("sendChatToServer" , ([msg,user]) );
                      $(this).val("");  

                      let data = {
                        '_token' : $('meta[name=csrf-token]').attr('content'),
                        msg ,
                        user
                                 };
                      let url = '{{ route("messageStore") }}';

                    $.ajax({
                      url: url ,
                      method : 'post',
                      data: data,
                    });
                  }                                    
                }) ;

                var hours = new Date()
                .toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })
                .toLowerCase();;

                socket.on("sendChatToClient", ([msg,user] )=>{
                $("#chat").append(
                ` <div class="container">               
                  <p>  <b>${user}</b>  say</p> 
                  <p>${msg}</p>      
                  <span class="time-left">${hours}</span>
                </div>`
                );
                })
                
              });
</script>

@endauth

@endsection