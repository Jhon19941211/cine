<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pelicula;
use App\Sala;
use App\Proyeccion;
use App\Fecha_hora;
use App\Reserva;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        if (Pelicula::all()->isEmpty()) {
            foreach($request->peliculas as $pelicula) {  
                $datos = [];
                foreach($pelicula as $clave => $valor) { 
                    if($clave=='id'){   
                        $datos['id']=$valor;
                    }else if($clave=='title'){
                        $datos['nombre']=$valor;
                    }else if($clave=='genre_ids'){
                        $datos['genero']=$valor[0];
                    }else if($clave=='overview'){
                        $datos['sinopsis']=$valor;
                    }          
                }
                Pelicula::create($datos);                        
            } 
            return response()->json('si');           
        }else{        
            return response()->json('no');
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyeccion = Proyeccion::orderBy('fecha_hora_id','ASC')->with('fecha_hora')->where('pelicula_id','=', $id)->get();
        if(count($proyeccion)<1){
            return response()->json('no');      
        }
        return response()->json(['proyeccion' => $proyeccion]);      
    }

    public function marcados($pelicula_id, $fecha, $hora){

        $fecha_hora = Fecha_hora::where('fecha', '=', $fecha)->where('hora', '=', $hora)->get();
        $proyeccion = Proyeccion::where('fecha_hora_id', '=', $fecha_hora[0]->id)->where('pelicula_id', '=', $pelicula_id)->get();
        $reserva = Reserva::with('silla')->where('proyeccion_id', '=', $proyeccion[0]->id)->get();

        return response()->json($reserva);  
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
