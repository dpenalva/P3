<?php

namespace App\Http\Controllers;

use App\Models\Llista;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnuncioCicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Llistas/Index', [
            'llistas' => Llista::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Llistas/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:llistas',
            'descripcion' => 'nullable|string'
        ]);

        Llista::create($request->all());

        return redirect()->route('llistas.index')->with('success', 'Lista creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Llista $llista)
    {
        $llista->loadCount('cicles');
        $llista->load('cicles');
        
        return Inertia::render('Llistas/Show', [
            'llista' => $llista
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Llista $llista)
    {
        return Inertia::render('Llistas/Edit', [
            'llista' => $llista
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Llista $llista)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:llistas,nombre,' . $llista->id,
            'descripcion' => 'nullable|string'
        ]);

        $llista->update($request->all());

        return redirect()->route('llistas.index')->with('success', 'Lista actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Llista $llista)
    {
        if ($llista->cicles()->count() > 0) {
            if (request()->header('X-Inertia')) {
                return back()->with('error', 'No se puede eliminar esta lista porque tiene ciclos asociados.');
            }
            return redirect()->route('llistas.index')->with('error', 'No se puede eliminar esta lista');
        }
        
        $llista->delete();
        
        if (request()->header('X-Inertia')) {
            return back()->with('success', 'Lista eliminada exitosamente');
        }
        
        return redirect()->route('llistas.index')->with('success', 'Lista eliminada exitosamente.');
    }
}
