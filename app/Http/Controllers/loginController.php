<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class loginController extends Controller
{


    public function __construct()
    {

    }

    public function loginweb(Request $request){
return view('auth.login');
    }

    public function login(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|max:191',
                'password' => 'required',

            ]
        );


        if ($validator->fails()) {
            return response()->json(['status' => 404,'errors'=>$validator->getMessageBag(),'message' => 'validation error']);

        }else{
            $user = User::where('email', $request->email)->first();

            if(! $user || !Hash::check($request->password, $user->password)){
               return response()->json([
                   'status' => 401,
                   'message' => 'Invalid Credentials',

               ]);
            }else{
       $token = $user->createToken($user->email.'_Token')->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'user_id' => $user->id,
                    'token' => $token,
                    'message' => 'Logged IN Successfully By RiskCurb ',
                ]);

            }
        }

    }


    public function get_data(Request $request){
   $sites = User::where('role', '1')->count();
   $users = User::where('role', '0')->count();
   return response()->json([
    'status' => 200,
    'sites' => $sites,
    'users' => $users,
    'message' => 'Data fetched',
]);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message' => 'Successfully logged out',
            ]);

     }
}


