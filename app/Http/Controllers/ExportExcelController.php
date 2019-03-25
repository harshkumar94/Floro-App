<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Excel;

class ExportExcelController extends Controller
{
    //
    // function index(){
    //     $users=User::get();
    //     return view('home',compact('users'));
    // }

    function excel()
    {
        $users= DB::table('users')->get()->toArray();
        $users_array[]=array('username','email','first_name','last_name','address','city','house_number','postal_code','telephone_number','last_login_at');
        foreach($users as $user)
        {
            $users_array[]=array(
                'username'=>$user->username,
                'email'=>$user->email,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'address'=>$user->address,
                'city'=>$user->city,
                'house_number'=>$user->house_number,
                'postal_code'=>$user->postal_code,
                'telephone_number'=>$user->telephone_number,
                'last_login_at'=>$user->last_login_in_at,   
            );  
                
        }
        Excel::create('Users Data',function($excel) use($users_array){
                $excel->setTitle('Users Data');
                $excel->sheet('Customer Data',function($sheet) use($users_array){
                    $sheet->fromArray($users_array,null,'A1',false,false);
                });
        })->download('xlsx');
    }
}
