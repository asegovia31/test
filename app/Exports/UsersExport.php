<?php

namespace App\Exports;
//use App\User;
//use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery
{


  use Exportable;

     public function query()
     {
        // return $cDB::select("SELECT * FROM capacidad WHERE tipo_manejo='CAJ'");
     }




}
