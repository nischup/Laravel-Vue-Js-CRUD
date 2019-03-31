<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\User;
use Session;
use Mail;


class UserController extends Controller
{

    public function index()
    {
        $user = User::OrderBy('id', 'desc')->get();
        return $user;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $result = User::create($data);

        Mail::send('email',
           array(
               'name' => $request->get('name'),
               'email' => $request->get('email'),
           ), function($message) use ($request)
       {
           $message->from($request->email);
           $message->to('sabbir.winux@gmail.com', 'Admin')->subject('Contact Feedback');
       });

        return response()->json($result, 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('success', 200);
    }
}
