<?php

namespace App\Http\Controllers;

use App\Models\Cicles;
use App\Models\Familia;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class LlistasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cicles::query();
        
        // Filtro por familia
        if ($request->has('familia') && $request->familia != '') {
            $query->where('familia_id', $request->familia);
        }
        
        // Búsqueda por texto
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Nom del Cicle', 'like', "%{$search}%")
                  ->orWhere('Nivell', 'like', "%{$search}%")
                  ->orWhere('Descripció', 'like', "%{$search}%");
            });
        }
        
        $cicles = $query->paginate(3);
        
        $familias = Familia::all();
        
        return Inertia::render('Cicles/Index', [
            'cicles' => $cicles,
            'familias' => $familias,
            'filters' => $request->only(['search', 'familia'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $familias = Familia::all();
        
        return Inertia::render('Cicles/Create', [
            'familias' => $familias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nom del Cicle' => 'required|string|max:255',
            'Descripció' => 'required|string|max:255',
            'Email' => 'required|string|max:255',
            'date' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'familia_id' => 'required|exists:familias,id',
        ]);
        
        $familia = Familia::find($request->familia_id);
        
        $data = $request->all();
        
        if ($familia) {
            $data['Família'] = $familia->nombre;
        }
        
        Cicles::create($data);

        return redirect()->route('cicles.index')->with('success', 'Cicle creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cicles $cicle)
    {
        return Inertia::render('Cicles/Show', [
            'cicle' => $cicle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cicles $cicle)
    {
        // Obtener todas las familias para pasarlas al formulario
        $familias = Familia::all();
        
        return Inertia::render('Cicles/Edit', [
            'cicle' => $cicle,
            'familias' => $familias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cicles $cicle)
    {
        $request->validate([
            'Nom del Cicle' => 'required|string|max:255',
            'Descripció' => 'required|string|max:255',
            'Email' => 'required|string|max:255',
            'familia_id' => 'required|exists:familias,id',
        ]);
        
        $familia = Familia::find($request->familia_id);
        
        $data = $request->all();
        
        if ($familia) {
            $data['Família'] = $familia->nombre;
        }
        
        $cicle->update($data);

        return redirect()->route('cicles.index')->with('success', 'Cicle actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cicles $cicle)
    {
        $cicle->delete();

        return redirect()->route('cicles.index')->with('success', 'Cicle eliminado exitosamente.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $familia = $request->input('familia');
        
        try {
            $ciclesQuery = DB::table('cicles')
                ->leftJoin('familias', 'cicles.familia_id', '=', 'familias.id')
                ->select(
                    'cicles.id',
                    'cicles.Nom del Cicle',
                    'cicles.Nivell',
                    'cicles.Descripció',
                    'cicles.Valoració',
                    'cicles.Opinió',
                    'cicles.Email',
                    'cicles.date',
                    'cicles.hora',
                    'cicles.familia_id',
                    'familias.nombre as familia_nombre'
                );
            
            if (!empty($query)) {
                $ciclesQuery->where(function($q) use ($query) {
                    $q->where('cicles.id', 'like', "%{$query}%")
                      ->orWhere('cicles.Nom del Cicle', 'like', "%{$query}%");
                });
            }
            
            if (!empty($familia)) {
                $ciclesQuery->where('cicles.familia_id', $familia);
            }
            
            $cicles = $ciclesQuery->get();
            
            $ciclesArray = json_decode(json_encode($cicles), true);
            
            foreach ($ciclesArray as &$cicle) {
                if (!empty($cicle['familia_nombre'])) {
                    $cicle['Família'] = $cicle['familia_nombre'];
                }
                unset($cicle['familia_nombre']);
            }
            
            return response()->json($ciclesArray);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
