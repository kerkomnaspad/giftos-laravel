<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;

    public function itemtypes() {
        return $this->belongsTo(itemtypes::class, 'type_id');
    }
    

    public function carts(){
        return $this->hasMany(carts::class,'id','item_id');
    }

    public function transaction_items(){
        return $this->hasMany(transaction_items::class,'id','item_id');
    }
    protected $fillable = [
        'name',
        'type_id',
        'quantity',
        'price',
        'description'
    ];
}
