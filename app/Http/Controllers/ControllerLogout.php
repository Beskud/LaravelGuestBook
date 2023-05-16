<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ControllerLogout extends Controller
{
    public function index(Request $request) {

        $request->session()->invalidate();
        return redirect('authorization');
    }
}
