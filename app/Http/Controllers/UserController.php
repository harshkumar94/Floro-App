<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    
    public function index()
    {
        $users = User::paginate(10);
        return view('home',compact('users'));
    }


    public function create() {
        // $user->name = request('name');
        return view('create');
    }

    public function store(Request $request){




        $this->validate($request, [
            'username' => 'required|min:3|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $user=new User();
        $user->username=request('username');
        $user->email=request('email');
        $user->password=Hash::make(request('password'));
        $user->first_name=request('first_name');
        $user->last_name=request('last_name');
        $user->address=request('address');
        $user->house_number=request('house_number');
        $user->postal_code=request('postal_code');
        $user->city=request('city');
        $user->telephone_number=request('telephone_number');
        // $user->active=request('active');
        $user->save();
         
          
        return redirect('/users');
    }

    public function edit($id){
        // dd($id);
        $user=User::findOrFail($id);
        return view('edit',compact('user'));

    }

    public function update($id){
        // $user->update(request(['username','email','password','first_name','last_name','address','house_number','postal_code','city','telephone_number']));
        $user=User::findOrFail($id);
        
        // $oldUser = $user;
        

        $user->username=request('username');
        $user->email=request('email');
        // $user->password=Hash::make(request('password'));
        $user->first_name=request('first_name');
        $user->last_name=request('last_name');
        $user->address=request('address');
        $user->house_number=request('house_number');
        $user->postal_code=request('postal_code');
        $user->city=request('city');
        $user->telephone_number=request('telephone_number');

        // echo "<pre>";

        
        // print_r($user->getOriginal());

        //  $user->save();
        
        

        
        // echo PHP_EOL;
        // print_r($user->toArray()); 
        
        // exit;

        $record1=$user->getOriginal();
        $record=$user->getDirty();
        $user->save();
        $user->getDirty(); 
        if ($user->exists && count($record) > 0) {
        $primarykey = isset($user->primarykey) ? $user->primarykey : 'id';
        //Auth::user()->user_name
        foreach ($record as $key => $value) {
        $change = new User_Activity();
        $change->user_id = $user->{$primarykey};
        $change->modified_by= $user->username;
        $change->field_name = $key;
        //$change->old_value = $user->getOriginal($k);
        $change->old_value = $record1[$key];
        $change->modified_value = $value;
        $change->save(); 
        }
     }
        return redirect('/users');
    
    
    }

    public function destroy(User $user){
        $user->delete();
        return redirect('/users');
    }
}
