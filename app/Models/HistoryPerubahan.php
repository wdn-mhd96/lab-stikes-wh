<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryPerubahan extends Model
{
    protected $table = 'history_perubahans';

    protected $fillable = [
        'peminjaman_id',
        'old_status_id',
        'new_status_id',
        'user_id',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanAlatHeader::class, 'peminjaman_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
