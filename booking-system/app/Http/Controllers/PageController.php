<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\BridalCholi; // Import the BridalCholi model
use App\Models\AllCholi;    // Assuming you have an AllCholi model
use App\Models\Customer;
use App\Models\Totalbooking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    // Dashboard page
    public function dashboard()
    {
        if (!Session::has('admin')) {
            return redirect('login');
        }
        
        try {
            $totalbooking=Totalbooking::count();
            $bridalCholiCount = BridalCholi::count();
            $rentPrices = Totalbooking::pluck('rent_price');
            $totalRevenue = $rentPrices->sum();
            $allCholiCount = AllCholi::count();
            $Allcustomer=Customer::count();

            $totalCholiStock = $bridalCholiCount + $allCholiCount;

        } catch (\Exception $e) {
            $totalCholiStock = 0;
        }
        
        return view('welcome', compact('totalCholiStock','totalbooking','totalRevenue','Allcustomer'));
    }
    public function login()
    {
        return view('login');
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ], [
            'email.required' => 'Please Enter Email.',
            'email.email' => 'Please Enter a valid Email.',
            'password.required' => 'Please Enter Password.',
            'password.min' => 'Password must be at least 6 characters.'
        ]);

        // Find admin by email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Admin Does Not Exist'])->withInput();
        }

        // Check password (USE Hash::check if passwords are hashed in the database)
        if ($admin->password !== $request->password) { 
            // Recommended: if (Hash::check($request->password, $admin->password)) { ... }
            return back()->withErrors(['password' => 'Incorrect Password'])->withInput();
        }

        // Save admin info in session
        Session::put('admin', $admin);

        return redirect('dashboard');
    }

    // Admin logout
    public function adminlogout()
    {
        Session::forget('admin'); // remove session
        Session::flush(); // optional: remove all session data
        return redirect('login');
    }
}