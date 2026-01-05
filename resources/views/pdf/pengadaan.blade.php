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

    <h2 class="title">FORM PENGAJUAN PENGADAAN ALAT LAB</h2>
    <h2 style="text-align:center; margin-top:-15px">STIKES WIJAYA HUSADA</h2>

   <table width="100%" style="table-layout: fixed;">
    <tr>
        {{-- Left --}}
        <td style="width:20%">Nama Pemohon</td>
        <td style="width:3%">:</td>
        <td style="width:27%">{{ auth()->user()->name }}</td>

        {{-- Right --}}
        <td style="width:20%">Tanggal Permohonan</td>
        <td style="width:3%">:</td>
        <td style="width:27%">
            {{ \Carbon\Carbon::parse(now())->format('d F Y') }}
        </td>
    </tr>
    <tr>
        {{-- Left --}}
        <td style="width:20%">Tujuan</td>
        <td style="width:3%">:</td>
        <td style="width:27%">Pengajuan Pengadaan Alat</td>

        {{-- Right --}}
        <td style="width:50%"></td>
    </tr>


</table>

<h2>Detail Alat</h2>
<table class="content">
    <tr>
        <th>No</th>
        <th>Kode Alat</th>
        <th>Nama Alat</th>
        <th>Qty Sekarang</th>
        <th>Qty Diajukan</th>
    </tr>
    @foreach($data as $index => $row)
        <tr class="{{$index %2 == 0 ? 'odd' : '' }}">
            <td style="text-align:center">{{ $index + 1}}</td>
            <td style="text-align:center">{{ $row->item_code}}</td>
            <td>{{ $row->item_name}}</td>
            <td style="text-align:center">{{ $row->quantity}}</td>
            <td style="text-align:center">{{ $row->qty_diajukan ?? 0}}</td>
        </tr>
    @endforeach
</table>

<table width="100%" style="table-layout: fixed; margin-top:30px">
    <tr>
        <th style="width:70%; text-align:center"></th>
        <th style="width:30%; text-align:center">Pemohon</th>
    </tr>
    <tr style="margin-top:100px;">
        <td style="width:70%;text-align:center;padding-top:80px;"></td>
        <td style="width:30%;text-align:center;padding-top:80px;">( {{ auth()->user()->name }} )</td>
    </tr>
</table>
</body>
</html>
