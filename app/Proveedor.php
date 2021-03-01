<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
use App\Mail\EnvioEmail;
use Illuminate\Support\Facades\Mail;
class Proveedor extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "proveedors";
    //relacion
    public function direccion(){
        return $this->belongsTo(Direccion::class);
    }
    public function tipoRecursoProveedores(){
        return $this->hasMany(TipoRecursoProveedor::class);
    }
    public function cabeceraMovimiento(){
        return $this->hasMany(CabeceraMovimiento::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedidio::class);
    }

    public function enviarMail($pedido){

        // $obj = new stdClass() ;
        // $obj->sender = 'PC-SHOP' ;
        // $obj->sender = $this->nombre;

        // $mail = new EnvioEmail($obj) ;

        Mail::send('mails.proveedor', ['pedido' => $pedido ], function ($message) {
            $message->to($this->email)->subject('PC-SHOP');
        });
}
}
