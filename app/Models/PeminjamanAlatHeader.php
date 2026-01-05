<?php

namespace App\Models;

use App\Livewire\Pages\Dashboard\Userpeminjaman\History;
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
        'code',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $casts = [
        "tanggal_pinjam" => "datetime",
    ];

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

    public function history()
    {
        return $this->hasMany(HistoryPerubahan::class, 'peminjaman_id', 'id');
    }
}
