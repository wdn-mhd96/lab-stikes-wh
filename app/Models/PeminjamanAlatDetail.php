<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanAlatDetail extends Model
{
    protected $table = 'peminjaman_alat_details';

    protected $fillable = [
        'peminjaman_id',
        'alat_id',
        'quantity_diajukan',
        'quantity_disetujui',
        'quantity_dikembalikan',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanAlatHeader::class, 'peminjaman_id', 'id');
    }

    public function alat()
    {
        return $this->belongsTo(Inventory::class, 'alat_id', 'id');
    }
}
