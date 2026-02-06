<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller{
// public function index(){
//     /*it takes get method*/
// }
// public function create(){
//     /*it takes get method it send to the adding form(get method)*/ 
// }
// public function store(Request $request){
//     /*adding method(post method)*/ 
// }
// public function show(string $id){
//     /*show operations for one element(get method)*/
// }
// public function edit(string $id){
//     /*send you to editing form(get method)*/
// }
// public function update(Request $request,string $id){
//     /*update data on database(put method)*/
// }
// public function destroy(string $id){
//     /*delete method it takes*/
// }

public function login(Request $request){
    dd($request->all());
    $credentials=$request->validate([
        'email'=>"required|email",
        'password'=>'required',
    ]);
    if(!Auth::attempt($credentials)){
        return response()->json([
        'message'=>'invalid credentials'
    ],401);
}
$user = Auth::user();

$token = $user->createToken('api-token')->plainTextToken;

return response()->json([
    'message'=>'login successfully',
    'token'=>$token,
    'user'=>$user,
]);
}
}