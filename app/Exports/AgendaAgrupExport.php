<?php

namespace App\Exports;
//use Illuminate\Support\Facades\DB;
use App\citas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AgendaAgrupExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
        {

$consulta = citas::select(
                          'cita',
                          'distribucion',
                          'tipo_orden',
                          'manejo',
                          'fech_cita',
                          'digita_inicio',
                          'digita_final',
                          'rut_prov',
                          'rs',
                          'con_pred',
                          'sin_pred',
                          'evento',
                          'cancela_oc',
                          'cod_depto',
                          'decrip_depto')->groupby('cita',
                                                  'distribucion',
                                                  'tipo_orden',
                                                  'manejo',
                                                  'fech_cita',
                                                  'digita_inicio',
                                                  'digita_final',
                                                  'rut_prov',
                                                  'rs',
                                                  'con_pred',
                                                  'sin_pred',
                                                  'evento',
                                                  'cancela_oc',
                                                  'cod_depto',
                                                  'decrip_depto')->distinct()->get();


            return view('agenda_agrupada', [
                'cons_aagrup' => $consulta
            ]);
        }

  //  public function collection()
//    {
      //  return citas::all();
//$sql=citas::select('cita','distribucion','tipo_orden')->where('oc','=','2204521')->get();

    //  return citas::select('oc','distribucion')->where('oc','=','2204521')->get();
//return $sql;
//$sql=DB::select("Select DISTINCT(cita), distribucion, tipo_orden, manejo, fech_cita, digita_inicio, digita_final, rut_prov, rs, con_pred, sin_pred, evento, cancela_oc, cod_depto, decrip_depto from citas GROUP BY cita ");

//return DB::select("Select * from citas where oc=2204521 ");

  //  }
}
