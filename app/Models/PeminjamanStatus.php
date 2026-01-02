<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanStatus extends Model
{
    protected $table = 'peminjaman_statuses';

    protected $fillable = [
        'status_name',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;
}
