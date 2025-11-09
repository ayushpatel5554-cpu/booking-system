<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BridalCholi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class BridalCholiController extends Controller
{
    /**
     * Display list of bridal cholis
     */
    public function index()
    {
        $bridalCholis = BridalCholi::all();
        return view('bridelcholi', compact('bridalCholis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'choli_no'   => 'required|unique:bridalcholi',
            'choli_name' => 'required|string|max:255',
            'rent_price' => 'required|numeric|min:100',
            
            // FIX: Change 'nullable' to 'required'
            'photo'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        // The rest of your storage logic is correct:
        $path = $request->file('photo')->store('bridal_cholis', 'public');

        BridalCholi::create([
            'choli_no'   => $request->choli_no,
            'choli_name' => $request->choli_name,
            'rent_price' => $request->rent_price,
            'photo'      => $path, // $path is guaranteed to be set here
        ]);

        return redirect()->route('bridelcholi')->with('success', 'Bridal Choli added successfully!');
    }

    /**
     * Update bridal choli
     */
    public function update(Request $request, $id)
    {
        $choli = BridalCholi::findOrFail($id);

        $request->validate([
            'choli_no'   => 'required|string|max:255|unique:bridalcholi,choli_no,' . $id,
            'choli_name' => 'required|string|max:255',
            'rent_price' => 'required|numeric|min:100',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $choli->choli_no   = $request->choli_no;
        $choli->choli_name = $request->choli_name;
        $choli->rent_price = $request->rent_price;

        if ($request->hasFile('photo')) {
            if ($choli->photo && Storage::exists('public/' . $choli->photo)) {
                Storage::delete('public/' . $choli->photo);
            }
            $path = $request->file('photo')->store('bridal_cholis', 'public');
            $choli->photo = $path;
        }

        $choli->save();

        return redirect()->route('bridelcholi')->with('success', 'Bridal Choli updated successfully!');
    }

    /**
     * Delete bridal choli
     */
    public function destroy($id)
    {
        $choli = BridalCholi::findOrFail($id);

        if ($choli->photo && Storage::exists('public/' . $choli->photo)) {
            Storage::delete('public/' . $choli->photo);
        }

        $choli->delete();

        return redirect()->route('bridelcholi')->with('success', 'Bridal Choli deleted successfully!');
    }
    public function bridalcholi()
{
    $admin = Session::get('admin');
    if ($admin) {
        $bridalCholis = BridalCholi::all();
        return view('bridelcholi', compact('bridalCholis'));
    } else {
        return redirect('login');
    }
}
}
