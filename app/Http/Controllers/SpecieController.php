<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Models\ProtectedArea;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpecieController extends Controller
{
 
    public function index()
    {
        return Inertia::render('Species/Index', [
            'species' => Specie::paginate(5)
        ]);
    }


    public function create()
    {
        return Inertia::render('Species/Create', [
            'protectedAreas' => ProtectedArea::all()
        ]);
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'scientific_name' => 'required|max:255',
            'common_name' => 'required|max:255',
            'description' => 'required|max:500',
            'conservation_status' => 'required|in:En peligro crítico,En peligro,Vulnerable,Casi amenazado,Preocupación menor',
            'average_lifespan' => 'required|numeric',
            'diet_type' => 'required|max:100',
            'population_estimate' => 'required|numeric',
            'threats' => 'required|max:500',
            'image' => 'required|file|mimes:png,jpg,jpeg,gif',
            'protectedAreas' => 'required|array'
        ]);
    
        $specie = Specie::create($request->all());
        
        if ($request->hasFile('image')) {
            $imgName = microtime(true) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('img', $imgName, 'public');
            $specie->image = '/img/' . $imgName;
            $specie->save();
        }
        $specie->protectedArea()->sync($request->protectedAreas);
        return redirect('specie/create')->with('success', 'Especie endémica creada');
    }

    public function updateSpecie(Request $request){
        $request->validate([
            'scientific_name' => 'required|max:255',
            'common_name' => 'required|max:255',
            'description' => 'required|max:500',
            'conservation_status' => 'required|in:En peligro crítico,En peligro,Vulnerable,Casi amenazado,Preocupación menor',
            'average_lifespan' => 'required|numeric',
            'diet_type' => 'required|max:100',
            'population_estimate' => 'required|numeric',
            'threats' => 'required|max:500',
            'id' => 'required|numeric',
            'protectedAreas' => 'required|array'

        ]);
    
        $specie = Specie::find($request->id);
        $specie->update($request->input());
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($specie->image);
            $imgName = microtime(true) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('img', $imgName, 'public');
            $specie->image = '/img/' . $imgName;
            $specie->save();
        }
        $specie->protectedArea()->sync($request->protectedAreas);
        return redirect('specie')->with('success', 'Especie endémica actualizada');
    }

    public function show(Specie $specie)
    {
        return Inertia::render('Species/Show', [
            'specie' => $specie,
            'protectedAreas' => $specie->protectedArea
        ]);
        
    }


    public function edit(Specie $specie)
    {
        return Inertia::render('Species/Edit', [
            'protectedAreas' => ProtectedArea::all(),
            'specie' => $specie,
            'protectedAreasOfSpecie' => $specie->protectedArea
        ]);
    }


    public function update(Request $request, Specie $specie)
    {
        //
    }

    public function destroy(Specie $specie)
    {
        $specie-> delete();
        return redirect('specie')->with('success','Especie eliminada');
    }
}
