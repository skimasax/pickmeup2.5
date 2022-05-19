<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
        //function to insert into DB
    public function signup(Request $req){
       try {
           $validator= Validator::make($req->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'gender' => 'required',
                'password' => 'required',
                'confirm_password' => 'required'
           ]);

           if(User::where('email', $req->email)){
               $data=[];
               $message='Email Already Exist';
               $status=400;
           }elseif ($validator->passes()){
             $data=User::insert([
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'gender' => $req->gender,
                'password' => Hash::make($req->password),
                'confirm_password' => Hash::make($req->confirm_password)
            ]);
            $message='Signup Registration Successful';
            $status=200;
           }else{
                $data=[];
                $message='error';
                $status=400;
           }
       } catch (\Throwable $th) {
           //throw $th;
           $data = [];
           $message = $th->getMessage();
           $status = 400;
       }

       $resData = ['data' => $data, 'message' => $message, 'status' => $status];

       return $this->returnJSON($resData, $status);

    }

        //function to fetch user profile
    public function getUsers(Request $req, $id){
        
        try {
            $data=User::where('id',$id)->first();
            if($data){
                $message='success';
                $status = 200;
        }else{
                $data=[];
                $message='Error';
                $status = 400;   
        }
        } catch (\Throwable $th) {
            //throw $th;
            $data = [];
            $message = $th->getMessage();
            $status = 400;
        }

        $resData = ['data' => $data, 'message' => $message, 'status' => $status];

        return $this->returnJSON($resData, $status);
    }

    //function to update user profile
    public function updateProfile(Request $req, $id){
        try {
            
                $validator=Validator::make($req->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required',
                ]);

            if($validator->passes()){    
            $data=User::where('id', $id)->update([
                'firstname'=> $req->firstname,
                'lastname' => $req->lastname,
                'email' => $req->email
            ]);
                $message='Profile Updated Successfully';
                $status=200;
            }else{
                $data=[];
                    $message='Error! Trying to update profile';
                    $status = 400;
            }
        } catch (\Throwable $th) {
            //throw $th;
            $data = [];
            $message = $th->getMessage();
            $status = 400;
        }

        $resData = ['data' => $data, 'message' => $message, 'status' => $status];

        return $this->returnJSON($resData, $status);
    }

    //function to login
    public function login(Request $req){

            $validator=Validator::make($req->all(), [
                'email' => 'required',
                'password' => 'required', 
            ]);

           if(! Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $data=[];
            $message='Invalid Credentials';
            $status=404;
            $resData = ['data' => $data, 'message' => $message, 'status' => $status];
            return $this->returnJSON($resData, $status);
           }else{
            $data=auth()->user();
            $message ='Login Successful';
            $status=200;

            $resData = ['data' => $data, 'message' => $message, 'status' => $status];
            return $this->returnJSON($resData, $status);
           }
            
        
        
    }


    public function returnJSON($data, $status)
    {
        return response()->json($data, $status);
    }










}


?>