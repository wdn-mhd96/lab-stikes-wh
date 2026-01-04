<?php

namespace App\Livewire\Pages\Dashboard\Listpeminjaman;

use Illuminate\Notifications\Notification;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;



class Detail extends Component
{
    #[Url]
    public $id;

    #[Layout('layouts.dashboard')]

    public $approve = false;
    public $reject = false;

    public $approvedQty = [];
    public $returnedQty = [];
    public $peminjaman;
    public $history;
    public $comment = '';

    #[on('notify')]
    public function refreshList($notify)
    {
    }
    public function mount()
    {
        $peminjaman = \App\Models\PeminjamanAlatHeader::with('details.alat')
        ->findOrFail($this->id);

        foreach ($peminjaman->details as $detail) {
            $this->approvedQty[$detail->id] = $detail->quantity_disetujui ?? $detail->quantity_diajukan;
            $this->returnedQty[$detail->id] = $detail->quantity_disetujui ?? 0;
        }
        
        
    }
    public function render()
    {
        $this->peminjaman = \App\Models\PeminjamanAlatHeader::with(['status','details.alat','user','ruangan'])
                ->where('id', $this->id)->first();
        $this->history = \App\Models\HistoryPerubahan::with(['user', 'oldStatus', 'newStatus'])->where('peminjaman_id', $this->id)->orderBy('created_at', 'ASC')->get(); 
        return view('livewire.pages.dashboard.listpeminjaman.detail', [
            'peminjaman' => $this->peminjaman,
            'history'    => $this->history
        ]);
    }

    public function approvePengajuan()
    {
        $this->approve = true;
        $this->reject = false;
    }

    public function rejectPengajuan()
    {
        $this->reject = true;
        $this->approve = false;
    }

   public function prosesPengajuan()
    {
        try {
            \Illuminate\Support\Facades\DB::transaction(function () {

            // 🔒 Lock header row to prevent double processing
            $header = \App\Models\PeminjamanAlatHeader::where('id', $this->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Prevent double-submit
            if ($this->approve && $header->status_id == 1) {
                $newstatus = 2;

                foreach ($this->approvedQty as $id => $qty) {
                    if ($qty <= 0) {
                        throw new \Exception('Qty tidak valid');
                    }
                    \App\Models\PeminjamanAlatDetail::where('id', $id)
                        ->update([
                            'quantity_disetujui' => $qty
                        ]);
                }

            } elseif ($this->reject && $header->status_id == 1) {
                $newstatus = 3;
            } elseif($header->status_id == 2) {
                $newstatus = 4;
                foreach ($this->returnedQty as $id => $qty) {
                    if ($qty <= 0) {
                        throw new \Exception('Qty tidak valid');
                    }
                    \App\Models\PeminjamanAlatDetail::where('id', $id)
                        ->update([
                            'quantity_dikembalikan' => $qty
                        ]);
                }
            } else {
                throw new \Exception('Aksi tidak valid.');
            }

            // ✅ History
            \App\Models\HistoryPerubahan::create([
                'peminjaman_id' => $header->id,
                'user_id'       => auth()->id(),
                'old_status_id' => $header->status_id,
                'new_status_id' => $newstatus,
                'comment'       => $this->comment
            ]);

            // ✅ Correct update syntax
            $header->update([
                'status_id' => $newstatus
            ]);

            $notfiedUser = \App\Models\User::where('id', $header->user_id)->get();
            Notification::send($notfiedUser, new \App\Notifications\NotifPengajuan($header, "Peminjaman Anda Diperbarui", "user.detail"));

            $notifiedAdmin = \App\Models\User::where('role', 'admin')->where('id', '!=', auth()->id())->get();
            Notification::send($notifiedAdmin, new \App\Notifications\NotifPengajuan($header, "Peminjaman Diperbarui", "admin.detail"));

            
        });
        $this->dispatch('notify', [
            'title' => 'Berhasil',
            'text'  => 'Berhasil Memproses Peminjaman',
            'icon'  => 'success'
        ]);
        $this->reset([
            'approve',
            'reject',
            'comment',
        ]);

        }
        catch(\Throwable $e) {
             $this->dispatch('notify', [
                'title' => 'Gagal',
                'text'  => 'Gagal Memproses Peminjaman '.$e->getMessage(),
                'icon'  => 'error'
            ]);
        }

    }
}
