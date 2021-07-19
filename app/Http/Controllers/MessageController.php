<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\message;
use App\Models\User;
use App\Events\Message as MessageEvent;

class MessageController extends Controller
{
    public function index()
    {
        $messages =message::get();
        
        return view('message.index' , ["messages"=> $messages] ) ; 
    }
    public function store(Request $request)
    {   
        $msg  = $request->msg;
        $user = $request->user;
        $user_id = User::where("name","=",$user)->first()->id;

        $message =message::Create([
            "user_id"=>$user_id ,
            "body" =>  $msg
        ]);
        return;
        return view('message.index'
        ,[ $msg=>"msg" , $user => "user"]
    ); }
    // ---------------------------------
    public function index2()
    {
        $messages =message::get();
        
        return view('message.index2' , ["messages"=> $messages] ) ; 
    }

    public function sentMessage(Request $request)
    {
        event(new MessageEvent(
            $request->username ,          
            $request->message
        ));
        $data=[$request->username , $request->message];
        return  dd($data);
    }

}
