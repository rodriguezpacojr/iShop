<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Flash\Facades\Flash;
use App\Cupon;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CuponesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupon = Cupon::orderBy('id','ASC')->paginate(5);
        return view('cupones.index')->with('cupon',$cupon);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(('cupones.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cupon= new Cupon($request->all());
        $cupon->clave = $request->clave;
        $cupon->descripcion = $request->descripcion;
        $cupon->descuento = $request->descuento;
        $cupon->save();
        Flash::success("El cupon se ha registrado de forma exitosa");
        return redirect()->route('cupones.index');
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
        $cupon = Cupon::find($id);
        return view('cupones.edit')-> with('cupon',$cupon);
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
        $cupon= Cupon::find($id);
        $cupon->clave = $request->clave;
        $cupon->descripcion = $request->descripcion;
        $cupon->descuento = $request->descuento;
        $cupon->save();
        Flash::success("El cupon ha sido editado de forma exitosa");
        return redirect()->route('cupones.index');

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
        $cupon = Cupon::find($id);
        $cupon ->delete();
        Flash::error("El cupon ha sido borrado de forma exitosa");
        return redirect()->route('cupones.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $cupones = DB::table('cupon')->orderBy('id', 'asc')->get();
        //dd($cupones);
        $data=array();
        $data['cupones'] = $cupones;
        return JsonResponse::create($data);
    }
}
