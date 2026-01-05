<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content {
            border : solid 1px black;
            margin-top:10px;
            border-spacing: 0;
            width: 100%;
            border-radius:8px;
            overflow: hidden;
        }
        .content th {
            background: rgb(100,50,50);
            padding:8px 10px;
            color:rgb(255,255,255);
        }
        .content td {
            padding:8px 10px;
        }
        .content .odd {
            background: rgba(100,100,100,0.2);
        }
    </style>
</head>
<body>

    <h2 class="title">FORM PENGAJUAN PEMINJAMAN ALAT LAB</h2>
    <h2 style="text-align:center; margin-top:-15px">STIKES WIJAYA HUSADA</h2>

   <table width="100%" style="table-layout: fixed;">
    <tr>
        {{-- Left --}}
        <td style="width:20%">NIM</td>
        <td style="width:3%">:</td>
        <td style="width:27%">{{ $data->nim }}</td>

        {{-- Right --}}
        <td style="width:20%">Tanggal Peminjaman</td>
        <td style="width:3%">:</td>
        <td style="width:27%">
            {{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d F Y') }}
        </td>
    </tr>

    <tr>
        {{-- Left --}}
        <td style="width:20%">Nama Peminjam</td>
        <td style="width:3%">:</td>
        <td style="width:27%">{{ $data->nama_peminjam }}</td>

        {{-- Right --}}
        <td style="width:20%">Waktu Peminjaman</td>
        <td style="width:3%">:</td>
        <td style="width:27%">
            {{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}
        </td>
    </tr>

    <tr>
        {{-- Left --}}
        <td style="width:20%">Kelas / TK</td>
        <td style="width:3%">:</td>
        <td style="width:27%">{{ $data->user->name }}</td>

        {{-- Right --}}
        <td style="width:20%">Status Peminjaman</td>
        <td style="width:3%">:</td>
        <td style="width:27%;padding:8px 0;">
            <span style="background:
                    @if($data->status_id == 1)
                    rgb(255,191,0);
                    @elseif($data->status_id == 2)
                    rgb(80,200,120);
                    @elseif($data->status_id == 3)
                    rgb(200,0,0);
                    @else
                    rgb(95, 145, 195);
                    @endif
                    color:rgb(255,255,255);
                    padding:8px 12px;
                    border-radius:8px;">
                {{ $data->status->status_name }}
            </span>
        </td>
    </tr>
</table>

<h2>Detail Alat</h2>
<table class="content">
    <tr>
        <th>No</th>
        <th>Kode Alat</th>
        <th>Nama Alat</th>
        <th>Qty Dipinjam</th>
        <th>Qty Disetujui</th>
        <th>Qty Dikembalikan</th>
    </tr>
    @foreach($data->details as $index => $detail)
        <tr class="{{$index %2 == 0 ? 'odd' : '' }}">
            <td style="text-align:center">{{ $index + 1}}</td>
            <td style="text-align:center">{{ $detail->alat->item_code}}</td>
            <td>{{ $detail->alat->item_name}}</td>
            <td style="text-align:center">{{ $detail->quantity_diajukan}}</td>
            <td style="text-align:center">{{ $detail->quantity_disetujui ?? 0}}</td>
            <td style="text-align:center">{{ $detail->quantity_dikembalikan ?? 0}}</td>
        </tr>
    @endforeach
</table>

<table width="100%" style="table-layout: fixed; margin-top:30px">
    <tr>
        <th style="width:50%">Peminjam</th>
        <th style="width:50%">Admin Lab</th>
    </tr>
    <tr style="margin-top:100px;">
        <td style="width:50%;text-align:center;padding-top:100px;">( {{ $data->nama_peminjam }} )</td>
        <td style="width:50%;text-align:center;padding-top:100px;">( {{ auth()->user()->name }} )</td>
    </tr>
</table>
</body>
</html>
