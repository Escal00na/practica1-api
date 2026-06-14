<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(
            Categoria::with('productos')->get(),
            200
        );
    }

    public function store(Request $request)
    {
        $categoria = Categoria::create($request->all());

        return response()->json($categoria, 201);
    }

    public function show(Categoria $categoria)
    {
        return response()->json(
            $categoria->load('productos'),
            200
        );
    }

    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update($request->all());

        return response()->json($categoria, 200);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json(null, 204);
    }

    public function productos(Categoria $categoria)
{
    $productos = $categoria->productos()
        ->with('categoria')
        ->get();

    $productos->transform(function ($producto) {

        $producto->imagen_url = $producto->imagen
            ? asset('storage/' . $producto->imagen)
            : null;

        return $producto;
    });

    return response()->json($productos, 200);
}
}