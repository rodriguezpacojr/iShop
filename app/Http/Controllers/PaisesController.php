<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Pais;

class PaisesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $pais = DB::table('pais')->orderBy('pais.id', 'asc')
            ->select('pais.*')->get();
        $data = array();
        $data['pais'] = $pais;
        return JsonResponse::create($data);
    }
}
