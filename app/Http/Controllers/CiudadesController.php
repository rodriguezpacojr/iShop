<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Ciudad;

class CiudadesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $ci = DB::table('ciudad')->orderBy('ciudad.id', 'asc')
            ->join('estado', 'estado.id', '=', 'ciudad.id_estado')
            ->select('ciudad.*', 'estado.nombre as estado')->get();
        $data = array();
        $data['ciudad'] = $ci;
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
        $ciudad = DB::table('estado')
            ->join('ciudad', 'ciudad.id_estado', '=', 'estado.id')
            ->select('ciudad.*')
            ->where('estado.id', '=', $id)->get();
        return JsonResponse::create($ciudad);
    }
}
