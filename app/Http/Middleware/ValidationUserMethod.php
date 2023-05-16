<?php

namespace App\Http\Middleware;

use Closure;

class ValidationUserMethod
{
    public function handle($request, Closure $next)
    {

        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $confirmation_password = $request->input('confirmation_password');


        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[A-Za-z0-9.@]{1,100}$/', $email)) {
            session()->flash('error.email', 'Invalid email format');
            return redirect()->back();
        }
        

        if (!preg_match('/^(?=.*[a-zA-Z])[^\s<>;:\\\\\|\/\[\]\{\}\?\*\(\)\'\"`]{5,25}$/', $username)) {
            session()->flash('error.username', 'Invalid username format');
            return redirect()->back();
        }

        if ($password != $confirmation_password) {
            session()->flash('error.confirmation_password', 'Password mismatch');
            return redirect()->back();
        }
        
        $pregPass = [
			'digits' => '@[0-9]@',
			'capital letters' => '#[A-Z]+#',
			'lowercase letters' => '#[a-z]+#'
		];

        foreach ($pregPass as $key => $value) {
            
            if (!preg_match($value, $password)) {
                session()->flash('error.password', 'The password is not valid. Does not contain ' . $key);
                return redirect()->back();
            } elseif (!preg_match('/^(?=.*[a-zA-Z])[^\s<>;:\\\\\|\/\[\]\{\}\?\*\(\)\'\"`]{5,25}$/', $password)) {
                session()->flash('error.password', 'Password contains prohibited characters');
                return redirect()->back();
            }
        }
        return $next($request);
    }
}

