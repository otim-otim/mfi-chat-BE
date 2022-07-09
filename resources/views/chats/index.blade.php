@extends('layouts.master')
@section('content')
<a href=" {{route('chat.create')}} " class="btn btn-primary">New Chat</a>
    <div class="flex m-5 w-3 h-5 w-4 border  border-dark">
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