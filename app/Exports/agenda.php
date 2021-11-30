<?php

namespace App\Exports;

use App\citas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class agenda implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

      $consulta = citas::select(  'cita',
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



          return view('descargar_agenda', [
              'regr' => $consulta
          ]);


    }
}