<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Caffeinated\Flash\Facades\Flash;
use App\Http\Requests\ClientesRequest;
use App\User;
use App\Ciudad;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente= User::orderBy('id','ASC')->paginate(10);
        return view('clientes.index')
            ->with('cliente',$cliente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades = Ciudad::all();
        return view(('clientes.create'))
            ->with('ciudades',$ciudades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientesRequest $request)
    {
        $cliente= new User($request->all());
            $cliente->usuario = $request->usuario;
            $cliente->email = $request->email;
            $cliente->password= bcrypt($request->password);
            $cliente->rol = $request->rol;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->rfc = $request->rfc;
            $cliente->telefono = $request->telefono;
            $cliente->direccion= $request->direccion;
            $cliente->compania = $request->compania;
            $cliente->cp= $request->cp;
            $cliente->id_ciudad = $request->id_ciudad;
            //dd($cliente);
        $cliente->save();

        Flash::success("Cliente registrado de forma exitosa");
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciudades = Ciudad::all();
        $clientes= User::find($id);
        return view('clientes.edit')
            -> with('cliente',$clientes)
            ->with('ciudades',$ciudades);
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
        $cliente= User::find($id);
        $cliente->fill($request->all());
        $cliente->save();

        Flash::success("Cliente editado de forma exitosa");
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = User::find($id);
        $cliente->delete();
        Flash::error("El Cliente ha sido borrado de forma exitosa");
        return redirect()->route('clientes.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_index()
    {
        $clientes = DB::table('users')->orderBy('users.id', 'asc')
            ->join('ciudad', 'ciudad.id', '=', 'users.id_ciudad')
            ->select('users.*', 'ciudad.nombre as ciudad')->get();
        $data = array();
        $data['clientes'] = $clientes;
        return JsonResponse::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function val(Request $request)
    {
        //
        $response = new \stdClass();
        $cliente = DB::table('users')->where('usuario', '=', $request->usuario)->first();
        if(!$cliente)
        {
            $response->success = false;
            $response->mensaje = 'No existe el usuario = '.$request->usuario;
            return JsonResponse::create($response);
        }
        $cliente = DB::table('users')
            ->where('usuario', '=', $request->usuario)
            ->where('contrasena', '=', $request->contrasena)->first();
        if(!$cliente)
        {
            $response->success = false;
            $response->mensaje = 'Contraseña incorrecta';
            return JsonResponse::create($response);
        }
        $response->success = true;
        $response->mensaje = 'Autenticado';
        $response->id = $cliente->id;
        return JsonResponse::create($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function perfil($id)
    {
        $cliente = DB::table('users')
            ->join('ciudad', 'ciudad.id', '=', 'users.id_ciudad')
            ->select('users.usuario','users.nombres','users.apellidos',
                'users.correo','users.direccion','users.telefono',
                'ciudad.nombre as ciudad')
            ->where('cliente.id', '=', $id)->first();
        return JsonResponse::create($cliente);
    }
}
