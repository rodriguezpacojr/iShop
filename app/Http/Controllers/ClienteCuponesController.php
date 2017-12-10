<?php

namespace App\Http\Controllers;

use App\ClienteCupon;
use App\Cupon;
use App\Producto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Caffeinated\Flash\Facades\Flash;

class ClienteCuponesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientecupon = DB::table('clientecupon')->orderBy('clientecupon.id', 'asc')
            ->join('users', 'users.id', '=', 'clientecupon.id_cliente')
            ->join('cupon', 'cupon.id', '=', 'clientecupon.id_cupon')
            ->select('clientecupon.id','users.usuario', 'cupon.clave')->get();
        $data = array();
        $data['clientecupon'] = $clientecupon;
        return view('clientecupones.index')
            ->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = User::all();
        $cupones = Cupon::all();
        return view('clientecupones.create',compact('clientes'),compact( 'cupones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cc= new ClienteCupon($request->all());
        $cc->id_cliente= $request->id_cliente;
        $cc->id_cupon= $request->id_cupon;
        $cc->save();

        Flash::success("Registro insertado de forma exitosa");
        return redirect()->route('clientecupones.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = User::all();
        $cupones = Cupon::all();
        $clientecupon = ClienteCupon::find($id);
        return view('clientecupones.edit')
            -> with('clientes',$clientes)
            ->with('cupones',$cupones)
            ->with('clientecupon',$clientecupon);
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

        $cc= ClienteCupon::find($id);
        $cc->fill($request->all());
        $cc->save();

        Flash::success("Relacion editada de forma exitosa");
        return redirect()->route('clientecupones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cc = ClienteCupon::find($id);
        $cc->delete();

        Flash::error("La relacion ha sido borrada de forma exitosa");
        return redirect()->route('clientecupones.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $cc = DB::table('clientecupon')->orderBy('clientecupon.id', 'asc')
            ->join('users', 'users.id', '=', 'clientecupon.id_cliente')
            ->join('cupon', 'cupon.id', '=', 'clientecupon.id_cupon')
            ->select('clientecupon.*', 'users.usuario as usuario', 'cupon.clave as cupon')->get();
        $data = array();
        $data['clientecupon'] = $cc;
        return JsonResponse::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Regresa los cupones para un cliente
        $cupon = DB::table('clientecupon')
            ->join('cupon', 'clientecupon.id_cupon', '=', 'cupon.id')
            ->select('cupon.*')
            ->where('clientecupon.id_cliente', '=', $id)->get();
        return JsonResponse::create($cupon);
    }
}
