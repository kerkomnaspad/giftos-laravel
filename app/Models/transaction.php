<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function transaction_items() {
        return $this->hasMany(transaction_items::class, 'transaction_id');
    }
    
    protected $fillable = [
        'user_id',
        'quantity',
        'status'
    ];
}
