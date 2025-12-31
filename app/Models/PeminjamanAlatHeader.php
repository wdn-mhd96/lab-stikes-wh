<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanAlatHeader extends Model
{
    protected $table = 'peminjaman_alat_headers';

    protected $fillable = [
        'user_id',
        'status_id',
        'ruangan_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jam_mulai',
        'jam_selesai',
        'nim',
        'nama_peminjam',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    public function status()
    {
        return $this->belongsTo(PeminjamanStatus::class, 'status_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(PeminjamanAlatDetail::class, 'peminjaman_id', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }
}
