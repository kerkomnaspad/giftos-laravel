<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;
    
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function items(){
        return $this->belongsTo(items::class,'item_id','id');
    }
    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];
}
