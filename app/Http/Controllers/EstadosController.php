<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Estado;

class EstadosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $est = DB::table('estado')->orderBy('estado.id', 'asc')
            ->join('pais', 'pais.id', '=', 'estado.id_pais')
            ->select('estado.*', 'pais.nombre as pais')->get();
        $data = array();
        $data['estado'] = $est;
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
        $estados = DB::table('pais')
            ->join('estado', 'estado.id_pais', '=', 'pais.id')
            ->select('estado.*')
            ->where('pais.id', '=', $id)->get();
        return JsonResponse::create($estados);
    }
}
