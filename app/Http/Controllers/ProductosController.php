<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Caffeinated\Flash\Facades\Flash;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto= Producto::orderBy('id','ASC')->paginate(5);
        //dd($producto);
        return view('productos.index')->with('producto',$producto);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view(('productos.create'))->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto= new Producto($request->all());
            $producto->nombre = $request->nombre;
            $producto->descripcion= $request->descripcion;
            $producto->precio_venta= $request->precio_venta;
            $producto->stock= $request->stock;
            $producto->id_categoria= $request->id_categoria;
        $producto->save();

        Flash::success("Producto registrado de forma exitosa");
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias= Categoria::all();
        $productos= Producto::find($id);
        return view('productos.edit')-> with('producto',$productos)->with('categorias',$categorias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto= Producto::find($id);
            $producto->nombre = $request->nombre;
            $producto->descripcion= $request->descripcion;
            $producto->precio_venta= $request->precio_venta;
            $producto->stock= $request->stock;
            $producto->id_categoria= $request->id_categoria;
        $producto->save();

        Flash::success("Producto editado de forma exitosa");
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        Flash::error("El Producto ha sido borrado de forma exitosa");
        return redirect()->route('productos.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $productos = DB::table('producto')->orderBy('producto.id', 'asc')
            ->join('categoria', 'categoria.id', '=', 'producto.id_categoria')
            ->select('producto.*', 'categoria.nombre as categoria')->get();
        $data = array();
        $data['productos'] = $productos;
        return JsonResponse::create($data);
    }
}
