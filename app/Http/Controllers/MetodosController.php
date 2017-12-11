<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Intervention\Image\Facades;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Caffeinated\Flash\Facades\Flash;
use App\Metodo;

class MetodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodo= Metodo::orderBy('id','ASC')->paginate(5);
        return view('metodos.index')
            ->with('metodo',$metodo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(('metodos.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $metodo= new Metodo($request->all());
        $metodo->nombre = $request->nombre;
        $file=$request->file('imagen');
        $name = 'metodo_'.time().'.'. $file->getClientOriginalExtension();
        $path =  public_path().'/imagenes/';
        $file->move($path,$name);
        $metodo->imagen = $name;
        $metodo->save();

        Flash::success("Metodo registrado de forma exitosa");
        return redirect()->route('metodos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $metodo= Metodo::find($id);
        return view('metodos.edit')
            -> with('metodo',$metodo);
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
        $metodo= Metodo::find($id);
        $metodo->nombre = $request->nombre;
        $file=$request->file('imagen');
        $name = 'metodo_'.time().'.'. $file->getClientOriginalExtension();
        $path =  public_path().'/imagenes/';
        $file->move($path,$name);
        $metodo->imagen = $name;
        $metodo->save();

        Flash::success("Metodo editado de forma exitosa");
        return redirect()->route('metodos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metodo = Metodo::find($id);
        $metodo->delete();
        Flash::error("El Metodo ha sido borrado de forma exitosa");
        return redirect()->route('metodos.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $metodos = DB::table('categoria')->orderBy('id', 'asc')->get();
        //dd($categorias);
        $data=array();
        $data['metodos'] = $metodos ;
        return JsonResponse::create($data);
    }
}
