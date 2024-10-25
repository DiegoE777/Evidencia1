<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['client_id', 'salesperson_id', 'invoice_number', 'status', 'notes', 'route_photo', 'delivery_photo'];

    // Relación con el cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con el vendedor (usuario)
    public function salesperson()
    {
        return $this->belongsTo(User::class, 'salesperson_id');
    }
}

