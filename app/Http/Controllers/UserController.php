<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('user.edit');
   }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

       $user=User::find($id);


       $validator = Validator::make($request->all(), [
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255']

     ]);

       if ($validator->fails()) {
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $aux=User::where('email',$request->input('email'))->first();

    if($user->email==$request->input('email') || $aux==null){
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->save();
        return  redirect()->back()->with('status', 'Registro actualizado exitosamente!!');   


    }

    return  redirect()->back()->with('error', 'Email ya se encuentra en uso!!');   



}

}
