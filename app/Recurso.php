<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Recurso extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "recursos";
    //relaciones
    public function tipo_recurso()
    {
         return $this->belongsTo(TipoRecurso::class);
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }

    public function medida(){
        return $this->belongsTo(Medida::class);
        }
    public function marcaRecurso(){
        return $this->belongsTo(MarcaRecurso::class);
        }

        public function movimientos(){
            return $this->hasMany(Movimiento::class);
        }
        public function informeRecurso(){
            return $this->hasMany(InformeServicioRecurso::class);
        }

        public function recursoUtilizados(){
            return $this->hasMany(RecursoUtilizado::class);
        }

        public function obtenerStock()
        {
            $stockReal = $this->stock;
            $stockReservado = 0;
            $historiales = $this->informeRecurso ;
            foreach ($historiales as $historial) {
                if($historial->reserva == true){
                    $stockReservado += $historial->cantidad ;
                }
            }
            return $stockReal-$stockReservado;
        }

        public function getReservas(){
            $cantReservas = 0;
            $reservas = InformeServicioRecurso::where(['recurso_id'=>$this->id, 'reserva'=>1])->get();
            foreach ($reservas as $reserva) {
                $cantReservas += $reserva->cantidad;
            }

            return $cantReservas;

        }
}
