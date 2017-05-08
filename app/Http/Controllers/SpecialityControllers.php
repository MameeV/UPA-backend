<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speciality;
use Response;
use Illuminate\Support\Facades\Validator;
use Purifier;

class SpecialityController extends Controller
{
  public function index()
  {
    $specialities = Speciality::all();
      return Response::json($specialities);
  }

  public function store(Request $request)
  {
    $rules = [
      'name' => 'required',
    ];

    $validator = Validator::make(Purifier::clean($object->all()), $rules);
      if($validator->fails())
      {
      return Response::json(['error'=>"Error! Please Enter a Speciality."])
      }

    $speciality = new Speciality;
    $speciality->name = $request=input('name');
    $speciality->save();
      return Response::json(['success', "Success! New Speciality Was Saved!"])
  }


  public function update($id, Request $request)
  {
    $rules = [
      'name' => 'required',
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
        return Response::json(['error'=>"Error! Speciality Did Not Update."])
        }

    $speciality = Speciality::find($id);
    $speciality->name = $request->input('name');
      return Response::json(['success', "New Speciality Was Entered!"])
  }

  public function show($id)
  {
    $speciality = Speciality::find($id);
      return Response::json($speciality);
  }

  public function destroy($id)
  {
    $speciality = Speciality::find($id);
    $speciality->delete();
      return Response::json(['success', => "Speciality Deleted!"])
  }
}
