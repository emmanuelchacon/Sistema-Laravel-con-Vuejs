<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria; //Importamos nuestro modelo Categoria


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()){
          return redirect("/");
        }else{

        $categorias = Categoria::all(); //Una vez que importamos la clase Categoria utilizamos el elmetodo all() y le asignamos todos los datos a la variable $categoria

        // echo "<pre>";
        // var_dump($categorias);
        // echo "</pre>";
        return $categorias;

      }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Request recibira datos desde  un formulario y lo guardara en cada campo de la tabla categorias
    {
      if (!$request->ajax()){
        return redirect("/");
      }else{

        $categoria = new Categoria();

        $categoria->nombre = $request->name;
        $categoria->descripcion = $request->desc;
        $categoria->condicion = '1';

        $categoria->save();
      }
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      if (!$request->ajax()){
        return redirect("/");
      }else{

      $categoria = Categoria::findOrFail($request->id); //Buscamos el id del registro que se actualizara

      $categoria->nombre = $request->name;
      $categoria->descripcion = $request->desc;
      $categoria->condicion = '1';

      $categoria->save();
      }
    }

    public function desactivar(Request $request)
    {
      if (!$request->ajax()){
        return redirect("/");
      }else{

      $categoria = Categoria::findOrFail($request->id); //Buscamos el id del registro que se desactivara

      $categoria->condicion = '0';

      $categoria->save();
      }
    }


    public function activar(Request $request)
    {
      if (!$request->ajax()){
        return redirect("/");
      }else{

      $categoria = Categoria::findOrFail($request->id); //Buscamos el id del registro que se activara

      $categoria->condicion = '1';

      $categoria->save();
      }
    }






}
