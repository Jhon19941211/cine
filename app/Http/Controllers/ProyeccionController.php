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
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function listarPeliculas(){

          $peliculas=Pelicula::all();

          return response()->json($peliculas);
        
    }
        /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function listarSalas(){

        $salas=Sala::all();

        return response()->json($salas);
      
  }
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

    public function vistaProyeccion(){
        return view('/administracion/list');
    }
    public function listar()
    {
        //
        $proyecciones=Proyeccion::all();
       
        return datatables()
        ->eloquent(Proyeccion::query()->with('pelicula','fecha_hora'))
        ->addColumn('action', function($proyecciones){
            return
            '<div class="row">'.
            '<div class="col text-center">'. 
            '<a  href="#" class="btn btn-primary btn-sm editar" 
             data-id="'.$proyecciones ->id.'" 
             data-hora="'.$proyecciones ->fecha_hora->hora.'"  
             data-fecha="'.$proyecciones ->fecha_hora->fecha.'" 
             data-pelicula="'.$proyecciones ->pelicula->nombre.'" 
             data-sala="'.$proyecciones ->sala_id.'"  
             data-toggle="modal" data-target="#edit" ><i class="nav-icon fa fa-edit"></i></a> '.
            '<a href="#" onclick="btn_eliminar_proyeccion('. $proyecciones ->id .')" class="btn btn-danger btn-sm eliminar" ><i class="nav-icon fa fa-trash"></i></a>'.
            '</div>'.
            '</div>';
        })  
        ->toJson();
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
           $request->input('fecha')==null){

              return  redirect()->back()->with('error', 'Faltan campos!!'); 
        }
       
        $fecha_actual=date("Y-m-d");
        if($request->input('fecha') < $fecha_actual ){

            return  redirect()->back()->with('error', 'La fecha debe ser igual o mayor a la actual!!'); 
        }

        $hora_fecha= new Fecha_hora();
        
        //convierte a hora militar
        $hora = strtotime($request->input('hora'));
        $hora = date("H:i", $hora);
        $hora_fecha->hora=$hora;
        $hora_fecha->fecha=$request->input('fecha');
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
        $proyeccion=Proyeccion::find($id);
        $salas=Sala::all();
        $peliculas=Pelicula::all();
        return view('administracion.edit',['proyeccion'=>$proyeccion,'salas'=>$salas,'peliculas'=>$peliculas]);
    }

    public function actualizar(Request $request)
    {
       $proyeccion=Proyeccion::find((int) $request->get('id'));
       $fecha_hora=Fecha_hora::find( $proyeccion->fecha_hora_id);
        

        $proyeccion->pelicula_id=$request->get('pelicula');
        $proyeccion->sala_id=$request->get('sala');
        $proyeccion->save();

          $hora = strtotime($request->get('hora'));
          $hora = date("H:i", $hora);
          $fecha_hora->hora=$hora;
         $fecha_hora->fecha=$request->get('fecha');
         $fecha_hora->save();

         return response()->json(['success'=>'Registro actualizado exitosamente..']);


        
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
         Proyeccion::destroy($id);
        return response()->json($id);
    }
}
