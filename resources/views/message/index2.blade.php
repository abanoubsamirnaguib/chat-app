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

  <div class="container message" >

    @if ( Auth::user()->id !== $message->user_id)
    <p><b> {{$message->user->name}} </b> say </p>
    <p> {{$message->body}} </p>
    <span class="time-left"> {{ date_format( ($message->created_at) , "h:i a") }} </span>
    @else
    <p class="text-right"><b> {{$message->user->name}} </b> say</p>
    <p class="text-right"> {{$message->body}} </p>
    <span class="time-right"> {{ date_format( ($message->created_at) , "h:i a")}} </span>
    @endif
  </div>
  @endforeach
</div>

<form id="message_form" method="get">
  <div id="username" name="username">{{Auth::user()->name}}</div> ::
  <input type="text" class="chat-input bg-white darker" id="message_Input" name="message">
  <input type="submit" value="submit" hidden>
</form>

@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>


</script>
@endsection