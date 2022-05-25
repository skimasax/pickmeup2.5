<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Home;

class HomeController extends Controller
{
    //function for message from homepage

    public function message(Request $req){
        $validation=Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        
        Home::insert([
            'name' => $req->name,
            'email' => $req->email,
            'message' => $req->message
        ]);

        $response=[
            'status' => 'success'
        ];

        return response($response,200);
    

    }
}
