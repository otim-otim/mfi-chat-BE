@extends('layouts.master')
@section('content')
<a href=" {{route('chat.create')}} " class="btn btn-primary">New Chat</a>
    <div class="flex m-5 w-3 h-5 w-4 border  border-dark">
       
            <div id="div-messages">
                <h6>$chat->borrower->fname</h6>
            </div>

      
           <div>
            <form action="" method="post">
                @csrf   
                <div>
                    <input type="text" id="inp-message">
                    <button id="btn-send">send</button>
                </div>
            </form>
         


    </div>

@endsection