<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membership;
use Response;
use Illuminate\Support\Facades\Validator;
use Purifier;

class MembershipsController extends Controller
{
    //will get list
    public function index()
    {
      //create a query to get a list and receive on the Frontend
      $articles = Membership::all();

      return Response::json($articles);
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

      $article = new Membership;

      $article->speciality = $request->input('speciality');
      $article->physician = $request->input('physician');
      $article->practice = $request->input('practice');
      $article->phone = $request->input('phone');
      $article->website = $request->input('website');


      $article->save();

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

      $article = Membership::find($id);

      $article->speciality = $request->input('speciality');
      $article->physician = $request->input('physician');
      $article->practice = $request->input('practice');
      $article->phone = $request->input('phone');
      $article->website = $request->input('website');


      $article->save();

      return Response::json(["success" => "Membership Has Been Updated!"]);
    }

    //shows individal article
    public function show($id)
    {
      $article = Membership::find($id);

      return Response::json($article);
    }

    //delete function to delete a single article
    public function destroy($id)
    {
      $article = Membership::find($id);

      $article->delete();

      return Response::json(["success" => "Membership Deleted."]);
    }


    public function getSpeciality()
    {
      $speciality = Membership::select("speciality")->distinct()->get();

      return Response::json($speciality);
    }
    public function selectSpeciality(Request $request)
    {
      $rules = [
        'speciality' => 'required',
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
      {
        return Response::json(['error'=>"ERROR! Fields Did Not Update!"]);
      }

      $speciality = $request->input('speciality');
      $physicians = Membership::where("speciality", "=", $speciality)->select("physician")->get();

      return Response::json($physicians);

    }

}
