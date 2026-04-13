<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\BridalCholi;
use App\Models\AllCholi;
use App\Models\Customer;
use App\Models\Totalbooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * એડમિન ડેશબોર્ડ - તમામ વેન્ડરનો સંયુક્ત ડેટા બતાવશે
     */
    public function dashboard()
    {
        if (!Session::has('admin')) {
            return redirect('/admin/login');
        }

        // ડિફોલ્ટ વેલ્યુ
        $totalbooking = 0;
        $totalRevenue = 0;
        $Allcustomer = 0;
        $totalCholiStock = 0;
        $topcholis = collect();

        try {
            // એડમિન માટે કોઈ ફિલ્ટર વગર આખી સિસ્ટમનો ડેટા ખેંચો
            $totalbooking = Totalbooking::count();
            $totalRevenue = Totalbooking::sum('rent_price');
            
            $bridalCholiCount = BridalCholi::count();
            $allCholiCount = AllCholi::count();
            $totalCholiStock = $bridalCholiCount + $allCholiCount;
            
            $Allcustomer = Customer::count();

            // આખી સિસ્ટમમાં સૌથી વધુ ભાડે જતી ટોપ 5 ચોલી
            $topcholis = Totalbooking::select('choli_name', DB::raw('MAX(choli_no) as choli_no'), DB::raw('count(*) as total_rents'))
                ->groupBy('choli_name')
                ->orderBy('total_rents', 'desc')
                ->take(5)
                ->get();

        } catch (\Exception $e) {
            Log::error("Admin Dashboard Error: " . $e->getMessage());
        }

        return view('welcome', compact('totalCholiStock', 'totalbooking', 'totalRevenue', 'Allcustomer', 'topcholis'));
    }

    /**
     * એડમિન લોગિન વ્યૂ
     */
    public function login()
    {
        return view('login');
    }

    /**
     * એડમિન લોગિન પ્રોસેસ
     */
    public function adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ], [
            'email.required' => 'ઈમેઈલ જરૂરી છે.',
            'password.required' => 'પાસવર્ડ જરૂરી છે.'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Admin Not exist with this email or password!'])->withInput();
        }

        // પાસવર્ડ ચેક (જો હેશેડ હોય તો Hash::check વાપરવું)
        if ($admin->password !== $request->password) { 
            return back()->withErrors(['password' => 'ખોટો પાસવર્ડ.'])->withInput();
        }

        Session::put('admin', $admin);
        return redirect('/admin/dashboard');
    }

    /**
     * એડમિન લોગઆઉટ
     */
    public function adminlogout()
    {
        Session::forget('admin');
        Session::flush(); 
        return redirect('/admin/login');
    }
    
    public function setting(){
        return view ('setting');
    }
    public function updatePassword(Request $request)
{
    // 1. વેલિડેશન - ખાતરી કરો કે પાસવર્ડ મજબૂત હોય અને કન્ફર્મ પાસવર્ડ સાથે મેચ થાય
    $request->validate([
        'new_password' => 'required|min:6|confirmed', 
    ], [
        'new_password.confirmed' => 'બંને પાસવર્ડ મેચ થતા નથી!',
        'new_password.min' => 'પાસવર્ડ ઓછામાં ઓછો 6 અક્ષરનો હોવો જોઈએ.',
    ]);

    // 2. એડમિનનો ડેટાબેઝ રેકોર્ડ શોધો
    $adminId = session('admin.id');

    if (!$adminId) {
        return back()->with('error', 'સેશન એક્સપાયર થઈ ગયું છે, ફરી લોગિન કરો.');
    }

    // 3. ડાયરેક્ટ નવો પાસવર્ડ અપડેટ કરો (જૂનો પાસવર્ડ ચેક કર્યા વગર)
    DB::table('admin')->where('id', $adminId)->update([
        'password' => Hash::make($request->new_password),
        'updated_at' => now()
    ]);

    return back()->with('success', 'એડમિન પાસવર્ડ સફળતાપૂર્વક બદલાઈ ગયો છે!');
}


}