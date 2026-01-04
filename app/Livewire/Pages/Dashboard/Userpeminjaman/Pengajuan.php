<?php

namespace App\Livewire\Pages\Dashboard\Userpeminjaman;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Notifications\NotifPengajuan;
use Illuminate\Support\Facades\Notification;

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
                \Illuminate\Support\Facades\DB::transaction(function () use ($data) {

                        
                \App\Models\Ruangan::where('id', $this->ruanganId)
                ->lockForUpdate()
                ->first();
                
                $existingDates = \App\Models\PeminjamanAlatHeader::where('tanggal_pinjam', $this->tgl_peminjaman)
                ->where('ruangan_id', $this->ruanganId)
                ->whereIn('status_id', [1, 2])
                ->where(function($query) {
                    $query->where(function($q) {
                        $q->where('jam_mulai', '<', $this->jam_selesai)
                        ->where('jam_selesai', '>', $this->jam_mulai);
                    });
                })
                ->lockForUpdate()
                ->exists();

                if ($existingDates) {
                    throw new \Exception('Ruangan sudah dipesan');
                }
                do {
                    $code = 'LWH-' . now()->format('md-Y-') . strtoupper(bin2hex(random_bytes(3)));
                    $codeExists = \App\Models\PeminjamanAlatHeader::where('code', $code)->exists();
                }
                while ($codeExists);
                $data['code'] = $code;

                    $insertheader = \App\Models\PeminjamanAlatHeader::create($data);

                    $detaildata = [];

                    foreach ($this->cart as $id => $cart) {
                        $detaildata[] = [
                            'peminjaman_id' => $insertheader->id,
                            'alat_id' => $id,
                            'quantity_diajukan' => $cart,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    if (empty($detaildata)) {
                        throw new \Exception('Cart kosong');
                    }

                    \App\Models\PeminjamanAlatDetail::insert($detaildata);
                    \App\Models\HistoryPerubahan::create([
                        'peminjaman_id' => $insertheader->id,
                        'user_id' => auth()->id(),
                        'new_status_id' => 1,
                        'comment' => 'Pengajuan Peminjaman Alat'

                    ]);

                    // Notify Admin (HARUS DI DALAM TRANSACTION)
                    $adminUsers = \App\Models\User::role('admin')->get();
                    Notification::send($adminUsers, new NotifPengajuan($insertheader, "Pengajuan Peminjaman Baru", "admin.detail"));

                    session()->forget('cart_' . auth()->id());
                });

                return redirect('/dashboard/peminjaman');

            } catch (\Throwable $e) {

                report($e); // log ke laravel.log

                $this->dispatch('notify', [
                    'title' => 'Error',
                    'text'  => 'Gagal Mengajukan Peminjaman '. $e->getMessage(),
                    'icon'  => 'error'
                ]);
            }
        }
    }
}
