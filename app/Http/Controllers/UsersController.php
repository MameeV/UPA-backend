<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Purifier;
use Hash;
use App\User;
use JWTAuth;
use Auth;
use File;
use Response;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->middleware("jwt.auth", ["only" => ["getUser", "signUp", "signIn"]]);
  }

  public function index()
  {
    return File::get('index.html');
  }

  public function SignUp(Request $request)
  {
    $rules=[
      "username" => "required",
      "email" => "required",
      "password" => "required"
    ];

    $validator = Validator::make(Purifier::clean($request->all()),$rules);
    if($validator->fails())
    {
      return Response::json(['error' => "Please fill out all fields"]);
    }

    $check = User::where("email","=",$request->input("email"))->orWHERE("name","=",$request->input("username"))->first();

    if(empty($check))
    {
      $user = new User;
      $user->name = $request->input("username");
      $user->email = $request->input("email");
      $user->password = Hash::make($request->input("password"));
      $user->roleID = 2;
      $user->save();

      return Response::json(["success"=>"Thanks for signing up!"]);
    }
  }

    public function SignIn(Request $request)
    {
      $rules=[
        "email" => "required",
        "password" => "required",
      ];

      $validator = Validator::make(Purifier::clean($request->all()),$rules);
      if($validator->fails())
      {
        return Response::json(['error' => "Please fill out all fields"]);
      }

      $email = $request->input("email");
      $password = $request->input("password");

      $cred = compact("email","password", ["email","password"]);
      $token = JWTAuth::attempt($cred);

      return Response::json(compact("token"));
    }

    public function getUser()
    {
      $user = Auth::user();
      $user = User::find($user->id);
      return Response::json($user);
    }
    
    public function contact(Request $request)
    {
      $rules = [
        'email' => 'required',
        'message' => 'required'
      ];
      
      $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
      {
        return Response::json(['error'=>"Error. Please fill out all fields!"]);
      }
      $email = $request->input('email');
      $body = $request->input('message');
      
      Mail::send('emails.contact', array('email'=>$email, 'body'=>$body),
      function($email, $body, $message)
      {
        $message->from($email, $email);
        $message->to('medicaladvocacypartners@gmail.com', 'Medical Advocacy Partners')->subject('UPA CIN');
      });
        return Response::json(['success'=>"Thank You! Your Message Was Sent."]);
    }
  }
