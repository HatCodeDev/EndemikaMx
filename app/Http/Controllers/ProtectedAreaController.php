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
        //
    }

  
    public function show(ProtectedArea $ProtectedArea)
    {
        //
    }

  
    public function edit(ProtectedArea $ProtectedArea)
    {
        //
    }

   
    public function update(Request $request, ProtectedArea $ProtectedArea)
    {
        //
    }

   
    public function destroy(ProtectedArea $ProtectedArea)
    {
        //
    }
}
