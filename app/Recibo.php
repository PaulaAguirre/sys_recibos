<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'recibos';
    protected $primaryKey = "id";

    protected $fillable = [
        'numero_recibo','user_id','concepto' , 'fecha', 'monto_recibo' ,'monto_saldo', 'estado',
    ];

    public function cliente ()
    {
        return $this->belongsTo ('App\User', 'user_id');
    }

}
