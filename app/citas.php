<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    //

    protected $fillable = [
      'oc',
      'distribucion',
      'tipo_orden'
    ];

  public function agenda_ag()
  {
   return "hola mundo";

  }


}
