<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Exports\AgendaAgrupExport;
use App\Exports\agendalineaExport;
use App\Exports\agendaskuExport;
use App\Exports\Descarga_ptaExport;
use App\Exports\agenda;
use App\Exports\puertaexpressExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
  public function index()
   {



     $hoy = date("Y-m-d");
     $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

     //ERROR DE CONSTENCIA EN LA PROGRAMACION


     //$sql ="SELECT DISTINCT (cita), digita_inicio, fech_cita, decrip_depto, rs FROM citas WHERE DATE(fech_cita) = DATE(NOW()) AND  cita NOT IN (SELECT DISTINCT (nro_cita) FROM programacion)";

     $sql =DB::select("SELECT DISTINCT (cita), digita_inicio, fech_cita, decrip_depto, rs FROM citas WHERE fech_cita = getdate()  AND  cita NOT IN (SELECT DISTINCT (nro_cita) FROM programacion)");
     //$consutadis = sqlsrv_query($conexion,$sql);

     $sqlasr = DB::select("SELECT * FROM citas WHERE tipo_orden IN('ASR', 'AWR')  AND sin_pred > 0 ");
//     $resultadoasrawr = sqlsrv_query($conexion,$sqlasr);

     //FECHA DE CITA TIENE QUE SER LA MISMA QUE LA CANCELACION, EN CASO CONTRARIO MUESTRA EL ERROR
     $sqlnoagen =DB::select("SELECT * FROM citas WHERE tipo_orden in('ASR','AWR') AND fech_cita != cancela_oc ");
  //   $resultnoagen = sqlsrv_query($conexion,$sqlnoagen);


     $sqlpre =DB::select("SELECT * FROM citas WHERE distribucion='OC Predistribuida' and con_pred > 0 ");
//     $resultpre = sqlsrv_query($conexion,$sqlpre);

     $sqlsimple =DB::select("SELECT * FROM citas WHERE distribucion ='OC Simple' and con_pred > 0 and tipo_orden ='Almacenaje Proveedor'");
//     $resulsimple = sqlsrv_query($conexion,$sqlsimple);

     // CUADROS DE ANALISIS

    // consulta para mensajes principales
    $consultamensj	=DB::select("SELECT * FROM mensaje WHERE fecha='$hoy' ORDER BY id DESC");

    //consulta para Actualizados
    $act=DB::select("SELECT * FROM citas WHERE distribucion='METODO'");
    //$y=sqlsrv_query($conexion,$act);
    //$resp=sqlsrv_fetch_array($y);

    //BUSCO LAS CAPACIDAD DE BD
    $cons_caj=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='CAJ'");
    //$y=sqlsrv_query($conexion,$cons);
    //$con2=sqlsrv_fetch_array($y);

    //EJECUTO LA CONSULTA EN LA ITERACION
    $sql2=DB::select("select (sum(cast(sin_pred as int))+sum((cast(con_pred as int)))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='2021-11-11' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)) as tabla");
    //$sql2="select (sum(sin_pred)+sum(con_pred)) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)) as tabla";
    //$x2=sqlsrv_query($conexion,$sql2);

    //BUSCO LAS CAPACIDAD DE BD
    $cons_citas=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
    //$y=sqlsrv_query($conexion,$cons);
    //$con2=sqlsrv_fetch_array($y);

    //EJECUTO LA CONSULTA EN LA ITERACION
  //   $d='+ '.$i." ".'day';
  //  $day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
  //  $sql2=DB::select("SELECT COUNT(distinct(cita)) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='CAJ'
  //   AND tipo_orden <> 'Almacenaje Proveedor' AND  cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
    //$x3=sqlsrv_query($conexion,$sql2);



   return view('home')->with(['arreglomsj' => $consultamensj,
                              'resp'=> $act,
                              'consutadis' => $sql,
                              'resultnoagen' => $sqlnoagen,
                              'resultpre' => $sqlpre,
                              'resulsimple' => $sqlsimple,
                              'resultadoasrawr' => $sqlsimple,
                              'con_d' => $cons_caj,
                              'x2'  =>   $sql2,
                              'cap_cit'  => $cons_citas,
                               'x3'    =>  $sql2 ]);

  // return view('home')->with(['cap' => $sqldatos]);

              //   return view('home', ['info' => $citas->oc]);
   }

   public function export()
   {

return Excel::download(new AgendaAgrupExport, 'agenda_agrupada.xlsx');


    }
    public function export2()
    {

 return Excel::download(new agendalineaExport, 'agenda_linea.xlsx');


     }
     public function export3()
     {

  return Excel::download(new agendaskuExport, 'agenda_sku.xlsx');


      }

      public function export4()
      {

   return Excel::download(new puertaexpressExport, 'puertaexp.xlsx');


       }

       public function export5()
       {

 return Excel::download(new agenda, 'Agenda.xlsx');

       }

       public function export6(Request $request)
       {


 return Excel::download(new Descarga_ptaExport, 'Descarga_excel.xlsx');

       }




public function Parametros_cod(){

  return view('Parametros_cod');
}
public function subir_datos(){

  return view('Documentosadmin');
}


public function parametros()
{
return view('parametros');
}
public function eliminar($id)
{
return view('Delete_user',['id' => $id]);

}
public function eliminar_doc($id)
{
return view('Delete_doc',['id' => $id]);
}
public function save_msg()
{
return view('mensaje_ins');
}



 public function indexadmin()
 {
  //   return view('personas'); kkkk

  //   $titles = $users = DB::table('ejemplo')->distinct()->get();

     return view('login');

 }

 public function save_cap()
 {

     return view('guardar_capacidad');

 }

 public function loaddata()
 {

 return view('capacidades');

 }

 public function loaddata2()
 {

 return view('puerta_express_seg');


 }



}
