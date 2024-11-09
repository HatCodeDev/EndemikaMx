<?php

namespace App\Http\Controllers;

use App\Models\ProtectedArea;
use App\Models\Region;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProtectedAreaController extends Controller
{
    
    public function index()
    {
        $regions = Region::all();
        $protected_areas = ProtectedArea::with('region:id,region_name', 'species:common_name')->get();
        return Inertia::render('ProtectedAreas/Index', [
            'protected_areas' => $protected_areas,
            'regions' => $regions
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'area_name' => 'required|string|max:255',
            'area_km2' => 'required|numeric|between:0,99999999.99',
            'established_date' => 'required|date',
            'protection_level' => 'required|string|max:100',
            'region_id' => 'required|numeric'
        ]);
        
        $protectedArea = new ProtectedArea($request->input());
        $protectedArea->save();
        
        return redirect('protectedAreas');
    }

  
    public function show(ProtectedArea $protectedArea)
    {
        //
    }

  
    public function edit(ProtectedArea $protectedArea)
    {
        
    }

   
    public function update(Request $request, ProtectedArea $protectedArea)
    {
        // dd($protectedArea, $request->all()); 
        $request->validate([
            'area_name' => 'required|string|max:255',
            'area_km2' => 'required|numeric|between:0,99999999.99',
            'established_date' => 'required|date',
            'protection_level' => 'required|string|max:100',
            'region_id' => 'required|numeric'
        ]);

        $protectedArea->update($request->input());
        return redirect('protectedAreas');
    }

   
    public function destroy(ProtectedArea $protectedArea)
    {
        // dd($ProtectedArea); 
        $protectedArea->delete();
        return redirect('protectedAreas');
    }
}
