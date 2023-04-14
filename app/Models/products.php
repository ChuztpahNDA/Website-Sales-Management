<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'URLImages',
        'nameProduct',
        'quatity',
        'priceProduct',
        'purchaseProduct',
        'description',
        'created_at'
    ];
}
