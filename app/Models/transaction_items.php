<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction_items extends Model
{
    use HasFactory;

    public function items(){
        return $this->belongsTo(items::class,'item_id','id');
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    
}
