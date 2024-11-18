<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function destroy(Request $request)
    {
        $user = Auth::user();
        
        // Logout user
        Auth::logout();
        
        // Delete the user
        $user->delete();
        
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}