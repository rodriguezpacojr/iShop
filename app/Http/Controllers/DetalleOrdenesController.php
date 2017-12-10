<?php

namespace App\Http\Controllers;

use App\DetalleOrden;
use App\Orden;
use App\User;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Caffeinated\Flash\Facades\Flash;

class DetalleOrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $do = DB::table('detalleorden')->orderBy('detalleorden.id_orden', 'asc')
            ->join('users', 'users.id', '=', 'detalleorden.id_cliente')
            ->join('orden', 'orden.id', '=', 'detalleorden.id_orden')
            ->join('producto', 'producto.id', '=', 'detalleorden.id_producto')
            ->select('orden.id','users.nombres', 'users.apellidos', 'producto.nombre', 'detalleorden.cantidad')
            ->get();
        $data = array();
        $data['detalleorden'] = $do;
        return view('detalleordenes.index')
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
        $productos = Producto::all();
        $ordenes = Orden::all();
        return view('detalleordenes.create')
            ->with('clientes',$clientes)
            ->with( 'productos',$productos)
            ->with( 'ordenes',$ordenes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $do= new DetalleOrden($request->all());
        $do->id_orden= $request->id_orden;
        $do->id_cliente= $request->id_cliente;
        $do->id_producto= $request->id_producto;
        $do->cantidad= $request->cantidad;
        $do->save();

        Flash::success("Registro insertado de forma exitosa");
        return redirect()->route('detalleordenes.index');
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
