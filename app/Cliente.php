<?php

namespace App;

use App\Http\Controllers\TipoEquipoController;
use App\Mail\EnvioEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
use Illuminate\Support\Facades\Mail;
use stdClass;

class Cliente extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public $table = "clientes";

    //relacion
    public function direccion(){
        return $this->belongsTo(Direccion::class);
    }

    public function equipos(){
        return $this->hasMany(Equipo::class);
    }

    public function enviarMail($data){

        // $obj = new stdClass() ;
        // $obj->sender = 'PC-SHOP' ;
        // $obj->sender = $this->nombre;

        // $mail = new EnvioEmail($obj) ;

        Mail::send('mails.cliente', ['data' => $data], function ($message) {
            $message->to($this->email)->subject('PC-SHOP');
        });

        // Mail::to($this->email)->send($mail) ;
    }

}
