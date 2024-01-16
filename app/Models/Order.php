<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    const PENDIENTE = 1;
    const PROCESO = 2;
    const PAGADO = 3;
    const ENPAQUETERIA = 4;
    const ENVIADO = 5;
    const ENTREGADO = 6;
    const ANULADO = 7;

    //Relacion Uno a Muchos
    public function detailOrders(){
        return $this->hasMany(DetailOrder::class);
    }

    public function historyOrders(){
        return $this->hasMany(HistoryOrder::class);
    }

    //Relacion Uno a Muchos Inversa
    public function state(){
        return $this->belongsTo(State::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
