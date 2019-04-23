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
        $fechas = array();
        $date = Carbon::now();
        $fin = Carbon::now()->endOfWeek();
    
        while (true) {
            if ($date->day < $fin->day) {
                array_push($fechas, $date->toDateString());                  
                $date->addDay();  
            }else{
                array_push($fechas, $date->toDateString());
                break;
            }
        }

        $proyeccion = Proyeccion::with('fecha_hora')->where('pelicula_id','=', $id)->get();
        return response()->json(['fechas' => $fechas, 'proyeccion' => $proyeccion]);      
    }

    public function marcados($id, $id2){
        $fh = Fecha_hora::where('hora', '=', $id2)->get();
        $proyeccion = Proyeccion::where('fecha_hora_id', '=', $fh[0]->id)->where('pelicula_id', '=', $id)->get();
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
