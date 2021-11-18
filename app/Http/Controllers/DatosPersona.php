<?php
use App\Post;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DatosPersona extends Controller
{
public function second()
{
 //   return view('personas'); kkkk

    $titles = $users = DB::table('ejemplo')->distinct()->get();

    return view('personas', ['info' => $titles]);

}

}
