<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    //
    public function getImagenReporte64(){
        $image = base64_encode(file_get_contents(public_path().'/images/'.$this->logo));
        return 'data:image/png;base64,'.$image;
    }

}
