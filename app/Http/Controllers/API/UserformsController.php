<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Userforms; 
use Validator;

class UserformsController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estID' =>  'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',  
            'email' => 'required|email',
            'address' => 'required', 
            'bodyTemp' => 'required',
        ]);

        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
        $input = $request->all();
                $user = Userforms::create($input); 
                $success['estID'] =  $user->estID; 
                $success['first_name'] =  $user->first_name;
                $success['last_name'] =  $user->last_name;
                $success['gender'] =  $user->gender;
                $success['email'] =  $user->email;
                $success['address'] =  $user->address;
                $success['bodyTemp'] =  $user->bodyTemp;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }
    
    public function displayrecords()
    {
        $user = UserForms::all();
        return response()->json(['success' => $user], $this-> successStatus); 
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
