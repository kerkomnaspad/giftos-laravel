<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemtypes extends Model
{
    use HasFactory;

    public function items() {
        return $this->hasMany(items::class, 'type_id');
    }
    

    protected $fillable = [
        'name',
        'image',
        'description',
    ];

}
