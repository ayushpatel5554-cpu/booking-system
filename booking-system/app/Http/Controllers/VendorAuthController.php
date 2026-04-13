<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\BridalCholi; 
use App\Models\AllCholi;  
use App\Models\Customer;
use App\Models\Totalbooking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VendorAuthController extends Controller
{
    /**
     * 🟢 વેન્ડર ડેશબોર્ડ - ડેટા સાથે કનેક્ટ કરો
     */
    public function dashboard()
    {
        // જો સેશનમાં વેન્ડર ન હોય તો લોગિન પર મોકલો
        if (!Session::has('vendor_id')) {
            return redirect()->route('vendor.login');
        }

        $v_id = Session::get('vendor_id');

        // ૧. વેરીએબલ્સને ડિફોલ્ટ વેલ્યુ આપો (એરર રોકવા માટે)
        $totalbooking = 0;
        $totalRevenue = 0;
        $totalCholiStock = 0;
        $Allcustomer = 0;
        $topcholis = collect();

        try {
            // ૨. વેન્ડર મુજબ ફિલ્ટર કરેલી ક્વેરીઝ
            $bookingQuery = Totalbooking::where('vendor_id', $v_id);
            
            $totalbooking = $bookingQuery->count();
            $totalRevenue = $bookingQuery->sum('rent_price');
            
            // ૩. સ્ટોક ગણતરી (AllCholi + BridalCholi)
            $bridalCount = BridalCholi::where('vendor_id', $v_id)->count();
            $allCount = AllCholi::where('vendor_id', $v_id)->count();
            $totalCholiStock = $bridalCount + $allCount;

            $Allcustomer = Customer::count();

            // ૪. ટોપ ૫ રેન્ટેડ આઈટમ્સ
            $topcholis = (clone $bookingQuery)
                ->select('choli_name', DB::raw('MAX(choli_no) as choli_no'), DB::raw('count(*) as total_rents'))
                ->groupBy('choli_name')
                ->orderBy('total_rents', 'desc')
                ->take(5)
                ->get();

        } catch (\Exception $e) {
            Log::error("Vendor Dashboard Error: " . $e->getMessage());
        }

        // ૫. બધો જ ડેટા વ્યૂમાં મોકલો જેથી Undefined variable એરર ન આવે
        return view('vendor.dashboard', compact('totalCholiStock', 'totalbooking', 'totalRevenue', 'Allcustomer', 'topcholis'));
    }

    public function showLogin()
    {
        // જો પહેલેથી લોગિન હોય તો સીધું ડેશબોર્ડ પર મોકલી દો
        if (Session::has('vendor_id')) {
            return redirect()->route('vendor.dashboard');
        }
        return view('vendor.login');
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'    => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $vendor = Vendor::where('email', $request->email)->first();

    //     if ($vendor && Hash::check($request->password, $vendor->password)) {
    //         Session::put('vendor_id', $vendor->id);
    //         Session::put('vendor_name', $vendor->shop_name);
    //         Session::forget('admin');

    //         return redirect()->route('vendor.dashboard')->with('success', 'લોગિન સફળ રહ્યું!');
    //     }

    //     return back()->with('error', 'email or password are wrong!');
    // }
    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $vendor = Vendor::where('email', $request->email)->first();

    if ($vendor && Hash::check($request->password, $vendor->password)) {
        
        // --- ટ્રાયલ અને પેમેન્ટ ચેક કરવાનું લોજિક ---
        if ($vendor->is_paid == 0) { 
            // Carbon નો ઉપયોગ કરીને એક્સપાયરી ચેક કરો
            $trialEnds = \Carbon\Carbon::parse($vendor->trial_ends_at);
            
            if (\Carbon\Carbon::now()->gt($trialEnds)) {
                // જો ટ્રાયલ પૂરો થઈ ગયો હોય
                return back()->with('error', 'Your Payment has pending. Please contact the admin for payment.');
            }
        }
        // ------------------------------------------

        // સેશન સેટ કરો
        Session::put('vendor', $vendor); 
        Session::put('vendor_id', $vendor->id);
        Session::put('vendor_name', $vendor->shop_name);
        Session::forget('admin');

        return redirect()->route('vendor.dashboard')->with('success', 'લોગિન સફળ રહ્યું!');
    }

    return back()->with('error', 'email or password are wrong!');
}

    public function logout()
{
    if (session()->has('vendor_id')) {
        // લોગઆઉટ વખતે સમયને ૧૦ મિનિટ પાછળ કરી દો
        DB::table('vendors')
            ->where('id', session('vendor_id'))
            ->update(['last_seen' => now()->subMinute(10)]);
            
        session()->forget('vendor_id');
    }

    return redirect()->route('vendor.login');
}

    public function manageVendors()
{
    // ૧. ચેક કરો કે એડમિન લોગિન છે કે નહીં
    if (session()->has('admin')) {
        
        // ૨. જો એડમિન હોય, તો જ ડેટા ફેચ કરો
        $AllVendors = DB::table('vendors')
            ->orderBy('id', 'desc')
            ->get();

        return view('vendor', compact('AllVendors'));
    } 

    // ૩. જો એડમિન અસ્તિત્વમાં (Session માં) ન હોય, તો લોગિન પેજ પર મોકલી દયો
    return redirect('/admin/login')->with('error', 'Please Login First!');
}

    public function destroyVendor($id)
    {
        $deleted = DB::table('vendors')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Vendor deleted successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong!');
    }

    public function storeVendor(Request $request)
{
    // ડેટા વેલિડેશન
    $request->validate([
        'shop_name' => 'required',
        'email' => 'required|email|unique:vendors,email',
        'password' => 'required|min:6', // ઓછામાં ઓછા 6 અક્ષરનો પાસવર્ડ
    ]);

    // ડેટાબેઝમાં ઇન્સર્ટ કરો
    DB::table('vendors')->insert([
        'shop_name'      => $request->shop_name,
        'owner_name'     => $request->owner_name,
        'contact_number' => $request->contact_number,
        'email'          => $request->email,
        // અહિયાં હવે ફોર્મમાંથી આવેલો પાસવર્ડ હેશ (Hash) થશે
        'password'       => Hash::make($request->password), 
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);

    return redirect()->back()->with('success', 'vendor added successfull!');
}

public function updateVendor(Request $request, $id)
{
    // 1. ડેટા વેલિડેશન (expired_at ઉમેર્યું)
    $request->validate([
        'shop_name'  => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'is_paid'    => 'required|in:0,1',
        'expired_at' => 'required|date', // તારીખ વેલિડેશન ઉમેર્યું
    ]);

    // 2. વેન્ડર ચેક કરો
    $vendor = DB::table('vendors')->where('id', $id)->first();
    if (!$vendor) {
        return redirect()->back()->with('error', 'Vendor not found!');
    }

    // 3. અપડેટ કરવા માટેનો ડેટા તૈયાર કરો
    $updateData = [
        'shop_name'  => $request->shop_name,
        'owner_name' => $request->owner_name,
        'is_paid'    => $request->is_paid,
        'expired_at' => $request->expired_at, // આ લાઈન ડેટાબેઝમાં તારીખ સેવ કરશે
        'created_at' => $request->updated_at,
    ];

    // 4. જો નવો પાસવર્ડ નાખ્યો હોય તો જ બદલો
    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    // 5. ડેટાબેઝ અપડેટ કરો
    DB::table('vendors')->where('id', $id)->update($updateData);

    return redirect()->back()->with('success', 'Vendor updated successfully!');
}

public function showRegisterForm()
    {
        return view('vendor.register'); // ખાતરી કરો કે resources/views/vendor/register.blade.php ફાઈલ બનાવેલી છે
    }

public function register(Request $request) {
    // વેલિડેશન લોજિક...
    
    // આજથી ૭ દિવસ પછીની તારીખ
    $trialExpiry = Carbon::now()->addDays(7);

    DB::table('vendors')->insert([
        'shop_name' => $request->shop_name,
        'owner_name' => $request->owner_name,
        'contact_number' => $request->contact_number,
        'email' => $request->email,
        'address' => $request->address,
        'password' => Hash::make($request->password),
        'status' => 1,
        'is_paid' => 1, 
        'trial_ends_at' => $trialExpiry,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('vendor.login')->with('success', 'Registration successful! Your 7-day free trial has started.');
}
}