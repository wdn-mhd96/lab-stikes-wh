<?php

namespace App\Livewire\Pages\Dashboard\Manual;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    #[Layout('layouts.dashboard')]

    public $phase = 1;
    public $search = '';
    
    public $quantity = [];
    public $cart = [];
    
    public $user_id;
    public $nim;
    public $nama;
    public $tanggal_pinjam;
    public $jam_mulai;
    public $jam_selesai;
    public $ruanganId;

    public function mount()
    {
        $this->cart = session()->get("cart_". auth()->id());
        $inventory = \App\Models\Inventory::all();
        foreach($inventory as $item) {
            $this->quantity[$item->id] = $this->cart[$item->id] ?? 0; 
        }
    }

    public function addToCart($id)
    {
        $key = 'cart_' . auth()->id();

       $cart = session()->get($key) ?? [];
       $cart[$id] = $this->quantity[$id];
       $this->cart = $cart;
       session()->put($key, $this->cart);
       $this->dispatch("notify", ['title' => 'success', 'text' => 'Item Telah Dimasukkan ke List Peminjaman', 'icon' => 'success']);
    }

    public function removeCart($id)
    {
        $key = 'cart_' . auth()->id();

        $cart = $this->cart;
        unset($cart[$id]);

        // 🔥 force reactivity
        $this->cart = $cart;

        session()->put($key, $this->cart);

        $this->dispatch("notify", [
            'title' => 'success',
            'text' => 'Item Telah Dihapus dari List Peminjaman',
            'icon' => 'success'
        ]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    
    public function render()
    {
        $inventoryList = \App\Models\Inventory::where('item_code', 'like', '%'.$this->search.'%')
                          ->orWhere('item_name', 'like', '%'.$this->search.'%')
                            ->orderBy('item_name', 'ASC')->paginate(8);
        $users = \App\Models\User::where('role', 'user')->get();
        $ruangan = \App\Models\Ruangan::get();
        return view('livewire.pages.dashboard.manual.index', [
            'inventoryList' => $inventoryList,
            'users' => $users,
            'ruangan' => $ruangan,
        ]);
    }

    public function phaseTwo()
    {
        $rules = [
            "user_id" => "required",
            "nim" => "required",
            "nama"  => "required",
            "tanggal_pinjam" => "required|date|after_or_equal:today",
            "jam_mulai" => "required|date_format:H:i|",
            "jam_selesai" => "required|date_format:H:i|after:jam_mulai",
            "ruanganId" => "required"
        ];
        $this->validate($rules);
        $this->phase = 2;
    }

    public function kosongkanList()
    {
        $key = 'cart_' . auth()->id();
        session()->forget($key);
        $this->cart = [];
        $this->dispatch("notify", ['title' => 'success', 'text' => 'List Peminjaman Telah Dikosongkan', 'icon' => 'success']); 
    }


    public function save()
    {
        $data = [
            "user_id" => $this->user_id,
            "status_id" => 1,
            "ruangan_id" => $this->ruanganId,
            "tanggal_pinjam" => $this->tanggal_pinjam,
            "jam_mulai" => $this->jam_mulai,
            "jam_selesai" => $this->jam_selesai,
            "nim" => $this->nim,
            "nama_peminjam" => $this->nama,
        ];
        $check = \App\Models\PeminjamanAlatHeader::where("user_id", $this->user_id)->whereIn("status_id", [1,2])->count();
        if($check >= 2) {
            $this->dispatch("notify", ['title' => 'error', 'text' => 'Anda Masih Memiliki Peminjaman Aktif, Silahkan Selesaikan Terlebih Dahulu', 'icon' => 'error']);
        }
        else {
            try {
                $headerid = \Illuminate\Support\Facades\DB::transaction(function () use ($data) {

                        
                \App\Models\Ruangan::where('id', $this->ruanganId)
                ->lockForUpdate()
                ->first();
                
                $existingDates = \App\Models\PeminjamanAlatHeader::where('tanggal_pinjam', $this->tanggal_pinjam)
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
                    throw new \Exception('Ruangan sudah dipesan di Jam dan Tanggal Tersebut');
                }
                do {
                    $code = 'LWH-' . now()->format('md-Y-') . strtoupper(bin2hex(random_bytes(3)));
                    $codeExists = \App\Models\PeminjamanAlatHeader::where('code', $code)->exists();
                }
                while ($codeExists);
                $data['code'] = $code;

                    $insertheader = \App\Models\PeminjamanAlatHeader::create($data);
                    $headerid = $insertheader->id;
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

                    session()->forget('cart_' . auth()->id());
                    return $insertheader->id; 
                });

                return redirect('/dashboard/detail/'.$headerid);

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
