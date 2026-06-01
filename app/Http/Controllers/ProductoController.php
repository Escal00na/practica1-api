<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Producto::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = Producto::create($request->all());

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());

        return response()->json($producto, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(null, 204);
    }
}