<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function deleteAccount(Request $request)
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        
        return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
    }
}