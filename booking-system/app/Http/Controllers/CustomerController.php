<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
class CustomerController extends Controller
{
    public function customer()
{
    $admin = Session::get('admin');

    if (!$admin) { 
        return redirect('login');
    }
    $AllCustomer = Customer::all(); 
    return view('customer', compact('AllCustomer')); 
}
public function destroyCustomer($id)
    {
        try {
            $customer = Customer::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('customer')->with('error', 'Customer not found!');
        }
        $customer->delete();
        return redirect()->route('customer')->with('success', 'Customer successfully deleted!');
    }
    
}
