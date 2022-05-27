<?php 

namespace App\Http\Traits;
Use App\Models\User;

trait Customers{
    public function getdetails($id){
        $data=User::where('id',$id)->first();
            return $data;
    }

}













?>