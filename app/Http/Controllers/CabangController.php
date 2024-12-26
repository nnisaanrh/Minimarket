<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabangs = Cabang::all(); // Mengambil semua data cabang
        return view('cabang.index', compact('cabangs')); // Mengirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(cabang.create);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'required|max:100',
            'alamat'=> 'required|max:255',
            'kota'=> 'required|max:50'
        ]);

        Cabang::create($validated);

        return redirect()->route('cabang.index')->with('success','data berhasil di tambah');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang, string $id)
    {
        $cabang = Cabang::finOrfail($id);
        return view(cabang.edit, compact ($cabang));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $cabang = Cabang::finOrfail($id);
        $validated = $request->validate([
            'name'=> 'required|max:100',
            'alamat'=> 'required|max:255',
            'kota'=> 'required|max:50'
        ]);

        Cabang::update($validated);
        
        return redirect()->route('cabang.index')->with('success','data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        $cabang = Cabang::finOrfail($id);
        Cabang::delete();
    }
}
