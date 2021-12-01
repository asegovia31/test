<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function index()
  {
      return \View::make('Documentosadmin');
   }

   public function save(Request $request)
{

      $estado= 1;
       //obtenemos el campo file definido en el formulario
       $file = $request->file('fileToUpload');

       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();

       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put($nombre,  \File::get($file));

       return view('Documentosadmin',['est' => $estado,'filename'=> $nombre]);
}

public function descargar_documento($nombre)
{
return Storage::download($nombre);
}

}
