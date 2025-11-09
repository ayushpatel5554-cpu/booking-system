<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allcholi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AllCholiController extends Controller
{
    /**
     * Store a newly created Choli in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'choli_no'     => 'required|unique:allcholi,choli_no',
            'choli_name'   => 'required|string',
            'rent_price'   => 'required|numeric',
            'choli_photo'  => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Upload photo
        $photoPath = $request->file('choli_photo')->store('cholis', 'public');

        // Save to DB
        $choli = new Allcholi();
        $choli->choli_no     = $request->choli_no;
        $choli->choli_name   = $request->choli_name;
        $choli->rent_price   = $request->rent_price;
        $choli->photo  = $photoPath; // ✅ use correct column name
        $choli->save();

        return redirect()->back()->with('success', 'Choli added successfully!');
    }

    /**
     * Show all Cholis (for listing).
     */
    public function index()
    {
        $cholis = Allcholi::latest()->get();
        return view('allcholi', compact('cholis'));
    }

    /**
     * Delete Choli
     */
    public function destroy($id)
    {
        $choli = Allcholi::findOrFail($id);

        // Delete photo if exists
        if ($choli->photo && Storage::disk('public')->exists($choli->photo)) {
            Storage::disk('public')->delete($choli->photo);
        }

        $choli->delete();

        return redirect()->back()->with('success', 'Choli deleted successfully!');
    }

    /**
     * Show all cholis page (with admin session check).
     */
    public function allcholi()
    {
        $admin = Session::get('admin');
        if ($admin) {
            // ✅ Get all cholis
            $cholis = Allcholi::latest()->get();
            return view('allcholi', compact('cholis'));
        } else {
            return redirect('login');
        }
    }
    public function update(Request $request, $id)
    {
        $choli = Allcholi::findOrFail($id);

        $request->validate([
            'choli_no' => 'required|string|max:255',
            'choli_name' => 'required|string|max:255',
            'rent_price' => 'required|numeric|min:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $choli->choli_no = $request->choli_no;
        $choli->choli_name = $request->choli_name;
        $choli->rent_price = $request->rent_price;

        if ($request->hasFile('photo')) {
    // Delete old photo if exists
    if ($choli->photo && Storage::exists('public/' . $choli->photo)) {
        Storage::delete('public/' . $choli->photo);
    }

    // Store new photo
    $path = $request->file('photo')->store('cholis', 'public');
    $choli->photo = $path;
}


        $choli->save();

        return redirect()->route('choli.index')->with('success', 'Choli updated successfully!');
    }
}
