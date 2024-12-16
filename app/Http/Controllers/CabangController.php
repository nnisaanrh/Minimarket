<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cabangs'] -> all();
        return view('cabangs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "namacabang" => 'required|max:50',
            "alamatcabang" => 'required|max:100',
            "kota" => 'required|max:50'
        ]);
        cabangs::create($validated);

        $notification = array( 
            'message' => 'Cabang berhasil dihapus', 
            'alert-type' => 'success' 
        );
        if($request->save == true) return redirect()->route('cabang')->with($notification);
        else return redirect()->route('cabang.create')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['cabans'] = cabang::FindOrFail($id);
        return view('cabangs.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, cabang $cabang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cabang $cabang)
    {
        //
    }
}
