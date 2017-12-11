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
    public function ventas_mensuales()
    {
        $do = DB::table('view_ventas_mes')
            ->select('view_ventas_mes.*')
            ->where('anio','=','2014')
            ->get();
        $data = array();
        $data['ventasmes'] = $do;
        return view('graficas.ventas_mensuales')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ventas_anuales()
    {
        $do = DB::table('view_ventas_anio')
            ->select('view_ventas_anio.*')
            ->get();
        $data = array();
        $data['ventasanio'] = $do;
        return view('graficas.ventas_anuales')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productos_mes()
    {
        $do = DB::table('view_productos_mes')
            ->select('view_productos_mes.*')
            ->where('anio','=','2017')
            ->get();
        $data = array();
        $data['productomes'] = $do;
        return view('graficas.productosmes')->with($data);
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
}
