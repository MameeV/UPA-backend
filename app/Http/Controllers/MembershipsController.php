<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membership;
use Response;
use Illuminate\Support\Facades\Validator;
use Purifier;

class MembershipsController extends Controller
{
  public function __construct()
  {
    $this->middleware("jwt.auth", ["only" => ["store", "update", "destroy"]]);
  }
    //will get list
    public function index()
    {
      //create a query to get a list and receive on the Frontend
      $physicians = Membership::all();

      return Response::json($physicians);
    }

    //store  - takes request param from frontend
    public function store(Request $request)
    {
      $rules = [
        'speciality' => 'required',
        'physician' => 'required',
        'practice' => 'required',
        'phone' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);
        if($validator->fails())
        {
          return Response::json(['error'=>"Error. Please Fill Out All Fields!"]);
        }

      $physician = new Membership;

      $physician->speciality = $request->input('speciality');
      $physician->physician = $request->input('physician');
      $physician->practice = $request->input('practice');
      $physician->phone = $request->input('phone');
      $physician->website = $request->input('website');


      $physician->save();

      //return a response from server to the frontend. Will get either a success or Error
      return Response::json(["success" => "Congratulations You Did It!"]);
    }

    //update function - 2 params id & request
    public function update($id, Request $request)
    {
      $rules = [
        'speciality' => 'required',
        'physician' => 'required',
        'practice' => 'required',
        'phone' => 'required'
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);
        if($validator->fals())
        {
          return Response::json(['error'=>"ERROR! Fields Did Not Update!"]);
        }

      $physician = Membership::find($id);

      $physician->speciality = $request->input('speciality');
      $physician->physician = $request->input('physician');
      $physician->practice = $request->input('practice');
      $physician->phone = $request->input('phone');
      $physician->website = $request->input('website');


      $physician->save();

      return Response::json(["success" => "Membership Has Been Updated!"]);
    }

    //shows individal article
    public function show($id)
    {
      $physician = Membership::find($id);

      return Response::json($physician);
    }

    //delete function to delete a single article
    public function destroy($id)
    {
      $physician = Membership::find($id);

      $physician->delete();

      return Response::json(["success" => "Membership Deleted."]);
    }





}
