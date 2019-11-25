<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  // protected $table = "categorias"   //No es necesario utilizar esa linea por que nuestro clase Categoria supone que la base de datos se llamara categorias aumentando una 's'
  // protected $primarykey = 'id';     //No es necesario utilizar esa linea por que ya la clase supone que la llave primaria tendra el nombre de "id", si es otra se puede cambiar
  protected $fillable = ['nombre','descripcion','condicion']; //Para seguridad, para que al momento de ingresar datos a los siguientes campos los datos lleguen de manera segura.
}
