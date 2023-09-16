<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;


class PropertyController extends Controller
{
    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        if ($request->has('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }

        if ($request->has('storeys')) {
            $query->where('storeys', $request->input('storeys'));
        }

        if ($request->has('garages')) {
            $query->where('garages', $request->input('garages'));
        }

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->input('price_min'), $request->input('price_max')]);
        }

        $properties = $query->get();

        return response()->json($properties);
    }
}