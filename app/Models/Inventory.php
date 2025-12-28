<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'item_name',
        'item_code',
        'quantity',
        'disposable',
        'description',
        'image',
    ];
    protected $table = 'inventories';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $casts = [
        'disposable' => 'boolean',
    ];
}
