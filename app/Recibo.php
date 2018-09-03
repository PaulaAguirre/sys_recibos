<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DatesTranslator;


class Recibo extends Model
{
    use DatesTranslator;

    protected $table = 'recibos';
    protected $primaryKey = "id";

    protected $fillable = [
        'numero_recibo','user_id','concepto' , 'fecha', 'monto_recibo' ,'monto_saldo', 'estado', 'efectivo', 'cheque', 'otros',
    ];

    public function cliente ()
    {
        return $this->belongsTo ('App\User', 'user_id');
    }

}
