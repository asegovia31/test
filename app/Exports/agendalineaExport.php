<?php

namespace App\Exports;

use App\citas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class agendalineaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
        {
/*
$sql="Select   cita,
               oc,
               distribucion,
               tipo_orden,
               manejo,
               fech_cita,
               digita_inicio,
               digita_final,
               rut_prov,
               rs,
               con_pred,
               sin_pred,
               evento,
               cancela_oc,
               cod_depto,
               decrip_depto from citas ";
                                         */


$consulta = citas::select( 'cita',
                           'oc',
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
                           'decrip_depto')->get();


            return view('agenda_linea', [
                'cons_alinea' => $consulta
            ]);
        }

}
