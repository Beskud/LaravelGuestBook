<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class ControllerRegistration extends Controller
{
    public $user;
	
	public function Index()
	{
		if (Session::has('auth') && Session::get('auth')) {
			return redirect('main');
		} else {
			return redirect('registration');
		}
		
	}
	public function registration(Request $request)
	{
		$redirect_to = '/main';	

		if (session()->exists('auth'))  return redirect('main');
	

		if (
			$request->input('email') && $request->input('username') &&
			$request->input('password') && $request->input('confirmation_password')
		) {
			$email = $request->input('email');
			$username = $request->input('username');
			$password = $request->input('password');
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$confirmation_password = $request->input('confirmation_password');
			$user = User::create([
                'email' => $email,
                'username' => $username,
                'password' => $password_hash
            ]);
			if (!empty($user)) {
				session(['auth' => true]);
				session(['user_data' => $user]);
			}
		}

		// $validate = ValidationUserMethod($email, $username, $password, $confirmation_password);
		
		// if (!$validate) {
		// 	$redirect_to = '/registration'; 
		// } else {
		// 	$setUser = $this->user->setUser($email, $username, $password);
		// 	if (!$setUser) {
		// 		session()->put('error.email', 'This email or username already exists');
		// 		$redirect_to = '/registration';
		// 	} 
		// }
		return redirect($redirect_to);
	}
}
