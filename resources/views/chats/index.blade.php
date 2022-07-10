@extends('layouts.master')
@section('content')
<div class="container">
    <a href=" {{route('chat.create')}} " class="btn btn-primary ">New Chat</a>

</div>
    <div class=" m-5 w-3 h-5 w-4 border border-4 border-primary container chat-index" style=" width: 60%;
    height: 60%;    border-width: 3px; border-style: solid;   border-radius: 2px;">
        @if(!$chats)
            <div >
                <h6>no chats available yet</h6>
            </div>

        @else
            @foreach ($chats as $chat){
                <a href=" {{route('chat.show',['chat'=>$chat])}}">
                    <div class="row">
                        <div><h6> {{$chat->borrower->fname}} </h6></div>
                        <p> {{$chat->messages()->latest()->first()}} </p>
                    </div>
                </a>
            }
                
            @endforeach
        @endif


    </div>

@endsection