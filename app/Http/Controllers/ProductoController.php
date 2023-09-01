<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // /api/producto?page=2&limit=5&q=a
        $q = isset($request->q)?$request->q:'';
        $limit = isset($request->limit)?$request->limit:10;

        if($q){
            $productos = Producto::where("nombre", "like", "%$q%")
                                    ->orderBy("id", "desc")
                                    ->paginate($limit);
        }else{
            $productos = Producto::orderBy("id", "desc")->paginate($limit);
        }

        return response()->json($productos, 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validación
        $request->validate([
            "nombre" => "required",
            "categoria_id" => "required"
        ]);
        // guardar
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

        return response()->json(["message" => "producto Registrado"], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function actualizarImagen(Request $request, $id){
        if($file = $request->file("imagen")){
            $direccion_imagen = time(). "-" . $file->getClientOriginalName();
            $file->move("imagenes/", $direccion_imagen);

            $direccion_imagen = "imagenes/". $direccion_imagen;

            $producto = Producto::find($id);
            $producto->imagen = $direccion_imagen;
            $producto->update();

            return response()->json(["mensaje" => "Imagen Actualizada"], 201);
        }
        return response()->json(["message" => "Se requiere Imagen"], 422);
    }
}
