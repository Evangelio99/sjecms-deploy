<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\User; 
use Mail;

class ForgotPassController extends Controller
{
    public function password(Request $request){
        $user = User::whereEmail($request->email)->first();

        if($user == null){
            return response()->json(['error'=>'Unauthorised'], 401);
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')
        ->where('email', $request->email)->first();

        $user = DB::table('users')
        ->where('email', $request->email)->first();
        
        
        $this->sendResetEmail($user, $tokenData->token);

        return response()->json(['success'=>'Reset link sent successfully'], 200);
    }

    public function reset($email, $code){
        $user = User::whereEmail($email)->first();

        if($user == null){
            // return redirect()->back()->with(['error' => 'Email not exists']);
            echo 'Email not exist';
        }

        $tokenData = DB::table('password_resets')
        ->where('email', $email)->first();

        if($tokenData){
            if($code == $tokenData->token){
                // return view('reset_password_form')->with(['user'=>$user, 'code'=>$code]);
                // $success['email'] = $user->email;
                // $success['token'] = $code;
                // return response()->json(['success' => $success], 200);
                return redirect('http://localhost:8080/ChangePassword'.'/'.$user->email.'/'.$code);
            }else{
                return redirect('http://localhost:8080/forgotpassword');
            }
        }else{
            // return redirect()->back()->with(['error' => 'time expired']);
            return redirect('http://localhost:8080/forgotpassword');
        }
    }

    public function resetPassword(Request $request, $email, $code){
        $validator = Validator::make($request->all(),
            [
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]
        );

        if($validator->fails()) {
            return response()->json(["validation errors" => $validator->errors()], 401);
        }

        $user = User::whereEmail($email)->first();

        if($user == null){
            // return redirect()->back()->with(['error' => 'Email not exists']);
            return response()->json(['error'=>'Unauthorised'], 401);
        }


        //Get the token just created above
        $tokenData = DB::table('password_resets')
        ->where('email', $email)->first();

        $user = DB::table('users')
        ->where('email', $email)->first();



        if($tokenData){
            if($code == $tokenData->token){

                $userDataArray = array(
                    'password' =>  bcrypt($request->password)
                );
                
                $user = User::where('id', $user->id)->update($userDataArray);

                DB::table('password_resets')->where(['email'=> $email])->delete();

                return response()->json(['success'=>'Password Reset Successfully'], 200);
            }else{
                return redirect('http://localhost:8080/');
            }
        }else{
            // return redirect()->back()->with(['error' => 'time expired']);
            // echo 'Time expired';
            return redirect('http://localhost:8080/');
        }

    }

    public function sendResetEmail($user, $code){
        \Mail::send('reset_password',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
              $message->to($user->email);
              $message->subject("$user->first_name, reset your password.");
           });
    }
}
