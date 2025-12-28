<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $keyType = 'int';
}
