<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Totalbooking;
use App\Models\Allcholi;
use App\Models\Bridalcholi;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TotalbookingController extends Controller
{
    // ... (index method is fine)
    public function index()
    {
        $admin = Session::get('admin');
        if (!$admin) return redirect('/');

        $bookings = Totalbooking::all();

        // Ensure you are passing the correct choli_name (assuming it exists in your choli models)
        $allCholis = Allcholi::pluck('choli_no', 'choli_no');
        $bridalCholis = Bridalcholi::pluck('choli_no', 'choli_no');
        $cholis = $allCholis->merge($bridalCholis);

        return view('totalbooking', compact('bookings', 'cholis'));
    }

    // ... (omitted includes and index method, which is fine)

    public function store(Request $request)
    {
        // --- FIX: Consolidate all validation rules and custom messages into one call ---
        $validated = $request->validate([
             'bill_no'        => 'required|string|max:50|unique:totalbookings,bill_no', // Unique check is here
            'choli_no'       => 'required|string|max:50',
            'choli_name'     => 'nullable|string|max:255',
            'customer_name'  => 'required|string|max:255',
            'contact_number' => 'required|string|digits:10',
            'delivery_date'  => 'required|date',
            'return_date'    => 'required|date|after_or_equal:delivery_date',
            'deposit_price'  => 'required|numeric|min:0', // Changed min:1 to min:0
            'rent_price'     => 'required|numeric|min:1',
        ], [
            // Custom error message for the unique check
            'bill_no.unique' => '❌ બિલ નંબર પહેલેથી જ અસ્તિત્વમાં છે. (Bill No. already exists.)',
            // Optional: Add other custom messages here
            'deposit_price.required' => 'ડિપોઝિટ ફીલ્ડ આવશ્યક છે. (Deposit field is required.)',
            'deposit_price.min' => 'ડિપોઝિટ કિંમત 0 અથવા વધુ હોવી જોઈએ. (Deposit price must be 0 or more.)',
        ]);
        // -----------------------------------------------------------------------------

        $photo = null;
        $choliName = $validated['choli_name'] ?? null; // Use validated choli_name

        // Find or create the customer record first
        $customer = Customer::firstOrCreate(
            ['contact_number' => $validated['contact_number']],
            ['customer_name' => $validated['customer_name']]
        );
        

        // ✅ Try to find choli in Allcholi table first
        $allCholi = Allcholi::where('choli_no', $validated['choli_no'])->first();

        // ✅ If not found, try Bridalcholi
        $bridalCholi = Bridalcholi::where('choli_no', $validated['choli_no'])->first();

        // ✅ Determine which one is valid
        if ($allCholi) {
            $photo = $allCholi->photo ?? null;
            $choliName = $choliName ?? $allCholi->choli_name ?? $allCholi->name ?? 'Unnamed Choli';
        } elseif ($bridalCholi) {
            $photo = $bridalCholi->photo ?? null;
            $choliName = $choliName ?? $bridalCholi->choli_name ?? $bridalCholi->name ?? 'Unnamed Bridal Choli';
        }

        try {
            Totalbooking::create([
                'vendor_id'      => $request->vendor_id,
                'bill_no'        => $validated['bill_no'],
                'choli_no'       => $validated['choli_no'],
                'choli_name'     => $choliName,
                'customer_name'  => $validated['customer_name'],
                'contact_number' => $validated['contact_number'],
                'delivery_date'  => $validated['delivery_date'],
                'return_date'    => $validated['return_date'],
                'rent_price'     => $validated['rent_price'],
                'deposit_price'  => $validated['deposit_price'],
                'photo'          => $photo,
            ]);

            return redirect()->route('totalbooking.index')->with('success', 'Booking added successfully!'); // Changed route() argument to totalbooking.index (assumed)
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $booking = Totalbooking::findOrFail($id);
        return view('edit_booking', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Totalbooking::findOrFail($id);

        $booking->bill_no = $request->bill_no;
        $booking->choli_no = $request->choli_no;
        $booking->customer_name = $request->customer_name;
        $booking->choli_name = $request->choli_name;
        $booking->contact_number = $request->contact_number;
        $booking->delivery_date = $request->delivery_date;
        $booking->return_date = $request->return_date;
        $booking->rent_price = $request->rent_price;
        $booking->deposit_price = $request->input('deposit_price', 0);
        $booking->deposit_price = $request->deposit_price;

        $booking->save();

        return redirect()->back()->with('success', 'Booking updated successfully!');
    }



    public function destroy($id)
    {
        $booking = Totalbooking::findOrFail($id);
        $booking->delete();

        return redirect()->route('totalbooking')->with('success', 'Booking deleted successfully!');
    }
    public function customer()
    {
        $AllCustomer = Customer::all();
        return view('customer', compact('AllCustomer'));
    }



    public function downloadBill($id)
    {
        $booking = Totalbooking::findOrFail($id);

        $pdf = Pdf::loadView('bill', compact('booking'));

        // ⭐ THIS CONFIGURATION IS THE PRIMARY FIX FOR FONT ISSUES ⭐
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans' // FORCES Dompdf to use Unicode support
        ]);

        $customerNameSlug = Str::slug($booking->customer_name ?? 'Bill');

        return $pdf->download('invoice-' . $customerNameSlug . '-' . $booking->bill_no . '.pdf');
    }

    public function totalbooking()
    {
        // બુકિંગનો ડેટા ફેચ કરો
        $bookings = DB::table('totalbookings')->get(); 
        
        // તમારા ડેશબોર્ડ કે બુકિંગ પેજ પર ડેટા મોકલો
        return view('totalbooking', compact('bookings'));
    }
    
}
