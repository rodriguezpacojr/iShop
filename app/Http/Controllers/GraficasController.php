<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\User;
use App\DetalleOrden;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ventas_cliente()
    {
        $do = DB::table('detalleorden')
            ->join('users', 'users.id', '=', 'detalleorden.id_cliente')
            ->select('users.usuario', DB::raw('SUM(cantidad) as total'))
            ->groupBy('users.usuario')
            ->get();
        $data = array();
        $data['ventascliente'] = $do;
        //dd($data);
        return view('graficas.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contador()
    {
        $data = array();
        $cont = DB::table('users')
            ->select(DB::raw('COUNT(*) as total'))
            ->get();
        $data['usuarios'] = $cont;

        $o = DB::table('orden')
            ->select(DB::raw('COUNT(*) as total'))
            ->get();
        $data['ordenes'] = $o;

        $pr = DB::table('producto')
            ->select(DB::raw('COUNT(*) as total'))
            ->get();
        $data['productos'] = $pr;

        $pv = DB::table('proveedor')
            ->select(DB::raw('COUNT(*) as total'))
            ->get();
        $data['proveedores'] = $pv;

        $pv = DB::table('categoria')
            ->select(DB::raw('COUNT(*) as total'))
            ->get();
        $data['categorias'] = $pv;
        //dd($data);
        return view('graficas.contador')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productos_cliente()
    {
        $do = DB::table('detalleorden')
            ->join('users', 'users.id', '=', 'detalleorden.id_cliente')
            ->join('producto', 'producto.id', '=', 'detalleorden.id_producto')
            ->select('users.usuario', 'producto.nombre', DB::raw('SUM(cantidad) as total'))
            ->groupBy('users.usuario', 'producto.nombre')
            ->orderByRaw('users.usuario ASC')
            ->get();
        $data = array();
        $data['productocliente'] = $do;
        dd($data);
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
