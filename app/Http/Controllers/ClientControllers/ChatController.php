<?php

namespace App\Http\Controllers\ClientControllers;

use JWTAuth;
use App\Models\Chat;
use App\Models\User;
use App\Models\Borrower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->borrower = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        // dd(auth('api')->user());
        $borrower = Borrower::find(Auth::guard('api')->id());
        // dd($borrower);
        // $chats = $borrower->chats()->with(['messages','user'])->get();
        // dd($chats);
        return response()->json([
            'chats'=>'',
            'user'=> Auth::guard('api')->check(),
            'message'=> 'chats retrieved successfully'
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
         return response()->json([
            'users'=>$users,
            'message'=>'users retrieved successfully'
         ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $borrower = Borrower::find(Auth::id());
        $user = User::find($id);
        $chat = new Chat();
        $chat->borrower()->associate($borrower);
        $chat->user()->associate($user);
        $chat->save();  
        return response()->json([
            'chat'=>$chat,
            'message'=> 'chat retrieved successfully'
        ],200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
