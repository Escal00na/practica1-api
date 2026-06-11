<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        $productos->transform(function ($producto) {
            $producto->imagen_url = $producto->imagen
                ? asset('storage/' . $producto->imagen)
                : null;

            return $producto;
        });

        return response()->json($productos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'nullable|integer',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request
                ->file('imagen')
                ->store('productos', 'public');
        }

        $producto = Producto::create($data);

        $producto->imagen_url = $producto->imagen
            ? asset('storage/' . $producto->imagen)
            : null;

        return response()->json($producto, 201);
    }

    public function show(Producto $producto)
    {
        $producto->imagen_url = $producto->imagen
            ? asset('storage/' . $producto->imagen)
            : null;

        return response()->json($producto);
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());

        return response()->json($producto);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(null, 204);
    }
}