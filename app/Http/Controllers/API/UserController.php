<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['is_admin'] = $user->is_admin;
            return response()->json(['success' => $success], $this-> successStatus);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function userdetails(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['first_name'] = $user->first_name;
            $success['last_name'] = $user->last_name;
            $success['gender'] = $user->gender;
            $success['email'] = $user->email;
            $success['address'] = $user->address;
            return response()->json(['success' => $success], $this-> successStatus);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required',
            'last_name' => 'required', 
            'email' => 'required|email',
            'gender' => 'required',
            'address' => 'required', 
            'password' => 'required', 
            'c_password' => 'required|same:password',
             
        ]);

        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
        $input = $request->all(); 
                $input['password'] = bcrypt($input['password']); 
                $user = User::create($input); 
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                $success['first_name'] =  $user->first_name;
                $success['last_name'] =  $user->last_name;
                $success['gender'] =  $user->gender;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }

    //Update profile
    public function update(Request $request) {
        $user = Auth::user();
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required', 
                'email' => 'required|email',
                'gender' => 'required',
                'address' => 'required'
            ]
        );
        // if validation fails
        if($validator->fails()) {
            return response()->json(["validation errors" => $validator->errors()]);
        }

        $userDataArray = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'address' => $request->address
        );
        $user = User::where('id', $user->id)->update($userDataArray);
        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function adminupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function adminview()
    {
        $user = User::all();
        return response()->json(['success' => $user], $this-> successStatus); 
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return 204;
    }

    public function userInside(Request $request, $email){
       //$userEmail = User::findOrFail($email);
       $userDataArray = array(
        'is_inside' => 1
       );
       $userEmail = User::where('email', $request->email)->update($userDataArray);
       return response()->json(['success' => true, 'message' => 'Incremented successfully']);
       return print_r($user->id);
    }

    public function userOutside(Request $request, $email){
        $userDataArray = array(
            'is_inside' => 0
           );
           $userEmail = User::where('email', $request->email)->update($userDataArray);
           return response()->json(['success' => true, 'message' => 'Decremented successfully']);
           return print_r($user->id);
    }

}