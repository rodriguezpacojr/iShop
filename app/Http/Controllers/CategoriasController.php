<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriasRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Categoria;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categoria::orderBy('id','ASC')->paginate(5);
        return view('categoria.index')->with('categoria',$categoria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(('categoria.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('Hola');
        $categoria= new Categoria($request->all());
        $categoria->nombre = $request->nombre;
        $categoria->save();
        Flash::success("La categoria se ha registrado de forma exitosa");
        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.edit')-> with('categoria',$categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria= Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();
        Flash::success("La categoria ha sido editado de forma exitosa");
        return redirect()->route('categorias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $categoria = Categoria::find($id);
        $categoria ->delete();
        Flash::error('La categoria '.$categoria->nombre." ha sido borrado de forma exitosa");
        return redirect()->route('categorias.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $categorias = DB::table('categoria')->orderBy('id', 'asc')->get();
        //dd($categorias);
        $data=array();
        $data['categorias'] = $categorias;
        return JsonResponse::create($data);
    }
}
