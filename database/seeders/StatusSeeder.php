<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['status_name' => 'Book'],
            ['status_name' => 'Disetujui'],
            ['status_name' => 'Ditolak'],
            ['status_name' => 'Selesai'],
        ];
        foreach ($data as $item) {
            \App\Models\PeminjamanStatus::create($item);
        }
    }
}
