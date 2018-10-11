<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Model\admin\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
/*
* Ensure the user is signed in to access this page
*/
public function __construct() {

$this->middleware('auth:admin');

}
/**
* Show the form to change the user password.
*/
public function index(){
return view('admin.user.change-password');
}

/**
* Update the password for the user.
*
* @param  Request  $request
* @return Response
*/
public function update(Request $request)
{
$this->validate($request, [
'old' => 'required',
'password' => 'required|min:6|confirmed',
]);

$users = Admin::find(Auth::id());
$hashedPassword = $users->password;

if (Hash::check($request->old, $hashedPassword)) {
//Change the password
$users->fill([
'password' => Hash::make($request->password)
])->save();

$request->session()->flash('success', 'Paswordi juaj u ndryshua.');

return back();
}

$request->session()->flash('failure', 'Paswordi juaj nuk u ndryshua kontrolloni dhe njehere te dhenat.');
return back();


}
}