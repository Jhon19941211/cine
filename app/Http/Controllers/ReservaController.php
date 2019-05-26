<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Silla;
use App\Reserva;
use App\Proyeccion;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;





class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $reservas=   DB::table('reservas')
              ->where('reservas.user_id',  Auth::user()->id)
              ->join('proyeccions', 'reservas.proyeccion_id', '=', 'proyeccions.id')
               ->join('peliculas', 'proyeccions.pelicula_id', '=', 'peliculas.id')
               ->join('fecha_horas', 'proyeccions.fecha_hora_id', '=', 'fecha_horas.id')
               ->select('reservas.id', 'peliculas.nombre', 'fecha_horas.fecha','fecha_horas.hora')
               
               ->get();
         
               return view('/reservas/list',['reservas'=>$reservas]);

             
      
        
    }
   
    public function store(Request $request)
    {        
        foreach($request->datos as $dato => $valor) {
            $silla = Silla::create($valor); 
            $data_reserva=[];

            $data_reserva['estado'] = 1;
            $data_reserva['user_id'] = Auth::user()->id; 
            $data_reserva['proyeccion_id'] = $request->proyeccion_id;
            $data_reserva['silla_id'] = $silla->id;
                                   
            Reserva::create($data_reserva);
        }
        $nombre_pelicula = Proyeccion::find($request->proyeccion_id)->pelicula->nombre;
        return response()->json($nombre_pelicula); 
    }

   public function pdf($id){
       
    $reserva = DB::table('reservas')
    ->where('reservas.id',$id)
    ->join('proyeccions', 'reservas.proyeccion_id', '=', 'proyeccions.id')
    ->join('peliculas', 'proyeccions.pelicula_id', '=', 'peliculas.id')
    ->join('fecha_horas', 'proyeccions.fecha_hora_id', '=', 'fecha_horas.id')
    ->select('reservas.id', 'peliculas.nombre', 'fecha_horas.fecha', 'fecha_horas.hora')

    ->first();
    $fecha= Carbon::now();

    $data = ['reserva' => $reserva,'fecha'=>$fecha,'email'=> Auth::user()->email,'nombre'=> Auth::user()->name,'id'=>$id];

    $pdf = PDF::loadView('myPDF', $data);

    return $pdf->download('reserva.pdf');


   }

}
