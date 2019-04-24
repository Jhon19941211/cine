<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sala;
use App\Pelicula;
use App\Proyeccion;
use App\Fecha_hora;
use Illuminate\Support\Facades\DB;


class ProyeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas=Sala::all();
        $peliculas=Pelicula::all();
        return view('/administracion/add',['salas'=>$salas,'peliculas'=>$peliculas]);
    }


    public function listar()
    {
        //
        $proyecciones=Proyeccion::all();

        $horarios=array();
        foreach ($proyecciones as $proyeccion){
          
            $fecha_hora=DB::select('select * from fecha_horas where id = ?',[$proyeccion->fecha_hora_id]);
                     
            $aux=array(
                "sala"=>$proyeccion->sala_id,
                "fecha"=>  $fecha_hora[0]->fecha,
                "hora"=> $fecha_hora[0]->hora
            );
            array_push($horarios,$aux);
            
        }

        return view('/administracion/list',['horarios'=>$horarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        if($request->input('sala')=='Seleccione' || $request->input('pelicula')=='Seleccione' || $request->input('hora')=='Seleccione' ||
           $request->input('fechainicio')==null ||  $request->input('fechafin')==null ){

              return  redirect()->back()->with('error', 'Faltan campos!!'); 
        }

        if($request->input('fechainicio') >  $request->input('fechafin') ){

            return  redirect()->back()->with('error', 'La fecha inicio debe ser menor a la fecha final!!'); 
        }
        $hora_fecha= new Fecha_hora();
        
        //convierte a hora militar
        $hora = strtotime($request->input('hora'));
        $hora = date("H:i", $hora);
        $hora_fecha->hora=$hora;
        $hora_fecha->fecha_inicio=$request->input('fechainicio');
       
        $hora_fecha->fecha_fin=$request->input('fechafin');
        $hora_fecha->save();

        //crear proyeccion
        $proyeccion= new Proyeccion();
        $proyeccion->fecha_hora_id=$hora_fecha->id;

       // $pelicula=Pelicula::where('nombre',$request->input('pelicula'));
        $pelicula = DB::select('select * from peliculas where nombre = ?',[$request->input('pelicula')]);
        
        $proyeccion->pelicula_id=$pelicula[0]->id;
        $proyeccion->sala_id=$request->input('sala');
        $proyeccion->save();
      
     
        return  redirect()->back()->with('success', 'La proyección para ha sido creada exitosamente!!'); 

    }

  
     
    public function show($id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
