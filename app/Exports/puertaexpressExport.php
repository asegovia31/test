<?php

namespace App\Exports;
use App\puertaexpress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class puertaexpressExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
        {

          $consultas = puertaexpress::select('nro_cta','rut_proveedor')->get();

                      return view('descarga_ptaexpress', [
                          'cons_pex' => $consultas
                      ]);
        }

}
