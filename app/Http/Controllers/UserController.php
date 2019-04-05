<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Return a listing of users
     *
     */
    public function index()
    {
        //get and return all user list
        $user = User::get();
        return $user->toJson();
    }

    /**
     * Store a new user
     *
     */
    public function store(request $request)
    {        
        $data = $request->all();

        /*
        request parameters validation
        first_name -> required,
        last_name -> required,
        email -> required, unique
        password -> required,
        */   
        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'unique:users,email','string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
        ]);

        if($validator->fails()){ //return if validation fails
            return response()->json($validator->errors(),400);
        }
        
        //store new user
        $user = User::create([
            'name' => $request['first_name'] . " " . $request['last_name'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        
        //response result in json format
        return response()->json([
            'Message' => 'New user created successfully!',
            'User' => $user
        ], 200);
    }

    /**
     * Update the user's informations
     *
     */
    public function update(Request $request, $id)
    {        
        $data = $request->all(); //for validation
        $user = User::find($id); //get existing user's data with id
        
        $updateName = $data['first_name'] . " " . $data['last_name']; //for comparing existing name with new name
        $passwordCheck = Hash::check($request['password'], $user->password); //compare new password with old password

        /*
        request values validation
        first_name -> required,
        last_name -> required,
        email -> required, unique
        */
        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'max:50'],
        ]);
        
        if($validator->fails()){  //return if validation fails
            return response()->json($validator->errors());
        } elseif ($updateName === $user->name && $passwordCheck) { //check at least one field to update
            return response()->json([
                'Message' => 'You must update at least one field',
            ], 400);
        } elseif ($request->filled('email')) { //email cant be updated
            return response()->json([
                'Message' => 'Your email address can not be modified',
            ], 400);
        }        

        //update the user's data
        $user->update([
            'name' => $request['first_name'] . " " . $request['last_name'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'password' => Hash::make($request['password']),
        ]);        
        
        //response result in json format
        return response()->json([
            'Message' => 'The user updated successfully!',
            'User ID' => $user->id,
        ], 200);
    }
}
