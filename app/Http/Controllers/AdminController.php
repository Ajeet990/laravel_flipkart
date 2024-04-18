<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function show_login()
    {
        return view('admin/adminLogin');
    }

    public function view_dashboard()
    {
        echo "here";die;
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('adminLogin')->with('message',"Logged out successfully")->with('color', 'success');
        // return view('admin/adminLogin');
    }
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed for admin...
            return view('admin.dashboard');
        } else {
            return redirect('adminLogin')->with([
                'message' => 'Invalid credentials',
                'color' => 'danger'
            ]);
        }
    }
}
