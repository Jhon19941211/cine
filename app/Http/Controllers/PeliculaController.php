<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelicula;


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
        foreach($request->peliculas as $pelicula) {  
            $datos = [];
            foreach($pelicula as $clave => $valor) { 
                if($clave=='id'){   
                    $datos['id_pelicula']=$valor;
                }else if($clave=='title'){
                    $datos['name']=$valor;
                }else if($clave=='overview'){
                    $datos['sinopsis']=$valor;
                }else if($clave=='genre_ids'){
                    $datos['genero']=$valor[0];
                }          
            }
            Pelicula::create($datos);                        
        }
        return response()->json($si);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
