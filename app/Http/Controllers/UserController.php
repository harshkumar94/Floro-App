<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\DB;

class UserController extends Controller
{
    //
    
    public function index(Request $request)
    {
        $users = User::sortable()->paginate(10);
        // $users = User::paginate(10);
        // if ($request->has('sort')) {

        //     $users=User::orderBy($request->get('sort'), $request->get('direction'))->paginate(10);
           
            
        //     }
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

    // public function sort(Request $request,$direction)
    // {
    //     $sort = $request->get('sort');

    //     $users = DB::table('users')->where('username','like','%'.$sort.'%')
    //     ->orWhere('first_name','like','%'.$sort.'%')
    //     ->orWhere('last_name','like','%'.$sort.'%')
    //     ->orWhere('email','like','%'.$sort.'%')->paginate(10);
        
    //     return view('/home',[ 'users' =>$users]);
    // }

    public function search(Request $request)
    {   
       $search = $request->get('search');
    //    dd($search);
       $users = \DB::table('users')->where('username','like','%'.$search.'%')
                                        ->orWhere('first_name','like','%'.$search.'%')
                                        ->orWhere('last_name','like','%'.$search.'%')
                                        ->orWhere('email','like','%'.$search.'%')->paginate(10);
       return view('/home',[ 'users' =>$users]);
    }
}
