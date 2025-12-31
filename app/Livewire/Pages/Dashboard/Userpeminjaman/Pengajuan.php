<?php

namespace App\Livewire\Pages\Dashboard\Userpeminjaman;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Pengajuan extends Component
{
    #[Layout('layouts.dashboard')]
    public $cart = [];
    public $itemids = [];
    public $tgl_peminjaman;
    public $jam_mulai;
    public $jam_selesai;
    public $ruanganId;
    public $nim;
    public $nama;

    public function mount()
    {
        $this->cart = session()->get('cart_'. auth()->id());
    }
    public function render()
    {
        foreach($this->cart as $id => $qty) {
            $this->itemids[] = $id;

        }
        $data = \App\Models\Inventory::whereIn('id', $this->itemids)->get()
                ->map(function($row) {
                    $row->qty = $this->cart[$row->id];
                    return $row;
                });
        return view('livewire.pages.dashboard.userpeminjaman.pengajuan', [
            "items" => $data,
            "ruangan" => \App\Models\Ruangan::all()
        ]);
    }

    public function ajukanPeminjaman()
    {
        $rule = [
            "tgl_peminjaman" => "required|date|after:today",
            "jam_mulai" => "required|date_format:H:i|",
            "jam_selesai" => "required|date_format:H:i|after:jam_mulai",
            "ruanganId" => "required",
            "nim" => "required",
            "nama" => "required"
        ];

        $this->validate($rule);
        $data = [
            "user_id" => auth()->id(),
            "status_id" => 1,
            "ruangan_id" => $this->ruanganId,
            "tanggal_pinjam" => $this->tgl_peminjaman,
            "jam_mulai" => $this->jam_mulai,
            "jam_selesai" => $this->jam_selesai,
            "nim" => $this->nim,
            "nama_peminjam" => $this->nama,
        ];

        $check = \App\Models\PeminjamanAlatHeader::where("user_id", auth()->id())->count();
        if($check >= 2) {
            $this->dispatch("notify", ['title' => 'error', 'text' => 'Anda Masih Memiliki Peminjaman Aktif, Silahkan Selesaikan Terlebih Dahulu', 'icon' => 'error']);
        }
        else {
            try {
                $insertheader = \App\Models\PeminjamanAlatHeader::create($data);
                $detaildata = [];
                foreach($this->cart as $id => $cart) {
                    $detaildata[] = [
                        "peminjaman_id" => $insertheader->id,
                        "alat_id" => $id,
                        "quantity_diajukan" => $cart
                    ];
                }
                \App\Models\PeminjamanAlatDetail::insert($detaildata);
                $this->dispatch("notify", ['title' => 'Pengajuan Berhasil', 'text' => 'Berhasil Mengajukan Peminjaman Alat, Silahkan datang Ke Admin Untuk Konfirmasi', 'icon' => 'success']);
                session()->forget("cart_".auth()->id());
                return redirect("/dashboard/peminjaman");
            }
            catch(\Illuminate\Database\QueryException $e) {
                $this->dispatch("notify", ['title' => 'Error 500', 'text' => 'Gagal Mengajukan Peminjaman, Server Error'. $e, 'icon' => 'error']);

            }
        }
    }
}
