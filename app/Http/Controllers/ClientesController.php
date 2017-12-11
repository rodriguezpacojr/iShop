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
use Illuminate\Support\Facades\Hash;

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
            $cliente->password= md5($request->password);
            $cliente->rol = $request->rol;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->rfc = $request->rfc;
            $cliente->telefono = $request->telefono;
            $cliente->direccion= $request->direccion;
            $cliente->compania = $request->compania;
            $cliente->cp= $request->cp;
            $cliente->id_ciudad = $request->id_ciudad;
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
            ->value('password');
        Hash::check($request->password,$cliente);
            //->where('password', '=', md5($request->password))->first();
        //dd(bcrypt($request->password));
        if(!$cliente)
        {
            $response->success = false;
            $response->mensaje = 'Contraseña incorrecta';
            return JsonResponse::create($response);
        }
        $cliente = DB::table('users')
            ->where('usuario', '=', $request->usuario)->first();

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
        $response = new \stdClass();
        $cliente = DB::table('users')
            ->join('ciudad', 'ciudad.id', '=', 'users.id_ciudad')
            ->join('estado', 'estado.id', '=', 'ciudad.id_estado')
            ->select('users.usuario','users.nombres','users.apellidos',
                'users.email','users.compania','users.rfc',
                'users.direccion','users.telefono','users.cp',
                'ciudad.nombre as ciudad','ciudad.id as id_ciudad',
                'estado.nombre as estado','estado.id as id_estado')
            ->where('users.id', '=', $id)->first();
        $response = $cliente;
        return JsonResponse::create($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function api_update(Request $request, $id)
    {
        //
        $response = new \stdClass();

        if (!$request->has('nombres')) {
            $response->success =false;
            $response->mensaje = 'no se recibio nombres';
            return JsonResponse::create($response);
        }
        if (!$request->has('apellidos')) {
            $response->success =false;
            $response->mensaje = 'no se recibio apellidos';
            return JsonResponse::create($response);
        }
        if (!$request->has('email')) {
            $response->success =false;
            $response->mensaje = 'no se recibio correo';
            return JsonResponse::create($response);
        }
        if (!$request->has('compania')) {
            $response->success =false;
            $response->mensaje = 'no se recibio compania';
            return JsonResponse::create($response);
        }
        if (!$request->has('rfc')) {
            $response->success =false;
            $response->mensaje = 'no se recibio rfc';
            return JsonResponse::create($response);
        }
        if (!$request->has('telefono')) {
            $response->success =false;
            $response->mensaje = 'no se recibio telefono';
            return JsonResponse::create($response);
        }
        if (!$request->has('direccion')) {
            $response->success =false;
            $response->mensaje = 'no se recibio direccion';
            return JsonResponse::create($response);
        }
        if (!$request->has('cp')) {
            $response->success =false;
            $response->mensaje = 'no se recibio codigo_postal';
            return JsonResponse::create($response);
        }
        if (!$request->has('id_ciudad')) {
            $response->success =false;
            $response->mensaje = 'no se recibio ciudad';
            return JsonResponse::create($response);
        }

        $cliente = DB::table('users')->where('id', '=', $id)->first();
        if(!$cliente)
        {
            $response->success =false;
            $response->mensaje = 'no existe el elemento con el id = '.$id;
            return JsonResponse::create($response);
        }

        DB::table('users')
            ->where('id', '=', $id)
            ->update(
                    ['nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'email' => $request->email,
                    'compania' => $request->compania,
                    'rfc' => $request->rfc,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion,
                    'cp' => $request->cp,
                    'id_ciudad' => $request->id_ciudad]
            );

        $response->success = true;
        return JsonResponse::create($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function api_insert(Request $request)
    {
        //
        $response = new \stdClass();

        if (!$request->has('usuario')) {
            $response->success =false;
            $response->mensaje = 'no se recibio usuario';
            return JsonResponse::create($response);
        }
        if (!$request->has('email')) {
            $response->success =false;
            $response->mensaje = 'no se recibio correo';
            return JsonResponse::create($response);
        }
        if (!$request->has('password')) {
            $response->success =false;
            $response->mensaje = 'no se recibio contraseña';
            return JsonResponse::create($response);
        }
        if (!$request->has('nombres')) {
            $response->success =false;
            $response->mensaje = 'no se recibio nombres';
            return JsonResponse::create($response);
        }
        if (!$request->has('apellidos')) {
            $response->success =false;
            $response->mensaje = 'no se recibio apellidos';
            return JsonResponse::create($response);
        }
        if (!$request->has('rfc')) {
            $response->success =false;
            $response->mensaje = 'no se recibio rfc';
            return JsonResponse::create($response);
        }
        if (!$request->has('compania')) {
            $response->success =false;
            $response->mensaje = 'no se recibio compania';
            return JsonResponse::create($response);
        }
        if (!$request->has('telefono')) {
            $response->success =false;
            $response->mensaje = 'no se recibio telefono';
            return JsonResponse::create($response);
        }
        if (!$request->has('direccion')) {
            $response->success =false;
            $response->mensaje = 'no se recibio direccion';
            return JsonResponse::create($response);
        }
        if (!$request->has('cp')) {
            $response->success =false;
            $response->mensaje = 'no se recibio codigo_postal';
            return JsonResponse::create($response);
        }
        if (!$request->has('id_ciudad')) {
            $response->success =false;
            $response->mensaje = 'no se recibio ciudad';
            return JsonResponse::create($response);
        }

        DB::table('users')
            ->insert(
                ['usuario' => $request->usuario,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'rfc' => $request->rfc,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion,
                    'compania' => $request->compania,
                    'cp' => $request->cp,
                    'id_ciudad' => $request->id_ciudad]
            );
        $id_c = DB::table('users')
            ->select(DB::raw('id'))
            ->where('usuario','=',$request->usuario)
            ->first();

        $response->id=$id_c;
        $response->success = true;
        return JsonResponse::create($response);
    }
}
