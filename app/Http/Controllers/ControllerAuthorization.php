<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ControllerAuthorization extends Controller
{
	public function Index()
{
    if (Session::has('auth') && Session::get('auth')) {
		return redirect('main');
    } else {
		return view('authorization')->render();
	}
	
}

	public function Authorization(Request $request)
	{
		if (Session::has('auth') && Session::get('auth')) return redirect('main');
		if (!empty($request->input('email')) && !empty($request->input('password'))) {
			$email = $request->input('email');
			$password = $request->input('password');
			$user = User::where('email', $email)->first();
			
			if ($user && password_verify($password, $user['password'])) {
				if (!empty($user)) {
					session(['auth' => true]);
					session(['user_data' => $user]);
				}
				return redirect('main');
			} else {
				session(['error' => 'Неправильный email или пароль.']);
                return redirect('authorization');
			}	
		}	
	}	
}











?>