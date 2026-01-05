<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakForm extends Controller
{
    public function CetakForm($id)
    {
        $data = \App\Models\PeminjamanAlatHeader::with(['status','details.alat','user','ruangan'])
                ->where('id', $id)->first();

        $pdf = Pdf::loadView('pdf.form', ["data" => $data])
                ->setPaper('A4', 'potrait');

        return $pdf->stream('Form Peminjaman.pdf');
    }

    public function FormPengadaan(Request $request)
    {
        $data = \App\Models\Inventory::where("quantity","<=", 0)->orderBy('created_at', 'desc')->get();
        foreach($data as $row) {
            $row->qty_diajukan = $request->input("approvedQty_". $row->id);
        }
                $pdf = Pdf::loadView('pdf.pengadaan', ["data" => $data])
                ->setPaper('A4', 'potrait');

        return $pdf->stream('Form Pengadaan Alat.pdf');
    }
}
