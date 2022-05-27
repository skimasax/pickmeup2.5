<?php

namespace App\Http\Controllers;

use App\Http\Traits\Customers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    use Customers;


    public function signup(Request $req){
            $validation=Validator::make($req->all(),[
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'gender' => 'required',
                'password' => 'required',
                'confirm_password' => 'required'
            ]);

            $data=User::create([
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'gender' => $req->gender,
                'password' => Hash::make($req->password),
                'confirm_password' => Hash::make($req->confirm_password)
            ]);

            $token=$data->createToken('myapptoken')->plainTextToken;

            $response = [
                'data'=> $data,
                'token' => $token
            ];

            return response($response, 200);
    }

 //function to logout
 public function logout(Request $req){
        auth()->user()->tokens()->delete();
     $response=[
         'message' => 'Logout Successfully'
     ];

     return response($response, 200);
   
}

//function to login

public function login(Request $req){

    $attr = $req->validate([
        'email' => 'required|string|email',
        'password' => 'required'
    ]);


   if(!Auth::attempt($attr)){
   $response=[
            'message' => 'Invalid Credentials',
            'status' => 'Error'
        ];
     return response($response, 400);
   }else{
    $user=User::where('email',$req->email)->first();
    $token=$user->createToken('myapptoken')->plainTextToken;

    $response = [
        'data'=> $user,
        'token' => $token,
        'message' => 'success'
    ];

    return response($response, 200);
   }
    


}


//endpoint to get a single user record
public function getUsers(Request $req, $id){
        $data=User::where('id',$id)->first();
        $response=[
            'data' =>$data,
        ];

        return response($response, 200);
        
}

//function to update user
public function updateProfile(Request $req, $id){

    $validation=Validator::make($req->all(),[
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required',
        'gender' => 'required',
    ]);

    User::where('id',$id)->update([
        'firstname' => $req->firstname,
        'lastname' => $req->lastname,
        'email' => $req->email,
        'gender' => $req->gender,
    ]);

        $data=User::where('id',$id)->first();

    $response = [
        'data'=> $data,
        'message' => 'success'
    ];

    return response($response, 200);
}

//function forgot password
public function forgotPassword(Request $req, $id){
    $validator=Validator::make($req->all(),[
        'password' => 'required',
        'confirm_password' => 'required'
    ]);

    $data=User::where('id',$id)->update([
        'password' => Hash::make($req->password),
        'confirm_password'=>Hash::make($req->password),
    ]);

    $response=[
        'message' => 'Password Changed Successfully',
        'status' => 'success'
    ];

    return response($response, 200);

}

//function to get user details
    public function userProfile(Request $req, $id){
        $data=$this->getdetails($id);
        $response=[
            'data' => $data,
        ];
        return response($response, 200);

    }


}
