<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_ruangan' => 'BIO',
                'nama_ruangan' => 'Biomedik',
            ],
            [
                'kode_ruangan' => 'KAN',
                'nama_ruangan' => 'Keperawatan Anak',
            ],
            [
                'kode_ruangan' => 'KDS',
                'nama_ruangan' => 'Keperawatan Dasar',
            ],
            [
                'kode_ruangan' => 'KGD',
                'nama_ruangan' => 'Keperawatan Gawat Darurat',
            ],
            [
                'kode_ruangan' => 'KGR',
                'nama_ruangan' => 'Keperawatan Gerontik',
            ],
            [
                'kode_ruangan' => 'KJI',
                'nama_ruangan' => 'Keperawatan Jiwa',
            ],
            [
                'kode_ruangan' => 'KMA',
                'nama_ruangan' => 'Keperawatan Maternitas',
            ],
            [
                'kode_ruangan' => 'KKE',
                'nama_ruangan' => 'Keperawatan Keluarga',
            ],
            [
                'kode_ruangan' => 'KKOM',
                'nama_ruangan' => 'Keperawatan Komunitas',
            ],
            [
                'kode_ruangan' => 'KMB',
                'nama_ruangan' => 'Keperawatan Medikal Bedah',
            ],
            [
                'kode_ruangan' => 'MAB',
                'nama_ruangan' => 'Manajemen Bencana',
            ]
        ];

        \App\Models\Ruangan::insert($data);
    }
}
